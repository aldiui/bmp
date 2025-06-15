<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Cpmi\AuthController;
use App\Http\Controllers\Admin\GajiController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/tentang', [HomeController::class, 'about'])->name('home.about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('home.contact');
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::match(['get', 'post'], '/registrasi', [AuthController::class, 'registrasi'])->name('auth.registrasi');

Route::middleware('auth')->group(function () {
    Route::get('admin/gaji/{id}/slip-gaji', [GajiController::class, 'slipGaji'])->name('admin.gaji.slip-gaji')->middleware('permission:view_gaji');
});
