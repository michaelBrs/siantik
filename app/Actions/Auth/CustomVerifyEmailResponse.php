<?php

namespace App\Actions\Auth;

use Laravel\Fortify\Contracts\VerifyEmailResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class CustomVerifyEmailResponse implements VerifyEmailResponse
{
    public function toResponse($request)
    {
        // Jika belum login, login user berdasarkan ID dari URL
        if (!Auth::check()) {
            $userId = $request->route('id');
            Auth::loginUsingId($userId); // auto login
        }

        // Redirect langsung ke ubah password
        return redirect()->to(RouteServiceProvider::HOME);
    }
}