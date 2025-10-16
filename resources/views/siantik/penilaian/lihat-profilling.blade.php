@extends('siantik.layouts.main')

@section('title', 'Lihat Data Profilling')

@section('container')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Data Profilling</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary"> </a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary"></a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('formPenilaianSatker.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Profilling - {{ $form->formPenilaian->nama_form ?? '-' }}</h3>
                </div>
                <div class="card-body">

                    @foreach ($pertanyaans as $pertanyaan)
                        @php
                            $jawaban = $jawabanMap[$pertanyaan->id] ?? null;
                            $isMultiple = false;
                            $hasilJawaban = null;

                            if ($jawaban && $jawaban->jawaban) {
                                $isMultiple = is_array(json_decode($jawaban->jawaban, true));
                                $hasilJawaban = $isMultiple ? json_decode($jawaban->jawaban, true) : $jawaban->jawaban;
                            }
                        @endphp

                        <div class="mb-6">
                            <label class="form-label fw-bold">{{ $pertanyaan->keterangan }}</label>
                            <div class="form-text mb-2">{{ $pertanyaan->pertanyaan }}</div>

                            @if ($isMultiple)
                                <ul class="ps-4">
                                    @foreach ($hasilJawaban as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="fw-semibold">{{ $hasilJawaban ?? '-' }}</div>
                            @endif

                            @if ($jawaban && $jawaban->keterangan)
                                <div class="mt-2"><i>Keterangan: {{ $jawaban->keterangan }}</i></div>
                            @endif
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection