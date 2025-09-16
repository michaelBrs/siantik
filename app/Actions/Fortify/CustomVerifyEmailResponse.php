<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\VerifyEmailResponse;
use Illuminate\Http\RedirectResponse;

class CustomVerifyEmailResponse implements VerifyEmailResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('password.edit')->with('status', 'Email Anda berhasil diverifikasi. Silakan ubah password default Anda.');
    }
}