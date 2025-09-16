@extends('siantik.layouts.blank')

@section('title', 'Lupa Password')

@section('container')
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!-- Bagian Kiri -->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #990000">
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                <a href="/" class="py-9 mb-5">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-demo13.svg') }}" class="h-80px" />
                </a>
                <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #FFFFFF;">Welcome to Siantik</h1>
                <p class="fw-bold fs-2" style="color: #F8F8FF;">Sistem Informasi Asesmen Nilai Tingkat Kematangan Teknologi Informasi dan Komunikasi.</p>
            </div>
            <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                style="background-image: url('{{ asset('assets/media/illustrations/unitedpalms-1/13.png') }}')">
            </div>
        </div>
    </div>

    <!-- Bagian Kanan (Form) -->
    <div class="d-flex flex-column flex-lg-row-fluid bg-light justify-content-center align-items-center p-10">
        <div class="w-md-500px bg-white p-10 rounded shadow-sm">
            <h2 class="fw-bolder text-dark mb-2">Lupa Password?</h2>
            <div class="text-gray-600 fw-semibold mb-7">
                Silahkan masukkan alamat email anda yang sudah terdaftar dan link otomatis akan dikirim untuk mengganti password
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="form-label required">Email</label>
                    <input type="email" name="email" class="form-control form-control-solid" placeholder="Masukan Email" required autofocus>
                </div>

                <!-- reCAPTCHA (dummy, sesuaikan sesuai kebutuhan) -->
                <div class="mb-5">
                    <div class="g-recaptcha" data-sitekey="ISI_SITEKEY_KAMU"></div>
                </div>

                <!-- Tombol -->
                <div class="d-flex flex-stack">
                    <button type="submit" class="btn btn-danger">Kirim Link</button>
                    <a href="{{ route('login') }}" class="btn btn-light">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection