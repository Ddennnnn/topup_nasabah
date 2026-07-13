<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PocketController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\PocketTransferController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pocket routes
    Route::resource('pocket', PocketController::class);

    // Topup routes
    Route::resource('topup', TopupController::class)->only(['index', 'create', 'store']);

    // Pocket Transfer routes
    Route::resource('pocket_transfer', PocketTransferController::class)->only(['index', 'create', 'store']);

    // Transfer routes (antar user)
    Route::resource('transfer', TransferController::class)->only(['index', 'create', 'store']);

    // Riwayat routes
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    // Admin routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/transfers', [AdminController::class, 'transfers'])->name('admin.transfers');
        Route::get('/topups', [AdminController::class, 'topups'])->name('admin.topups');
        Route::get('/pockets', [AdminController::class, 'pockets'])->name('admin.pockets');
        Route::get('/history', [AdminController::class, 'history'])->name('admin.history');
    });
});

require __DIR__.'/auth.php';

