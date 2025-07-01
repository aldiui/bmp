<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use App\Models\LamaranKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LamaranKerjaController extends Controller
{
    public function lamaranKerjaDatatable(Request $request)
    {
        $cpmi  = auth('cpmi')->user();
        // $bulan = $request->bulan ?? date('m');
        // $tahun = $request->tahun ?? date('Y');

        $lamaranKerja = LamaranKerja::with('lowonganKerja')
            ->where('cpmi_id', $cpmi->id)
            ->orderBy('created_at', 'desc');
            // ->whereMonth('created_at', $bulan)
            // ->whereYear('created_at', $tahun);

        return DataTables::of($lamaranKerja)
            ->addColumn('tanggal', function ($lamaran) {
                return Carbon::parse($lamaran->created_at)->translatedFormat('d F Y');
            })
            ->addColumn('lowongan', function ($lamaran) {
                return $lamaran->lowonganKerja->nama ?? '-';
            })
            ->addColumn('status', function ($lamaran) {
                return formatStatusLabel($lamaran->status);
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }
    
    public function store(Request $request)
    {
        $cpmi = auth('cpmi')->user();

        $validator = Validator::make($request->all(), [
            'lowongan_kerja' => 'required|exists:lowongan_kerja,id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, 'Lowongan kerja tidak ditemukan.', 400);
        }

        $sudahMelamar = LamaranKerja::where('cpmi_id', $cpmi->id)
            ->where('lowongan_kerja_id', $request->lowongan_kerja)
            ->exists();

        if ($sudahMelamar) {
            return $this->errorResponse(null, 'Anda sudah melamar pada lowongan kerja ini.', 400);
        }

        DB::beginTransaction();
        try {
            LamaranKerja::create([
                'cpmi_id'           => $cpmi->id,
                'lowongan_kerja_id' => $request->lowongan_kerja,
                'status'            => 'Pending',
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse(null, 'Terjadi kesalahan saat menyimpan data.', 500);
        }

        return $this->successResponse(null, 'Lamaran kerja berhasil disimpan');
    }
}
