<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomLogoutResponse implements LogoutResponseContract
{
    // public function toResponse($request)
    // {
    //     // Gunakan Auth::guard('web')->logout()
    //     Auth::guard('web')->logout();

    //     // Pastikan session dibersihkan
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/login'); // atau bisa pakai route('login')
    // }


    public function toResponse($request)
    {
        \Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('login.id'); // extra safe
        // $request->session()->flush(); // optional, kalau mau bersih total

        return redirect()->route('login');
    }
}