<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {

        // Jika tiket 2FA masih ada, jangan ke dashboard
        if (session()->has('login.id')) {
            return redirect()->route('two-factor.login');
        }

        // 1) WAJIB ganti password terlebih dahulu
        if (isset($user->is_password_changed) && ! $user->is_password_changed) {
            return redirect()->route('password.edit');
        }

        // 2) WAJIB 2FA aktif & terkonfirmasi
        $needs2FA = empty($user->two_factor_secret) || is_null($user->two_factor_confirmed_at);
        if ($needs2FA) {
            // tetap di halaman setup (scan + form konfirmasi)
            return redirect()->route('two-factor.setup');
        }

        // 3) 2FA aktif → buat tiket challenge kalau belum ada
        if (! session()->has('login.id')) {
            session()->forget('2fa_passed');                  // reset status 2FA untuk sesi baru
            session()->put('login.id', $user->getAuthIdentifier());
            return redirect()->route('two-factor.login');
        }

        

        // 4) aman → dashboard
        return redirect()->intended(config('fortify.home', '/'));
    }
}