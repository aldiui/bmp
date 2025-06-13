<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CpmiController extends Controller
{
    public function index(Request $request)
    {
        $cpmi = auth('cpmi')->user();
        if ($request->isMethod('post')) {
            $request->validate([
                'email'    => 'required|string|email|max:255|unique:cpmi,email,' . $cpmi->id,
                'telepon'  => 'required|string|max:255|unique:cpmi,telepon,' . $cpmi->id,
                'username' => 'required|string|max:255|unique:cpmi,username,' . $cpmi->id,
            ]);

            DB::beginTransaction();
            try {
                $cpmi->update($request->only('email', 'telepon', 'username'));
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }

            return $this->successResponse(null, 'Data Cpmi berhasil diubah');
        }

        return view('cpmi.cpmi.index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama'            => 'required|string',
            'password_baru'            => 'required|string|min:8',
            'konfirmasi_password_baru' => 'required|string|min:8|same:password_baru',
        ]);

        DB::beginTransaction();
        try {
            $cpmi = auth('cpmi')->user();
            $cpmi->update([
                'password' => bcrypt($request->password_baru),
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $this->successResponse(null, 'Data Password berhasil diubah');
    }
}
