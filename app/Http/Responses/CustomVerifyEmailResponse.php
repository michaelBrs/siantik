<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;

class CustomVerifyEmailResponse implements VerifyEmailResponseContract
{
    public function toResponse($request)
    {
        return redirect('/password/edit')->with('status', 'Email berhasil diverifikasi. Silakan ubah password Anda.');
    }
}