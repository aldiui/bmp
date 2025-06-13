<?php

namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('cpmi.kelas.index');
    }
}
