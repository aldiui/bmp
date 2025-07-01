<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Cpmi\AuthController;
use App\Http\Controllers\Cpmi\CpmiController;
use App\Http\Controllers\Admin\GajiController;
use App\Http\Controllers\Cpmi\KelasController;
use App\Http\Controllers\Cpmi\AbsensiController;
use App\Http\Controllers\Cpmi\BerandaController;
use App\Http\Controllers\Cpmi\LamaranKerjaController;
use App\Http\Controllers\Cpmi\LowonganKerjaController;

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
    Route::get('/', [BerandaController::class, 'index'])->name('cpmi.home');
    Route::get('/kelas', [KelasController::class, 'index'])->name('cpmi.kelas');
    Route::get('/lowongan-kerja', [LowonganKerjaController::class, 'index'])->name('cpmi.lowonganKerja');
    Route::get('/lowongan-kerja/{slug}', [LowonganKerjaController::class, 'show'])->name('cpmi.lowonganKerja.detail');
    Route::post('/lamaran-kerja', [LamaranKerjaController::class, 'store'])->name('cpmi.lamaranKerja');
    Route::get('/lamaran-kerja/datatable', [LamaranKerjaController::class, 'lamaranKerjaDatatable'])->name('cpmi.lamaranKerja.datatable');
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('cpmi.absensi');
    Route::get('/absensi/datatable', [AbsensiController::class, 'absensiDatatable'])->name('cpmi.absensi.datatable');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('cpmi.absensi.store');
    Route::match(['get', 'post'], '/profile', [CpmiController::class, 'index'])->name('cpmi.profile');
    Route::post('/ubah-password', [CpmiController::class, 'changePassword'])->name('cpmi.change-password');
});
