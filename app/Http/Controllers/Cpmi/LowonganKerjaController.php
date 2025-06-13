<?php

namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LowonganKerjaController extends Controller
{
    public function index()
    {
        return view('cpmi.lowongan_kerja.index');
    }
}
