<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        return view('cpmi.absensi.index');
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $cpmi    = auth('cpmi')->user();
        $absensi = $cpmi->absensis()->where('id', $id)->firstOrFail();
        return $this->successResponse($absensi, 'Data Absensi berhasil diambil');
    }
}
