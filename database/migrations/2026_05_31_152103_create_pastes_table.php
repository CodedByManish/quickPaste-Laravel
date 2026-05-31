<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pastes', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 10)->unique(); // Random string for URL (e.g., a8f3g2)
            $table->string('title')->nullable();
            $table->longText('content')->nullable(); // For text pastes
            $table->string('file_path')->nullable(); // For uploaded files
            $table->string('original_filename')->nullable();
            $table->timestamp('expires_at')->nullable(); // For auto-expiry
            $table->timestamps(); // creates created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pastes');
    }
};