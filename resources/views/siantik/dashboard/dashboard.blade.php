@extends('siantik.layouts.main')

@section('title', 'Siantik - Welcome')

@section('container')

<style>
    .marquee-wrapper {
        width: 100%;
        overflow: hidden;
        position: relative;
    }

    .text-marquee {
        display: inline-block;
        white-space: nowrap;
        font-size: 1.1rem;
        padding-right: 70%; /* penting: beri ruang agar benar2 keluar */
        animation: marquee 50s linear infinite;
    }

    @keyframes marquee {
        0%   { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
</style>
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Welcome</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark"></li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-5">
            <div class="card shadow-sm border-0 mb-10">
                <div class="symbol symbol-70px symbol-rounded flex-shrink-0">
                    {{-- <img src="{{ asset('assets/media/avatars/gedungKpu3D.png') }}" alt="logo" style="width: 100%; height: 120%; object-fit: cover; opacity: 0.7;" /> --}}
                    <img src="{{ asset('assets/media/avatars/gedungKpu3D.png') }}" alt="logo" style="width: 100%; height: 120%; object-fit: cover; opacity: 0.8;" />
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-0 d-flex flex-column justify-content-center align-items-center bg-dark bg-opacity-10">
                    <div class="w-100 d-flex flex-column bg-dark bg-opacity-0 justify-content-center align-items-center">
                        <h1></h1>
                        <h1 class="fw-bolder text-white fs-1 fs-lg-2qx mb-3 p-2" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); background-color:rgba(149, 7, 7, 0.5);">SELAMAT DATANG</h1>
                        {{-- <br> --}}
                        <h1 class="fw-bolder text-white fs-1 fs-lg-2qx mb-3 p-2" style="text-shadow: 2px 2px 4px rgba(182, 16, 16, 0.5); background-color:rgba(149, 7, 7, 0.5);"> 
                            di Sistem Informasi Assesmen Nilai Tingkat Kematangan TIK
                        </h1>
                        <br>
                        {{-- <p class="text-white fw-bold fs-5 fs-lg-2" style="opacity:0.8;">KOMISI PEMILIHAN UMUM REPUBLIK INDONESIA</p> --}}
                    </div>
                </div>
                <div class="card-footer text-center py-5 bg-light rounded-bottom overflow-hidden">
                    <div class="marquee-wrapper">
                        <span class="text-marquee fw-semibold text-gray-700">
                            Silakan lakukan Asesmen Penilaian kematangan Teknologi Informasi & Komunikasi.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
