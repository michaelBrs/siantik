@extends('siantik.layouts.blank')

@section('title', 'Setup OTP')

@section('container')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!-- Kiri -->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color:#990000">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                    <a href="/" class="py-9 mb-5">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo-demo13.svg') }}" class="h-80px" />
                    </a>
                    <h1 class="fw-bolder fs-2qx pb-5 text-white">Setup Two Factor Authentication</h1>
                    <p class="fw-bold fs-2" style="color:#F8F8FF;">Gunakan Google Authenticator untuk keamanan ganda.</p>
                </div>
            </div>
        </div>

        <!-- Konten -->
        <div class="d-flex flex-column flex-lg-row-fluid bg-light justify-content-center align-items-center p-10">
            <div class="w-md-500px bg-white p-10 rounded shadow-sm">
                <h2 class="fw-bolder text-dark mb-5">Two‑Factor Authentication</h2>

                {{-- flash status dari Fortify (optional) --}}
                @if (session('status'))
                    <div class="alert alert-success mb-6">{{ session('status') }}</div>
                @endif

                {{-- error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-6">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="fw-semibold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php $user = auth()->user(); @endphp

                {{-- BELUM AKTIF: tombol aktifkan --}}
                @if (!$user->two_factor_secret)
                    <p class="mb-5">Klik tombol di bawah untuk mengaktifkan OTP menggunakan aplikasi Google Authenticator.
                    </p>

                    <form method="POST" action="{{ url('/user/two-factor-authentication') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Aktifkan OTP</button>
                    </form>
                @else
                    

                    {{-- BELUM TERKONFIRMASI: minta input kode OTP --}}
                    @if (is_null($user->two_factor_confirmed_at))
                        {{-- SUDAH AKTIF: tampilkan QR --}}
                        <div class="mb-6">
                            <p class="mb-3">Pindai kode QR ini di aplikasi Google Authenticator:</p>
                            <div class="d-flex justify-content-center">{!! $user->twoFactorQrCodeSvg() !!}</div>
                        </div>

                        <div class="mb-6">
                            <form method="POST" action="{{ url('/user/confirmed-two-factor-authentication') }}">
                                @csrf
                                <label class="form-label">Kode OTP</label>
                                <input type="text" name="code" class="form-control form-control-solid"
                                    inputmode="numeric" autocomplete="one-time-code" required autofocus>
                                <div class="form-text">Masukkan 6 digit dari Google Authenticator lalu tekan konfirmasi.
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Konfirmasi</button>
                            </form>
                        </div>
                    @else
                        {{-- SUDAH TERKONFIRMASI: tampilkan recovery codes + aksi --}}
                        <div class="alert alert-success mb-6">OTP sudah dikonfirmasi.</div>

                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary ms-auto">Selesai</a>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection
