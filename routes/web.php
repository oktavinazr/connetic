<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\AktivitasController;

// Public
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
});

// Authenticated
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pembelajaran', function () {
        return view('pembelajaran');
    })->name('pembelajaran');

    // Pertemuan
    Route::get('/pertemuan/{id}', [PertemuanController::class, 'show'])->name('pertemuan.show');

    // Aktivitas
    Route::get('/aktivitas/{id}/materi', [AktivitasController::class, 'materi'])->name('aktivitas.materi');
    Route::get('/aktivitas/{id}/lkpd', [AktivitasController::class, 'lkpd'])->name('aktivitas.lkpd');
    Route::post('/aktivitas/{id}/lkpd', [AktivitasController::class, 'uploadLkpd'])->name('aktivitas.lkpd.upload');

    // Profile
    Route::get('/profile/complete', [ProfileController::class, 'showComplete'])->name('profile.complete');
    Route::post('/profile/complete', [ProfileController::class, 'storeComplete']);
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
});