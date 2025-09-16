@extends('siantik.layouts.blank')

@section('title', 'Ubah Password')

@section('container')
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!-- Sisi kiri (opsional, bisa dihapus jika tidak dibutuhkan) -->
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

    <!-- Form Ubah Password -->
    <div class="d-flex flex-column flex-lg-row-fluid bg-light justify-content-center align-items-center p-10">
        <div class="w-md-500px bg-white p-10 rounded shadow-sm">

            <h2 class="fw-bolder text-dark mb-5">Ubah Password</h2>

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                    <i class="ki-duotone ki-check-circle fs-2hx text-success me-4"></i>
                    <div class="d-flex flex-column">
                        <h5 class="mb-1">Berhasil</h5>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <!-- Password Baru -->
                <div class="mb-5">
                    <label class="form-label required">Password Baru</label>
                    <input type="password" name="password" class="form-control form-control-solid" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi -->
                <div class="mb-5">
                    <label class="form-label required">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-solid" required>
                </div>

                <!-- Tombol Simpan -->
                <div class="text-end">
                    <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection