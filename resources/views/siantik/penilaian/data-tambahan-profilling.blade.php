@extends('siantik.layouts.main')

@section('title', 'Data Tambahan Profilling - Siantik')

@section('container')

<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">PROFILLING</h1>
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">Data Tambahan</li>
            </ul>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('soal.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid px-10">
        <div class="card">
            <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-start flex-wrap">
                <div class="card-title">
                    <h3 class="mb-0">Data Tambahan Profilling - Tahun Soal: {{ $id_tahun_soal }}</h3>
                </div>
            </div>

            <div class="card-body py-4">
                @foreach($data as $item)
                    <div class="card card-flush mt-4">
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">{{ $item['keterangan'] }}</h5>
                            <p class="text-muted mb-4">{{ $item['pertanyaan'] }}</p>

                            @if ($item['id'] == 4)
                                <h6 class="fw-semibold">Data Keahlian</h6>
                                <ul class="mb-3">
                                    @forelse($item['keahlians'] as $k)
                                        <li><strong>{{ $k->keahlian }}</strong>: {{ $k->keterangan }}</li>
                                    @empty
                                        <li class="text-muted">Tidak ada data keahlian</li>
                                    @endforelse
                                </ul>
                            @endif

                            @if ($item['id'] == 5)
                                <h6 class="fw-semibold">Kebutuhan Pelatihan</h6>
                                <ul class="mb-3">
                                    @forelse($item['pelatihans'] as $p)
                                        <li><strong>{{ $p->pelatihan }}</strong>: {{ $p->keterangan }}</li>
                                    @empty
                                        <li class="text-muted">Tidak ada data pelatihan</li>
                                    @endforelse
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--end::Content-->

@endsection