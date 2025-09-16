@extends('siantik.layouts.main')

@section('title', 'Siantik - Tambah Soal')

@section('container')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase"> Soal</h1>
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('soal.index') }}" class="text-muted text-hover-primary">Tambah Soal</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark"></li>
            </ul>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid px-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Soal</h3>
            </div>

            <div class="card-body">
                {{-- Cek Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('soal.store') }}">
                    @csrf

                    <div class="mb-5">
                        <label class="required form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control form-control-solid"
                            value="{{ old('tahun') }}" required>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control form-control-solid" rows="4">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('soal.index') }}" class="btn btn-secondary me-2">
                            <i class="ki-duotone ki-arrow-left fs-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-check fs-2"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection