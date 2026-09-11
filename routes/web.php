<?php

use App\Http\Controllers\PasteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PasteController::class, 'index'])->name('home');
Route::post('/paste', [PasteController::class, 'store'])->name('paste.store');

Route::get('/{unique_id}', [PasteController::class, 'show'])->name('paste.show');
Route::get('/download/{unique_id}', [PasteController::class, 'download'])->name('paste.download');

Route::view('/about', 'pages.about')->name('about');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms-of-service', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');
