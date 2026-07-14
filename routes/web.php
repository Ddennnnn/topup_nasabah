<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PocketController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\PocketTransferController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTopupApprovalController;
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\AdminAuditLogController;
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

// Dashboard user
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'user', 'verified'])->name('dashboard');


// Route khusus user
Route::middleware(['auth', 'user'])->group(function () {


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

});

// Route khusus admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Menu admin
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // Top Up Approval
    Route::get('/topups', [AdminController::class, 'topups'])->name('admin.topups');
    Route::post('/topups/{topup}/approve', [AdminTopupApprovalController::class, 'approve'])->name('admin.topups.approve');
    Route::post('/topups/{topup}/reject', [AdminTopupApprovalController::class, 'reject'])->name('admin.topups.reject');

    // Monitoring
    Route::get('/transfers', [AdminController::class, 'transfers'])->name('admin.transfers');
    Route::get('/pockets', [AdminController::class, 'pockets'])->name('admin.pockets');

    // Reports (sementara belum ada implementasi detail)
    Route::get('/reports', [AdminReportsController::class, 'index'])->name('admin.reports');

    // Audit Log
    Route::get('/audit-logs', [AdminAuditLogController::class, 'index'])->name('admin.audit-logs');

    // Riwayat (untuk admin)
    Route::get('/history', [AdminController::class, 'history'])->name('admin.history');
});



require __DIR__.'/auth.php';

