<?php

use App\Http\Controllers\Admin\GajiController;
use App\Livewire\Auth\Login;
use App\Livewire\Home\Index as HomeIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('admin/gaji/{id}/slip-gaji', [GajiController::class, 'slipGaji'])->name('admin.gaji.slip-gaji')->middleware('permission:view_gaji');
});
