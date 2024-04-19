<?php

use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Route;

Route::get('/ad', [AdController::class, 'index'])->name('ads.index');
Route::get('/ad/{id}', [AdController::class, 'show'])->name('ads.show');
Route::post('/ad', [AdController::class, 'store'])->name('ads.store');
