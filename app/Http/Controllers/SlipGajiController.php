<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SlipGajiController extends Controller
{
    public function show($uuid)
    {
        $gaji = Gaji::where('id', $uuid)->firstOrFail();
        $employee = User::findOrFail($gaji->user_id);
        
        $periode = Carbon::create($gaji->tahun, $gaji->bulan, 1)->translatedFormat('F Y');
        
        $data = [
            'employee' => $employee,
            'gaji' => $gaji,
            'periode' => $periode,
            'tanggal_cetak' => Carbon::now()->translatedFormat('d F Y'),
            'penandatangan' => 'Dewi Komalasari'
        ];

        $pdf = PDF::loadView('slip_gaji', $data);
        
        return $pdf->stream('Slip_Gaji_'.$employee->name.'_'.$periode.'.pdf');
    }
}