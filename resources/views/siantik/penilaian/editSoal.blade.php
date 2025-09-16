@extends('siantik.layouts.main')

@section('title', 'Siantik - Ubah Aspek')

@section('container')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Soal</h1>
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Aspek</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">Edit Aspek</li>
            </ul>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid px-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Aspek</h3>
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

                <form method="POST" action="{{ route('soal.updateSoal', $soal->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-5">
                        <div class="mb-5">
                            <label class="required form-label">Tahun Soal</label>
                            <select class="form-select form-select-solid" data-control="select2" name="tahunSoal" id="tahunSoal">
                                <option value="">Pilih Tahun soal</option>
                                @foreach ($dataTahunSoal as $tahunSoal)
                                    <option value="{{ $tahunSoal->id }}" {{ old('tahunSoal', $soal->id_tahun_soal ?? '') == $tahunSoal->id ? 'selected' : '' }}>
                                        {{ $tahunSoal->deskripsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Soal</label>
                                <input type="text" name="soal" class="form-control form-control-solid"
                                    value="{{ old('soal', $soal->soal) }}" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Nilai Per Soal</label>
                                <input type="number" step="0.01" name="nilai_soal" class="form-control form-control-solid"
                                    value="{{ old('nilai_soal', $soal->nilai_soal) }}" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Nilai Target/Standar</label>
                                <input type="number" step="0.01" name="nilai_target" class="form-control form-control-solid"
                                    value="{{ old('nilai_target', $soal->nilai_target) }}" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control form-control-solid" rows="4" required>{{ old('keterangan', $soal->keterangan) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('soal.showSoal', $soal->id_tahun_soal) }}" class="btn btn-secondary me-2">
                            <i class="ki-duotone ki-arrow-left fs-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-check fs-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection