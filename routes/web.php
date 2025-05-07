<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentimentController;
use Illuminate\Http\Request;

Route::get('/test', function () {
    return view('components.example');
});

Route::get('/', [SentimentController::class, 'index'])->name('form');
Route::post('/predictText', [SentimentController::class, 'predictText'])->name('predictText');
Route::get('/upload-csv', [SentimentController::class, 'uploadCsvForm'])->name('uploadCsvForm');
Route::post('/process-csv', [SentimentController::class, 'processCsv'])->name('processCsv');

route::get('/about', function () {
    return view('sentimen.about');
})->name('about');