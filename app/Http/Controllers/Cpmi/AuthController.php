<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use App\Models\Cpmi;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Notifications\CpmiRegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $cpmi = Cpmi::where('email', $request->email)
                ->whereNotIn('status', ['Pendaftaran', 'Tidak Aktif'])
                ->first();

            if (! $cpmi || ! Hash::check($request->password, $cpmi->password)) {
                return $this->errorResponse(null, 'Kredensial tidak valid.', 401);
            }

            $token = auth('cpmi')->login($cpmi);
            return $this->successResponse($cpmi, 'Login berhasil');
        }

        $jsFile = 'resources/js/cpmi/auth/login.js';
        return view('cpmi.auth.login', compact('jsFile'));
    }

    public function logout(Request $request)
    {
        auth('cpmi')->logout();
        return redirect()->route('login');
    }

    public function registrasi(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama'                => 'required|string|min:3',
                'email'               => 'required|string|email|max:255|unique:cpmi',
                'telepon'             => 'required|string|min:10',
                'alamat'              => 'required|string|min:3',
                'lokasi'              => 'required|exists:lokasi,id',
                'password'            => 'required|string|min:8',
                'konfirmasi_password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            DB::beginTransaction();
            try {
                $kelas = Kelas::where('lokasi_id', $request->lokasi)->first();
                $cpmi  = Cpmi::create([
                    'nama'      => $request->nama,
                    'email'     => $request->email,
                    'telepon'   => $request->telepon,
                    'alamat'    => $request->alamat,
                    'lokasi_id' => $request->lokasi,
                    'kelas_id'  => $kelas->id,
                    'password'  => $request->password,
                    'status'    => 'Pendaftaran',
                ]);

                Notification::route('mail', $cpmi->email)->notify(new CpmiRegistrationNotification($cpmi));
                DB::commit();

                return $this->successResponse($cpmi, 'Registrasi berhasil');
            } catch (\Throwable $th) {
                DB::rollBack();
                return $this->errorResponse(null, 'Terjadi kesalahan saat menyimpan data.', 500);
            }
            return $this->successResponse($cpmi, 'Registrasi berhasil');
        }

        $lokasi = Lokasi::get();
        $jsFile = 'resources/js/cpmi/auth/registrasi.js';
        return view('cpmi.auth.registrasi', compact('lokasi', 'jsFile'));
    }
}
