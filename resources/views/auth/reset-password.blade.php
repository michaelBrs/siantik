@extends('siantik.layouts.blank')

@section('title', 'Reset Password')

@section('container')
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!-- Kiri: Branding -->
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

    <!-- Kanan: Form Reset Password -->
    <div class="d-flex flex-column flex-lg-row-fluid bg-light justify-content-center align-items-center p-10">
        <div class="w-md-500px bg-white p-10 rounded shadow-sm">

            <h2 class="fw-bolder text-dark mb-5">Reset Password</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="fw-semibold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <!-- Token reset -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-5">
                    <label class="form-label required">Email</label>
                    <input type="email" name="email" class="form-control form-control-solid" 
                        value="{{ old('email', $request->email) }}" required autofocus>
                </div>

                <!-- Password Baru -->
                <div class="mb-5">
                    <label class="form-label required">Password Baru</label>
                    <input type="password" name="password" class="form-control form-control-solid" required>
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-5">
                    <label class="form-label required">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-solid" required>
                </div>

                <!-- Tombol Reset -->
                <div class="text-end">
                    <button type="submit" class="btn btn-danger">Reset Password</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection