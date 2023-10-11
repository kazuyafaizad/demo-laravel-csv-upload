<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
    use HasFactory;

    protected $fillable = ['FILENAME','STATUS','FILESIZE','FILETEMP'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $appends = [
        'human_created_at'
    ];

    public function getHumanCreatedAtAttribute()
    {
        $formattedCreatedAt = $this->created_at->format('j-n-y gA');
        $timeAgo = $this->created_at->diffForHumans();
        return "$formattedCreatedAt ($timeAgo)";
    }
}
