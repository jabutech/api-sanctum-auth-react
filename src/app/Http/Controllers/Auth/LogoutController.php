<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{

    public function __invoke(Request $request)
    {
        // Cek token user yang sedang login dengan relasi antara sanctum dan user
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
        // kirim respon
        return response()->json([
            "message" => "You're logout"
        ]);
    }
}
