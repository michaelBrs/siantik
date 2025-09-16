@extends('siantik.layouts.main') {{-- sesuaikan dengan layout Metronic Anda --}}

@section('title', 'Jadwal Tahapan')

@section('container')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Kelola Jadwal Tahapan</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo13/dist/index.html" class="text-muted text-hover-primary">Jadwal Tahapan</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('jadwal-tahapan.index') }}'">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
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
                                <h3 class="mb-0">JADWAL & TAHAPAN PEMANTAUAN SPBE {{ $tahunTahapan }}</h3>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('soal.create') }}'">
                                    <i class="fas fa-plus me-1"></i> Tambah Jadwal Tahapan
                                </button>
                            </div>
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
                    {{-- End Notifikasi --}}

                    <div class="table-responsive">
                        <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="kt_table_jadwal_tahapan">
                            <thead>
                                <tr class="text-center text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px">#</th>
                                    <th class="min-w-125px text-start">Nama Tahapan</th>
                                    <th class="min-w-200px">Tanggal Mulai</th>
                                    <th class="min-w-200px">Tanggal Selesai</th>
                                    <th class="min-w-200px">Status</th>
                                    <th class="text-center min-w-100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center text-gray-600 fw-bold"> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            const id_form_penilaian = @json($id_form_penilaian);
            $('#kt_table_jadwal_tahapan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('jadwal-tahapan/data/' . $id_form_penilaian) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_tahapan', name: 'nama_tahapan' },
                    { data: 'tanggal_mulai', name: 'tanggal_mulai' },
                    { data: 'tanggal_selesai', name: 'tanggal_selesai' },
                    { data: 'status', name: 'status' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
                ],
                columnDefs: [
                    {
                        targets: [1],
                        className: 'text-start'
                    }
                ]
            });
        });
    </script>
@endsection