<?php

namespace App\Http\Controllers;

use App\Jobs\ProductJob;
use App\Models\CsvUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UploadProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome',[
            'uploaded' => CsvUpload::get()
        ]);
    }

    public function import(Request $request)
    {
        $uploadedFile = $request->file('file');

        if(CsvUpload::where('FILENAME', $uploadedFile->getClientOriginalName())->where('FILESIZE', $uploadedFile->getSize())->exists()){
            throw ValidationException::withMessages([
                'file' => "File already exists",
            ]);
        }else{
            $filePath = $uploadedFile->store('temp');
            CsvUpload::create([
                'FILENAME' => $uploadedFile->getClientOriginalName(),
                'FILESIZE' => $uploadedFile->getSize(),
                'FILETEMP' => $filePath,
                'STATUS' => "PENDING"
            ]);

            ProductJob::dispatch($filePath);
        }


        return back();
    }
}
