<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CpmiController extends Controller
{
    public function index(Request $request)
    {
        $cpmi = auth('cpmi')->user();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email'   => 'required|string|email|max:255|unique:cpmi,email,' . $cpmi->id,
                'telepon' => 'required|string|max:255|unique:cpmi,telepon,' . $cpmi->id,
                'alamat'  => 'required|string|min:3',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            DB::beginTransaction();
            try {
                $cpmi->update($validator->validated());
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                return $this->errorResponse(null, 'Terjadi kesalahan saat menyimpan data.', 500);
            }

            return $this->successResponse(null, 'Data Cpmi berhasil diubah');
        }

        $jsFile = 'resources/js/cpmi/cpmi/index.js';
        return view('cpmi.cpmi.index', compact('jsFile'));
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama'            => 'required|string',
            'password_baru'            => 'required|string|min:8',
            'konfirmasi_password_baru' => 'required|string|min:8|same:password_baru',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        DB::beginTransaction();
        try {
            $cpmi = auth('cpmi')->user();
            $cpmi->update([
                'password' => bcrypt($request->password_baru),
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse(null, 'Terjadi kesalahan saat menyimpan data.', 500);
        }

        return $this->successResponse(null, 'Data Password berhasil diubah');
    }
}
