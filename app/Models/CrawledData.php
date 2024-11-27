<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawledData extends Model
{
    // use HasFactory;

    protected $table = 'crawled_data';

    protected $fillable = ['url', 'links', 'headings', 'paragraphs'];

    // Cast JSON fields to arrays
    protected $casts = [
        'links' => 'array',
        'headings' => 'array',
        'paragraphs' => 'array',
    ];
}
