@extends('siantik.layouts.blank')

@section('title', 'Konfirmasi Password')

@section('container')
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!-- Sidebar / Branding -->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #990000">
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                <a href="/" class="py-9 mb-5">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-demo13.svg') }}" class="h-80px" />
                </a>
                <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #FFFFFF;">Welcome to Siantik</h1>
                <p class="fw-bold fs-2" style="color: #F8F8FF;">Konfirmasi Password Anda</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="d-flex flex-column flex-lg-row-fluid bg-light justify-content-center align-items-center p-10">
        <div class="w-md-500px bg-white p-10 rounded shadow-sm">

            <h2 class="fw-bolder text-dark mb-5">Konfirmasi Password</h2>

            <p class="text-gray-600 fw-semibold mb-5">Area ini aman. Silakan konfirmasi password Anda untuk melanjutkan.</p>

            <!-- Menampilkan error validasi -->
            @if ($errors->any())
                <div class="alert alert-danger mb-5">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="fw-semibold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Notifikasi sukses jika ada -->
            @if (session('status'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('status') }}',
                    confirmButtonColor: '#990000'
                });
            </script>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" onsubmit="this.querySelector('button').disabled = true;">
                @csrf

                <!-- Input Password -->
                <div class="mb-5">
                    <label class="form-label required" for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-control form-control-solid" required autocomplete="current-password" autofocus>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-danger">
                        Konfirmasi
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        let pw = document.querySelector('input[name=password]');
        if (pw.value.trim().length < 8) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Password harus minimal 8 karakter.'
            });
        }
    });
</script>