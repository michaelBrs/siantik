<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class VerifyEmailController extends Controller
{
    // public function __invoke(EmailVerificationRequest $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return redirect()->route('password.edit'); // Sudah verifikasi
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return redirect()->route('password.edit'); // Baru selesai verifikasi
    // }

    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('password.edit');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            auth()->login($request->user()); // Login otomatis
        }

        return redirect()->route('password.edit');
    }

    
}
