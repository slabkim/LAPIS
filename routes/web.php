<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPengaduanController;
use App\Http\Controllers\Admin\AdminSurveiController;
use App\Http\Controllers\Admin\JenisLayananController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\Auth\GoogleAuthController;

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

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengaduan
    Route::get('/pengaduan/pungli', [PengaduanController::class, 'createPungli'])->name('pengaduan.pungli');
    Route::post('/pengaduan/pungli', [PengaduanController::class, 'storePungli']);
    Route::get('/pengaduan/keterlambatan', [PengaduanController::class, 'createKeterlambatan'])->name('pengaduan.keterlambatan');
    Route::post('/pengaduan/keterlambatan', [PengaduanController::class, 'storeKeterlambatan']);

    // Survei
    Route::get('/survei', [SurveiController::class, 'index'])->name('survei.index');
    Route::post('/survei', [SurveiController::class, 'store'])->name('survei.store');
});

require __DIR__.'/auth.php';



Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthController::class, 'store'])->name('login.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Pengaduan Pungli
        Route::get('pengaduan/pungli', [AdminPengaduanController::class, 'indexPungli'])->name('pengaduan.pungli.index');
        Route::get('pengaduan/pungli/{id}', [AdminPengaduanController::class, 'showPungli'])->name('pengaduan.pungli.show');
        
        // Pengaduan Keterlambatan
        Route::get('pengaduan/keterlambatan', [AdminPengaduanController::class, 'indexKeterlambatan'])->name('pengaduan.keterlambatan.index');
        Route::get('pengaduan/keterlambatan/{id}', [AdminPengaduanController::class, 'showKeterlambatan'])->name('pengaduan.keterlambatan.show');
        
        // Update Status (Global for both types)
        Route::patch('pengaduan/{type}/{id}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.update-status');
        
        // Survei
        Route::get('survei', [AdminSurveiController::class, 'index'])->name('survei.index');

        // Master Data
        Route::resource('master/jenis_layanan', JenisLayananController::class, ['as' => 'master']);

        Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });
});

