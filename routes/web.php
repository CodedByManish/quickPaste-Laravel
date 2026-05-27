<?php

use App\Http\Controllers\PasteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('v1')->group(function () {
    Route::post('/pastes', [PasteController::class, 'store']);       // Create
    Route::get('/pastes/{slug}', [PasteController::class, 'show']);   // Fetch
    Route::put('/pastes/{slug}', [PasteController::class, 'update']); // Update
    Route::delete('/pastes/{slug}', [PasteController::class, 'destroy']); // Delete
});