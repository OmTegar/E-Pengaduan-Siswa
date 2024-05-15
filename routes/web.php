<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportControllerCustom;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::middleware('guest')->group(function () {
//     Route::get('/', fn() => view('auth.login'))->name('home');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route public report viewer
// Route::view('/report/detail', 'landing-page.report');
Route::get('public/report/{report}', [ReportControllerCustom::class, 'showPublicReport'])->name('public.report.show');

Route::middleware('auth')->group(function () {

    // Route admin dan guru

    // Route Report Unread
    Route::get('report/unread', [ReportControllerCustom::class, 'unreadReport'])->name('report.unreadReport');

    // Report Progressing
    Route::get('report/progressing', [ReportControllerCustom::class, 'progressingReport'])->name('report.progressingReport');

    // Route Report Finish
    Route::get('report/selesai', [ReportControllerCustom::class, 'selesaiReport'])->name('report.selesaiReport');

    // Route Report
    Route::resource('report', ReportController::class);
    Route::get('report/{report}/process', [ReportController::class, 'processingReport'])->name('report.processingReport');
    Route::get('report/{report}/finish', [ReportController::class, 'finishReport'])->name('report.finishReport');
    Route::post('report/{report}/comment', [ReportController::class, 'commentReport'])->name('report.commentReport');

    // Route Management user 
    Route::middleware('role:admin')->group(function () {
        Route::get('management/data-pengguna', [UserController::class, 'index'])->name('management');
        Route::post('management/data-pengguna/{user}/update', [UserController::class, 'updateRole'])->name('management.updateRole');
        Route::delete('management/data-pengguna/{user}/delete', [UserController::class, 'destroy'])->name('management.delete');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
});

require __DIR__ . '/auth.php';
