<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class CustomTwoFactorLoginResponse implements TwoFactorLoginResponseContract
{
    public function toResponse($request)
    {
        // OTP valid → tandai sudah lolos challenge & bersihkan tiket
        $request->session()->forget('login.id');
        $request->session()->put('2fa_passed', true);

        return redirect()->intended(config('fortify.home', '/dashboard'));
    }
}