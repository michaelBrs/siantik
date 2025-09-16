<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomTwoFactorChallengeViewResponse implements TwoFactorChallengeViewResponse
{
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse(['two_factor' => true]);
        }

        // PASTIKAN path ini sesuai blade kamu
        return response()->view('auth.two-factor-challenge');
    }
}