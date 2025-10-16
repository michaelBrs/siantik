@extends('siantik.layouts.main')

@section('title', 'Input Data SDM TIK - Siantik')

@section('container')
    <!-- Toolbar -->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true"
                data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Input Data SDM TIK</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Manajemen SDM</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Input Data SDM</li>
                </ul>
            </div>
        </div>
    </div>

    @php
        // dd($pertanyaan);
    @endphp

    <!-- Content -->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Input Data SDM TIK</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('formPenilaianSatker.simpanProfilling') }}">
                        @csrf
                        <input type="hidden" name="form_penilaian_satker_id" value="{{ $id_formPenilaianSatker }}">

                        @foreach ($pertanyaan as $p)
                            <div class="mb-5">
                                <label class="required form-label fw-bold">{{ $p->keterangan }}</label>
                                <div class="form-text mb-2">{{ $p->pertanyaan }}</div>

                                {{-- Jika ini pertanyaan keahlian (id = 4), tampilkan multi checkbox --}}
                                @if ($p->id == 4)
                                    @foreach ($p->keahlians as $index => $item)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="jawaban[{{ $p->id }}][]" value="{{ $item->keahlian }}" id="keahlian_{{ $index }}" {{ $index == 0 ? 'required' : '' }}>
                                            <label class="form-check-label" for="keahlian_{{ $index }}">{{ $item->keahlian }}</label>
                                        </div>
                                    @endforeach

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="keahlianLain" onchange="document.getElementById('keahlianLainnyaInput').disabled = !this.checked; input.required = this.checked;">
                                        <label class="form-check-label" for="keahlianLain">Lainnya</label>
                                    </div>
                                    <input type="text" id="keahlianLainnyaInput" name="keterangan[{{ $p->id }}]" class="form-control form-control-solid mt-2" placeholder="Sebutkan lainnya..." disabled>

                                {{-- Jika ini pertanyaan pelatihan (id = 5), tampilkan multi checkbox --}}
                                @elseif ($p->id == 5)
                                    @foreach ($p->pelatihans as $index => $item)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="jawaban[{{ $p->id }}][]" value="{{ $item->pelatihan }}" id="pelatihan_{{ $index }}" {{ $index == 0 ? 'required' : '' }}>
                                            <label class="form-check-label" for="pelatihan_{{ $index }}">{{ $item->pelatihan }}</label>
                                        </div>
                                    @endforeach

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="pelatihanLain" onchange="document.getElementById('pelatihanLainnyaInput').disabled = !this.checked; input.required = this.checked;">
                                        <label class="form-check-label" for="pelatihanLain">Lainnya</label>
                                    </div>
                                    <input type="text" id="pelatihanLainnyaInput" name="keterangan[{{ $p->id }}]" class="form-control form-control-solid mt-2" placeholder="Sebutkan lainnya..." disabled>

                                {{-- Pertanyaan biasa: gunakan input number/text --}}
                                @else
                                    <input type="text" name="jawaban[{{ $p->id }}]" class="form-control form-control-solid" value="{{ old('jawaban.' . $p->id) }}" required>
                                @endif
                            </div>
                        @endforeach

                        <!-- Tombol Aksi -->
                        <div class="text-end mt-10">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
                                <i class="ki-duotone ki-arrow-left fs-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection