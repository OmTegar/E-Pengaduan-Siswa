<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/keluhan', [MailController::class, 'index'])->name('keluhan');
// Route::get('/keluhan/create', [MailController::class, 'create'])->name('keluhan.create');
// Route::post('/keluhan', [MailController::class, 'store'])->name('keluhan.store');

Route::middleware('auth')->group(function () {

    // Route admin dan guru
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');

    Route::get('report', [ReportController::class, 'index'])->name('reportShow');
    Route::get('report-create', [ReportController::class, 'create'])->name('reportCreate');
    Route::post('report-store', [ReportController::class, 'store'])->name('reportStore');
    Route::post('reportshow/{uuid}', [ReportController::class, 'show'])->name('reportShowDetail');
    Route::get('report-show/{uuid}', [ReportController::class, 'showTab'])->name('reportShowDetailTab');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

require __DIR__ . '/auth.php';
