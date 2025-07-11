<?php
namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Gaji;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class GajiController extends Controller
{
    public function slipGaji($id)
    {
        $gaji     = Gaji::where('id', $id)->firstOrFail();
        $employee = User::findOrFail($gaji->user_id);

        $periode = Carbon::create($gaji->tahun, $gaji->bulan, 1)->translatedFormat('F Y');

        $data = [
            'employee'      => $employee,
            'gaji'          => $gaji,
            'periode'       => $periode,
            'tanggal_cetak' => Carbon::now()->translatedFormat('d F Y'),
            'penandatangan' => 'Dewi Komalasari',
        ];

        $pdf = PDF::loadView('filament.slip_gaji', $data);
        return $pdf->stream('Slip_Gaji_' . $employee->name . '_' . $periode . '.pdf');
    }
}
