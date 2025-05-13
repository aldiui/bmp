<?php

use App\Http\Controllers\GajiController;
use App\Livewire\Auth\Login;
use App\Livewire\Home\Index as HomeIndex;
use Illuminate\Support\Facades\Route;




// livewire
Route::get('/login', Login::class)->name('login');
Route::get('/', HomeIndex::class)->name('home');

// filament
Route::middleware('auth')->group(function () {
    Route::get('admin/gaji/{id}/slip-gaji', [GajiController::class, 'slipGaji'])->name('admin.gaji.slip-gaji')->middleware('permission:view_gaji');
});
