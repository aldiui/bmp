<?php

use App\Http\Controllers\Admin\GajiController;
use App\Http\Controllers\Cpmi\AuthController;
use App\Http\Controllers\Cpmi\CpmiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/tentang', [HomeController::class, 'about'])->name('home.about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('home.contact');
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::match(['get', 'post'], '/registrasi', [AuthController::class, 'registrasi'])->name('auth.registrasi');

Route::middleware('auth')->group(function () {
    Route::get('admin/gaji/{id}/slip-gaji', [GajiController::class, 'slipGaji'])->name('admin.gaji.slip-gaji')->middleware('permission:view_gaji');
});

Route::middleware('auth:cpmi')->prefix('cpmi')->group(function () {
    Route::get('/', [CpmiController::class, 'index'])->name('cpmi.index');
});
