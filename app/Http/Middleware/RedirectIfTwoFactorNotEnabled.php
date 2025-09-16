<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfTwoFactorNotEnabled
{
    // rute yang TIDAK boleh diinterupsi oleh gate 2FA
    protected array $except = [
        // halaman & endpoint 2FA (GET/POST)
        'two-factor/setup',
        'two-factor-challenge',
        'two-factor-challenge*',                 // penting: POST juga lolos
        'user/two-factor-authentication',        // enable/disable (POST/DELETE)
        'user/confirmed-two-factor-authentication', // konfirmasi (POST)
        'user/two-factor-recovery-codes',        // regenerate (POST)
        'user/two-factor-qr-code',               // GET (opsional)
        'user/two-factor-secret-key',            // GET (opsional)

        // logout dan halaman ubah password biar tidak loop
        'logout',
        'password/edit',
        'password/update',
    ];

    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            dump([
                'user_id'    => auth()->id(),
                'login.id'   => session('login.id'),
                '2fa_passed' => session('2fa_passed'),
                'route'      => $request->path(),
            ]);
            return $next($request);
        }

        $user = $request->user();

        // Jika kamu mewajibkan ganti password dulu, JANGAN kunci 2FA
        if (isset($user->is_password_changed) && ! $user->is_password_changed) {
            return $next($request);
        }

        // status 2FA
        $isEnabled   = ! empty($user->two_factor_secret) && ! is_null($user->two_factor_confirmed_at);
        $hasTicket   = (bool) $request->session()->has('login.id');       // belum lulus challenge
        $passed2FA   = (bool) $request->session()->get('2fa_passed', false);

        // kalau sudah lulus, pastikan tiket dibersihkan (sekali saja)
        if ($passed2FA && $hasTicket) {
            $request->session()->forget('login.id');
        }

        // rute pengecualian
        $isExcept = $request->is($this->except)
                  || $request->routeIs('two-factor.setup', 'two-factor.login', 'password.edit', 'password.update');

        // WAJIB setup (belum aktif/terkonfirmasi)
        if (! $isEnabled && ! $isExcept) {
            return redirect()->route('two-factor.setup');
        }

        // WAJIB challenge (aktif & terkonfirmasi, tapi sesi belum lulus OTP)
        if ($isEnabled && ! $passed2FA && $hasTicket && ! $isExcept) {
            return redirect()->route('two-factor.login');
        }

        \Log::info('2FA-GATE', [
            'path'        => $request->path(),
            'except'      => $request->is($this->except),
            'login_id'    => $request->session()->get('login.id'),
            '2fa_passed'  => $request->session()->get('2fa_passed'),
            'enabled'     => $is2faEnabled,
            'action'      => $mustSetup ? 'redirect:setup' :
                            ($mustChallenge ? 'redirect:challenge' : 'next'),
        ]);

        return $next($request);
    }
}