<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function __invoke(Request $request)
    {
        // Validasi form dan masukkan ke variable attribute untuk diinput ke database
        $attributes = $request->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        
        // replace attributes dan encrypt password
        $attributes['password'] = bcrypt($request->password);
        
        // Proses create user dari $attributes
        User::create($attributes);

        // Kembalikan respon ketika sukses
        return response()->json([
            'message' => "You're register and please login"
        ]);
    }
}
