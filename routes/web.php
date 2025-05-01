<?php

use App\Http\Controllers\SlipGajiController;
use Illuminate\Support\Facades\Route;


Route::get('slip-gaji/{uuid}', [SlipGajiController::class, 'show'])->name('slip-gaji.show');

