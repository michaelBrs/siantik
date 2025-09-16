<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class CustomVerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Cek hash email
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Link verifikasi tidak valid.');
        }

        // Jika sudah diverifikasi dan sudah ganti password, langsung ke dashboard
        if ($user->hasVerifiedEmail() && $user->is_password_changed) {
            return redirect()->route('dashboard')->with('info', 'Email sudah diverifikasi.');
        }

        // Auto-login
        // Auth::login($user); --Old
        // dd(Auth::user());

        // Cek dan tandai sebagai verified
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silakan login.');
        // return redirect()->route('password.edit')->with('success', 'Email berhasil diverifikasi. Silakan ubah password Anda.'); --Old
    }
}
