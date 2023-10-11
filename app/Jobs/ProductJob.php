<?php

namespace App\Jobs;

use App\Imports\ImportProduct;
use App\Models\CsvUpload;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        $file = Storage::disk('local')->readStream($this->filePath);
        $header = fgetcsv($file);

        $chunkSize = 1000;
        DB::beginTransaction();
        $s = CsvUpload::where('FILETEMP', $this->filePath)->update(['STATUS' => "PROCESSING"]);
        try {
            $data = [];
            $rowCount = 0;

            while (($row = fgetcsv($file, 0, ",")) !== FALSE) {
                $data[] = [
                    'UNIQUE_KEY' => mb_convert_encoding($row[0], 'UTF-8', 'UTF-8'),
                    'PRODUCT_TITLE' => mb_convert_encoding($row[1], 'UTF-8', 'UTF-8'),
                    'PRODUCT_DESCRIPTION' => mb_convert_encoding($row[2], 'UTF-8', 'UTF-8'),
                    'STYLE#' => mb_convert_encoding($row[3], 'UTF-8', 'UTF-8'),
                    'SANMAR_MAINFRAME_COLOR' => mb_convert_encoding($row[28], 'UTF-8', 'UTF-8'),
                    'SIZE' => mb_convert_encoding(intval($row[18]), 'UTF-8', 'UTF-8'),
                    'COLOR_NAME' => mb_convert_encoding($row[14], 'UTF-8', 'UTF-8'),
                    'PIECE_PRICE' => mb_convert_encoding(floatval($row[21]), 'UTF-8', 'UTF-8'),
                ];

                $rowCount++;

                if ($rowCount % $chunkSize === 0) {
                    Product::upsert($data,['UNIQUE_KEY','PRODUCT_TITLE','PRODUCT_DESCRIPTION','STYLE#','SANMAR_MAINFRAME_COLOR','SIZE','COLOR_NAME','PIECE_PRICE']);
                    $data = [];
                }
            }
            if (!empty($data)) {
                Product::upsert($data, ['UNIQUE_KEY', 'PRODUCT_TITLE', 'PRODUCT_DESCRIPTION', 'STYLE#', 'SANMAR_MAINFRAME_COLOR', 'SIZE', 'COLOR_NAME', 'PIECE_PRICE']);
            }

            DB::commit();

            CsvUpload::where('FILETEMP',$this->filePath)->update(['STATUS' => "COMPLETED"]);


        } catch (\Exception $e) {
            CsvUpload::where('FILETEMP', $this->filePath)->update(['STATUS' => "FAILED"]);
            DB::rollback();
            throw $e;
        }
            fclose($file);
    }
}
