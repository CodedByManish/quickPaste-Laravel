<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'title',
        'content',
        'file_path',
        'original_filename',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}