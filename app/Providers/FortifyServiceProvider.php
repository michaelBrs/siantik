<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Http\Responses\CustomLoginResponse;
use App\Http\Responses\CustomTwoFactorLoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Http\Responses\CustomLogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Login response kustom (opsional, oke)
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\CustomLoginResponse::class
        );

        // TwoFactorLoginResponse kustom (opsional, untuk redirect setelah OTP benar)
        $this->app->singleton(
            \Laravel\Fortify\Contracts\TwoFactorLoginResponse::class,
            \App\Http\Responses\CustomTwoFactorLoginResponse::class
        );

        // Logout response kustom (oke)
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LogoutResponse::class,
            \App\Http\Responses\CustomLogoutResponse::class
        );

        // $this->app->singleton(
        //     \Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse::class,
        //     \App\Http\Responses\CustomTwoFactorChallengeViewResponse::class
        // );
    }

    public function boot(): void
    {
        // … create/update/reset user actions …

        // Pakai blade kustom untuk halaman challenge
        Fortify::twoFactorChallengeView(fn () => view('auth.two-factor-challenge'));

        // Pipeline login: pastikan ada $next($request)
        Fortify::authenticateThrough(function ($request) {
            return [
                \Laravel\Fortify\Actions\EnsureLoginIsNotThrottled::class,
                \Laravel\Fortify\Actions\AttemptToAuthenticate::class,

                // Tambahan: set tiket challenge bila 2FA aktif & sudah confirmed
                function ($request, $next) {
                    if (($user = $request->user())
                        && $user->two_factor_secret
                        && $user->two_factor_confirmed_at
                        && ! session()->has('login.id')) {
                        session()->put('login.id', $user->getAuthIdentifier());
                    }
                    return $next($request); // <- WAJIB
                },

                \Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable::class,
                \Laravel\Fortify\Actions\PrepareAuthenticatedSession::class,
            ];
        });

        // Rate limiter (oke)
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
