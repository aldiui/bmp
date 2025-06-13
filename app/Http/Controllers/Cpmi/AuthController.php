<?php
namespace App\Http\Controllers\Cpmi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email'    => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            $cpmi = Cpmi::where('email', $request->email)
                ->where('status', 'Tidak Aktif')
                ->first();

            if (! $cpmi || ! auth('cpmi')->attempt($request->only('email', 'password'))) {
                return $this->errorResponse(null, 'Invalid Credential', 401);
            }

            return $this->successResponse($cpmi, 'Login berhasil');
        }

        return view('cpmi.auth.login');
    }

    public function logout(Request $request)
    {
        auth('cpmi')->logout();
        return $this->successResponse(null, 'Logout berhasil');
    }
}
