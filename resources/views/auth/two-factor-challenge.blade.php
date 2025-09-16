@extends('siantik.layouts.blank')

@section('title', 'Verifikasi OTP')

@section('container')
{{-- <div>
    @php dd('Debug di dalam HTML') @endphp
</div> --}}

<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!-- Sisi kiri -->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #990000">
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                <a href="/" class="py-9 mb-5">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-demo13.svg') }}" class="h-80px" />
                </a>
                <h1 class="fw-bolder fs-2qx pb-5" style="color: #FFFFFF;">Verifikasi OTP</h1>
                <p class="fw-bold fs-2" style="color: #F8F8FF;">Masukkan kode dari Google Authenticator Anda.</p>
            </div>
        </div>
    </div>

    <!-- Form OTP -->
    <div class="d-flex flex-column flex-lg-row-fluid bg-light justify-content-center align-items-center p-10">
        <div class="w-md-500px bg-white p-10 rounded shadow-sm">
            <h2 class="fw-bolder text-dark mb-5">Masukkan Kode OTP</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="fw-semibold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mb-5">
                    <label class="form-label required">Kode OTP</label>
                    <input type="text" name="code" inputmode="numeric" autocomplete="one-time-code"
                        class="form-control form-control-solid" required autofocus>
                    <div class="form-text">6 digit dari aplikasi Google Authenticator</div>

                    @error('code')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-danger">Verifikasi</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection