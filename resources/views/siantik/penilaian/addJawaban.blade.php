@extends('siantik.layouts.main')

@section('title', 'Siantik - Tambah Indikator')

@section('container')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Tambah Indikator</h1>
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('soal.showJawaban', $id_soal) }}" class="text-muted text-hover-primary">Daftar Indikator</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">Tambah Indikator</li>
            </ul>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid px-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Indikator</h3>
            </div>
            <div class="card-body">
                {{-- Cek Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('jawaban.storeJawaban') }}">
                    @csrf
                    <input type="hidden" name="id_soal" value="{{ $id_soal }}">

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Indikator</label>
                                <input type="text" name="jawaban" class="form-control form-control-solid"
                                    value="{{ old('jawaban') }}" required />
                            </div>

                            <div class="mb-5">
                                <label class="required form-label">Bobot</label>
                                <input type="number" step="0.01" name="bobot_jawaban" class="form-control form-control-solid"
                                    value="{{ old('bobot_jawaban') }}" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Keterangan Indikator</label>
                                <textarea name="keterangan" class="form-control form-control-solid" rows="4" required>{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="text-end">
                            <a href="{{ route('soal.showJawaban', $id_soal) }}" class="btn btn-secondary me-2">
                                <i class="ki-duotone ki-arrow-left fs-2"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ki-duotone ki-check fs-2"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection