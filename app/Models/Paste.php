<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Paste extends Model
{
    // Define which fields can be mass-assigned via the API
    protected $fillable = [
        'title',
        'content',
        'slug',
        'syntax',
        'expires_at',
    ];

    /**
     * The "booted" method of the model.
     * This hooks into Laravel's Eloquent lifecycle events.
     */
    protected static function booted(): void
    {
        static::creating(function (Paste $paste) {
            // Automatically generate a short, secure 8-character slug before saving
            $paste->slug = $paste->slug ?? Str::random(8);
        });
    }
}