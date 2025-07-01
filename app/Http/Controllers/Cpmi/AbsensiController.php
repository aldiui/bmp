<?php
namespace App\Http\Controllers\Cpmi;

use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $cpmi    = auth('cpmi')->user();
        $jsFile  = 'resources/js/cpmi/absensi/index.js';
        $absensi = $cpmi->absensi()->where('tanggal', date('Y-m-d'))->first();
        return view('cpmi.absensi.index', compact('jsFile', 'cpmi', 'absensi'));
    }

    public function absensiDatatable(Request $request)
    {
        $cpmi  = auth('cpmi')->user();
        // $bulan = $request->bulan ?? date('m');
        // $tahun = $request->tahun ?? date('Y');

        $absensi = Absensi::where('cpmi_id', $cpmi->id)
            ->orderBy('created_at', 'desc');
            // ->whereMonth('created_at', $bulan)
            // ->whereYear('created_at', $tahun);

        return DataTables::of($absensi)
            ->addIndexColumn()
            ->make(true);
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lokasi' => 'required|string',
            'alasan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $cpmi = auth('cpmi')->user();
        if (! $cpmi) {
            return $this->errorResponse(null, 'Pengguna tidak ditemukan.', 401);
        }

        $kelas = $cpmi->kelas()->first();
        if (! $kelas) {
            return $this->errorResponse(null, 'Kelas tidak ditemukan.', 400);
        }

        $hariIni       = Carbon::now()->locale('id')->isoFormat('dddd');
        $jadwalHariIni = $kelas->jadwalPelajaran()
            ->where('hari', $hariIni)
            ->where('libur', false)
            ->get();

        if ($jadwalHariIni->isEmpty()) {
            return $this->errorResponse(null, "Hari ini ($hariIni) libur.", 400);
        }

        DB::beginTransaction();
        try {
            $tanggal = now()->locale('id')->format('Y-m-d');
            $jam     = now()->locale('id')->format('H:i:s');
            $absensi = $cpmi->absensi()->where('tanggal', $tanggal)->first();
            $lokasi  = $cpmi->lokasi;

            if (! $lokasi) {
                return $this->errorResponse(null, 'Lokasi absensi belum disetel.', 400);
            }

            [$latitude, $longitude] = explode(",", $request->lokasi);
            $latitude               = trim($latitude);
            $longitude              = trim($longitude);

            $jamMasukMulai    = Carbon::createFromFormat('H:i:s', $lokasi->jam_masuk_mulai);
            $jamMasukSelesai  = Carbon::createFromFormat('H:i:s', $lokasi->jam_masuk_selesai);
            $jamKeluarMulai   = Carbon::createFromFormat('H:i:s', $lokasi->jam_keluar_mulai);
            $jamKeluarSelesai = Carbon::createFromFormat('H:i:s', $lokasi->jam_keluar_selesai);

            $now      = Carbon::now();
            $isKeluar = $absensi !== null;
            $isOnTime = $now->between(
                $isKeluar ? $jamKeluarMulai : $jamMasukMulai,
                $isKeluar ? $jamKeluarSelesai : $jamMasukSelesai
            );

            if (! $isKeluar && $now->lt($jamMasukMulai)) {
                return $this->errorResponse(null, 'Belum waktunya absensi masuk.', 400);
            }

            if ($isKeluar && $now->lt($jamKeluarMulai)) {
                return $this->errorResponse(null, 'Belum waktunya absensi pulang.', 400);
            }

            $distance = calculateDistance($latitude, $longitude, $lokasi->latitude, $lokasi->longitude);
            $status   = $isOnTime ? 'ontime' : 'terlambat';

            if ($distance >= $lokasi->radius && ! $request->alasan) {
                $selisih = calculateSelisihJarak($distance - $lokasi->radius);
                return $this->errorResponse(null, "Anda tidak bisa melakukan absensi karena berada di luar radius lokasi ($selisih).", 400);
            }

            if ($status === 'terlambat' && !$absensi && ! $request->alasan) {
                $batasWaktu   = $isKeluar ? $jamKeluarMulai : $jamMasukSelesai;
                $selisihMenit = $now->diffInMinutes($batasWaktu);
                $jamTelat     = floor($selisihMenit / 60);
                $menitTelat   = $selisihMenit % 60;
                $lamaTelat    = sprintf('%02d jam %02d menit', abs($jamTelat), abs($menitTelat));
                return $this->errorResponse('telat', "Mohon maaf, Anda terlambat $lamaTelat. Alasan wajib diisi.", 400);
            }

            if (! $absensi) {
                $absensi = $cpmi->absensi()->create([
                    'tanggal'         => $tanggal,
                    'jam_masuk'       => $jam,
                    'latitude_masuk'  => $latitude,
                    'longitude_masuk' => $longitude,
                    'status_masuk'    => $status === 'terlambat' ? 'Terlambat' : 'Hadir',
                    'alasan_masuk'    => $request->alasan ?? null,
                ]);

                $message = $status === 'terlambat'
                ? "Absensi masuk berhasil, tapi Anda terlambat. Alasan: {$request->alasan}"
                : 'Absensi masuk berhasil. Anda datang tepat waktu.';
            } else {
                $absensi->update([
                    'jam_keluar'       => $jam,
                    'latitude_keluar'  => $latitude,
                    'longitude_keluar' => $longitude,
                    'status_keluar'    => 'Hadir',
                    'alasan_keluar'    => $request->alasan ?? null,
                ]);

                $message = 'Absensi pulang berhasil. Semangat terus!';
            }

            DB::commit();
            return $this->successResponse($absensi, $message, 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(null, 'Terjadi kesalahan saat menyimpan absensi. ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $cpmi    = auth('cpmi')->user();
        $absensi = $cpmi->absensi()->where('id', $id)->firstOrFail();
        return $this->successResponse($absensi, 'Data Absensi berhasil diambil');
    }
}
