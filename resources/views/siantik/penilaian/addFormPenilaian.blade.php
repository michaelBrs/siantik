@extends('siantik.layouts.main')

@section('title', 'Siantik - Tambah Form Penilaian')

@section('container')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Formulir</h1>
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Tambah Formulir Penilaian</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">Tambah</li>
            </ul>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid px-10">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h3 class="card-title fw-bold">Tambah Formulir Penilaian</h3>
            </div>

            {{-- Form Create --}}
            <form action="{{ route('formPenilaian.store') }}" method="POST">
                @csrf
                <div class="card-body py-4">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="required form-label">Tahun</label>
                            <input type="number" name="tahun" class="form-control form-control-solid" 
                                   value="{{ old('tahun') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label">Nama Form</label>
                            <input type="text" name="nama_form" class="form-control form-control-solid" 
                                   value="{{ old('nama_form') }}" required>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="required form-label">Tahap Form</label>
                            <input type="text" name="tahap_form" class="form-control form-control-solid" 
                                   value="{{ old('tahap_form') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label">Versi Soal</label>
                            <select class="form-select form-select-solid" data-control="select2" name="tahunSoal" id="tahunSoal">
                                <option value="">Pilih Versi soal</option>
                                @foreach ($tahunSoals as $tahunSoal)
                                    <option value="{{ $tahunSoal->id }}" {{ old('tahunSoal') == $tahunSoal->id ? 'selected' : '' }}>
                                        {{ $tahunSoal->deskripsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="required form-label">Waktu Mulai</label>
                            <input type="date" name="waktu_mulai" class="form-control form-control-solid" 
                                   value="{{ old('waktu_mulai') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label">Batas Waktu</label>
                            <input type="date" name="batas_waktu" class="form-control form-control-solid" 
                                   value="{{ old('batas_waktu') }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="required form-label">Status</label>
                            <select class="form-select form-select-solid" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control form-control-solid" rows="3">{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('formPenilaian.index') }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" class="btn btn-primary">
                         <i class="ki-duotone ki-check fs-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection