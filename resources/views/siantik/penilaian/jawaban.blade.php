@extends('siantik.layouts.main') {{-- sesuaikan dengan layout Metronic Anda --}}

@section('title', 'Data Tahun Soal')

@section('container')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Soal</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Aspek</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Indikator</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <div class="d-flex gap-2">
                <a href="{{ route('soal.show', $idTahunSoal) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">        
            <div class="card">
                <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-start flex-wrap">
                    <div class="card-toolbar flex-column w-100">
                        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                            <div class="card-title">
                                <h3 class="mb-0">INDIKATOR</h3>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('soal.create') }}'">
                                    <i class="fas fa-plus me-1"></i> Tambah Indikator
                                </button>
                            </div>
                    </div>
                </div>

                <div class="card-body py-4">
                    {{-- Notifikasi --}}
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                <!-- Ikon Success -->
                                <i class="ki-duotone ki-check-circle fs-2x text-success"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-success">Berhasil!</h4>
                                <span>{{ session('success') }}</span>
                            </div>
                            <!--begin::Close-->
                            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto bg-light-success" data-bs-dismiss="alert">
                                <img src="assets/media/icons/duotune/abstract/abs012.svg"/>
                            </button>
                            <!--end::Close-->
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning d-flex align-items-center p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-warning me-4">
                                <!-- Ikon Warning -->
                                <i class="ki-duotone ki-information fs-2x text-warning"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-warning">Peringatan!</h4>
                                <span>{{ session('warning') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (session('successHapus'))
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                <!-- Ikon danger -->
                                <i class="ki-duotone ki-information fs-2x text-danger"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Peringatan!</h4>
                                <span>{{ session('successHapus') }}</span>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                <!-- Ikon danger -->
                                <i class="ki-duotone ki-information fs-2x text-danger"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Peringatan!</h4>
                                <span>{{ session('successHapus') }}</span>
                            </div>
                        </div>
                    @endif
                    {{-- End Notifikasi --}}

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_jawaban">
                            <thead>
                                <tr>
                                    <th colspan="5" class="text-start text-dark fw-bold fs-4 py-3 bg-light-primary">
                                        Aspek : <i class="fas fa-book"></i>  {{ $jawabanSoal }}
                                    </th>
                                </tr>
                                <tr class="text-center text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px">No</th>
                                    <th class="min-w-125px text-center">Jawaban</th>
                                    <th class="min-w-200px">Bobot Jawaban</th>
                                    <th class="min-w-200px">Keterangan</th>
                                    <th class="text-center min-w-100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-start text-gray-600 fw-bold"> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            const id_soal = @json($id_soal);
            $('#kt_table_jawaban').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('soal.getJawaban', ['id_soal' => $id_soal]) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'jawaban', name: 'jawaban' },
                    { data: 'bobot_jawaban', name: 'bobot_jawaban' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
                ],
                columnDefs: [
                    {
                        targets: [0],
                        className: 'text-center'
                    },
                    {
                        targets: [2],
                        className: 'text-center'
                    }
                ]
            });
        });
    </script>
@endsection