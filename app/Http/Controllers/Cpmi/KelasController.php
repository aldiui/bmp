<?php

namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $cpmi = auth('cpmi')->user();
        return view('cpmi.kelas.index', compact('cpmi'));
    }
}
