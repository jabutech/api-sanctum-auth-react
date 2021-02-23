<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function __invoke(Request $request)
    {
        // Validasi form
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek apakah username ada didatabase atau tidak
        $user = User::where('username', '=', $request->username)->first();

    
        // Cek apakah password sama dengan database
        // Jika user tidak ada atau password yang diinput tidak sama dengan password di $user yang didatabase
        if(! $user || ! Hash::check($request->password, $user->password)){
            // tampilkan error
            throw ValidationException::withMessages([
                'failedLogin' => ["Username/Password Salah!"],
            ]);
        }

        // Hapus Token yang sebelumnya login
        $user->tokens()->delete();

        // Jika Sukses buat tokennya
        $token = $user->createToken('web-token')->plainTextToken;

        // kembalikan data user dengan user Resource dan ikutkan token dengan additional

        return (new UserResource($user))->additional(compact('token'));
    }
}
