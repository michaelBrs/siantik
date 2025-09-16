@extends('siantik.layouts.main') {{-- sesuaikan dengan layout Metronic Anda --}}

@section('title', 'Data Form Penilaian')

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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Daftar Penilaian Mandiri
                </h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">
            {{-- HERO --}}
            <div class="card bg-body border-0 shadow-sm mb-7">
                <div class="card-body p-6 p-lg-8 d-flex flex-column flex-md-row align-items-center justify-content-between"
                    style="background-image: linear-gradient(90deg,#f9f9fb 0%, #fff 50%, #fff 100%);">
                    <div class="d-flex align-items-center mb-5 mb-md-0">
                        <div class="symbol symbol-60px me-4">
                            <span class="symbol-label bg-light-danger">
                                <div class="symbol symbol-150px symbol-square flex-shrink-0">
                                    <img src="{{ asset('assets/media/illustrations/dozzy-1/20.png') }}" alt="logo" />
                                </div>
                            </span>
                        </div>
                        <div>
                            <div class="fs-1 fw-bold text-gray-900">Formulir Penilaian Mandiri</div>
                            <div class="text-gray-600">Informasi proses dan daftar tugas asesmen Anda</div>
                        </div>
                    </div>

                    {{-- KPI mini cards --}}
                    <div class="d-flex gap-8">
                        <div class="card bg-light-primary border-0">
                            <div class="card-body px-6 py-4 text-center">
                                <div class="text-gray-500 mb-1">
                                    <i class="ki-duotone ki-abstract-21 text-primary fs-2x">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <div class="fs-2hx fw-bolder text-primary">{{ $totalFormSatker ?? '-' }}</div>
                                <div class="fs-7 text-primary">Jumlah</div>
                            </div>
                        </div>
                        <div class="card bg-light-success border-0">
                            <div class="card-body px-6 py-4 text-center">
                                <div class="text-success mb-1"> 
                                    <i class="fas fa-unlock text-success fs-4"></i> 
                                </div>
                                <div class="fs-3 fw-bolder text-success">{{ $activeFormSatker ?? '-' }}</div>
                                <div class="fs-7 text-success">Aktif</div>
                            </div>
                        </div>
                        <div class="card bg-light-warning border-0">
                            <div class="card-body px-6 py-4 text-center">
                                <div class="text-warning mb-1">
                                    <i class="fas fa-lock text-warning fs-4"></i> 
                                </div>
                                <div class="fs-3 fw-bolder text-warning">{{ $unActiveFormSatker ?? '-' }}</div>
                                <div class="fs-7 text-warning">Tidak <br> Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-start flex-wrap">
                    <div class="card-toolbar flex-column w-100">
                        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                            <div class="card-title">
                                <h3 class="mb-0">
                                    <span class="me-2">
                                        <div class="symbol symbol-5px symbol-square flex-shrink-0">
                                            <img src="{{ asset('assets/media/icons/duotune/abstract/abs049.svg') }}"
                                                alt="logo" style="width: 25px; height: 25px;" />
                                        </div>
                                    </span>
                                    PENILAIAN MANDIRI
                                </h3>
                            </div>
                            <div class="d-flex gap-2">
                                {{-- <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('formPenilaian.create') }}'">
                                    <i class="fas fa-plus me-1"></i> Tambah Formulir Penilaian
                                </button> --}}
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
                                <button type="button"
                                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto bg-light-success"
                                    data-bs-dismiss="alert">
                                    <img src="assets/media/icons/duotune/abstract/abs012.svg" />
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

                        @if (session('error'))
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                    <!-- Ikon danger -->
                                    <i class="ki-duotone ki-information fs-2x text-danger"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Peringatan!</h4>
                                    <span>{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- End Notifikasi --}}

                        <h7 class="text-gray-400 text-hover-primary fst-italic">*Silakan pilih Formulir yang ingin diisi.
                        </h7>
                        <br> <br>

                        <div class="table-responsive">
                            <table
                                class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7"
                                id="kt_table_formPenilaianSatker">
                                <thead>
                                    <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Wilayah</th>
                                        <th>Nama Form</th>
                                        <th>Indeks Kematangan TIK</th>
                                        <th>Predikat Kematangan TIK</th>
                                        <th>Batas Waktu</th>
                                        <th>Status</th>
                                        <th>Kemajuan</th>
                                        <th>Aksi</th>
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
            $(document).ready(function() {
                const table = $('#kt_table_formPenilaianSatker').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('formPenilaianSatker.getFormPenilaianSatker') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_wilayah',
                            name: 'nama_wilayah'
                        },
                        {
                            data: 'nama_form',
                            name: 'nama_form'
                        },
                        {
                            data: 'indeks_kematangan',
                            name: 'indeks_kematangan'
                        },
                        {
                            data: 'predikat_kematangan',
                            name: 'predikat_kematangan'
                        },
                        {
                            data: 'batas_waktu',
                            name: 'batas_waktu'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'kemajuan',
                            name: 'kemajuan'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    columnDefs: [{
                        targets: [1, 2],
                        className: 'text-center'
                    }]
                });
            });
        </script>

        @push('scripts')
            <script>
                // alert submit data
                $(document).on('click', '.btn-submit-kunci', function(e) {
                    e.preventDefault();

                    const id = $(this).data('id');
                    const form = document.getElementById('form-kunci-' + id);

                    if (!form) {
                        console.warn('Form kunci tidak ditemukan:', '#form-kunci-' + id);
                        return;
                    }

                    Swal.fire({
                        title: '<h2 class="fw-bold text-danger mb-0">Konfirmasi!</h2>',
                        html: `
                            <div class="mt-4 mb-2 text-gray-900">
                                Setelah <strong>dikirim & dikunci</strong>, Anda <b>tidak bisa mengubah data</b> lagi.<br/>
                                Apakah Anda yakin ingin melanjutkan?
                            </div>
                            `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Submit Data',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-light'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            </script>
        @endpush

        
    @endsection
