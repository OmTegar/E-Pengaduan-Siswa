<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('welcome'))->name('home');
});

Route::middleware('auth')->group(function () {

    // Route admin dan guru
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Route Report
    Route::resource('report', ReportController::class);
});

Route::middleware(['auth', 'verified'])->group(function () {
    
});

require __DIR__ . '/auth.php';
