<?php

namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $cpmi = auth('cpmi')->user();
        return view('cpmi.beranda.index', compact('cpmi'));
    }

}
