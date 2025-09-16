@extends('siantik.layouts.blank')

@section('title', 'Verifikasi Email')

@section('container')
<div class="d-flex flex-column flex-column-fluid">
    <div class="d-flex flex-center flex-column flex-column-fluid p-10">
        <div class="card w-md-600px bg-white p-10 shadow-sm">
            <div class="text-center mb-10">
                <img src="{{ asset('media/logos/email-verify.svg') }}" alt="Verify Email" class="mb-6" style="height: 80px;">
                <h1 class="text-dark fw-bolder mb-3">Verifikasi Email Anda</h1>
                <div class="text-gray-600 fw-semibold fs-6">
                    Sebelum melanjutkan, silakan klik link verifikasi yang telah kami kirim ke email Anda.<br>
                    Jika Anda belum menerima email tersebut, klik tombol di bawah ini.
                </div>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                    <i class="ki-duotone ki-check-circle fs-2hx text-success me-4"></i>
                    <div class="d-flex flex-column">
                        <h5 class="mb-1">Tautan Dikirim</h5>
                        <span>Link verifikasi baru telah dikirim ke email Anda.</span>
                    </div>
                </div>
            @endif

            <!-- Form kirim ulang link -->
            <form method="POST" action="{{ route('verification.send') }}" class="mb-5">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    Kirim Ulang Link Verifikasi
                </button>
            </form>

            <!-- Tombol Logout -->
            <div class="d-flex justify-content-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-light-danger">
                        <i class="ki-duotone ki-logout fs-2 me-2"></i>Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection