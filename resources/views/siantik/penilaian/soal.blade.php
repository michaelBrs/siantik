@extends('siantik.layouts.main') {{-- sesuaikan dengan layout Metronic Anda --}}

@section('title', 'Data Soal - Siantik')

@section('container')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">SOAL</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo13/dist/index.html" class="text-muted text-hover-primary">Aspek</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('soal.index') }}'">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10"> 
            <div class="card card-xl-stretch mb-5">
                <!-- Header -->
                <div class="card-body bg-gray-300 text-primary rounded-2 mb-5 py-5" style="background-size: cover;">
                    <h2 class="fw-bold text-black mb-2">ASPEK PERTANYAAN TAHUN {{$tahunSoal}}</h2>
                    <div class="fs-5 fw-semibold">
                        Informasi Aspek & Indikator
                    </div>
                </div>
            
                <!-- Statistik -->
                <div class="row g-4 px-6 pb-6">
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-flask fs-2 text-primary"></i>
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">{{$tahunSoal}}</div>
                            <div class="fs-6 text-gray-600">Tahun</div>
                        </div>
                    </div>
            
                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-university fs-2 text-primary"></i>
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">50</div>
                            <div class="fs-6 text-gray-600">Aspek</div>
                        </div>
                    </div>
            
                    <!-- Card 3 -->
                    <div class="col-md-4">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-dumbbell fs-2 text-primary"></i>
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">500</div>
                            <div class="fs-6 text-gray-600">Indikator</div>
                        </div>
                    </div>
            
                    
                </div>
            </div>       
            <div class="card">
                <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-start flex-wrap">
                    <div class="card-toolbar flex-column w-100">
                        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                            <div class="card-title">
                                <h3 class="mb-0">KELOLA PERTANYAAN ASPEK & INDIKATOR</h3>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('soal.addSoal', $id_tahun_soal) }}'">
                                    <i class="fas fa-plus me-1"></i> Tambah Aspek
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
                    {{-- End Notifikasi --}}

                    <div class="table-responsive">
                        <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="kt_table_soals">
                            <thead>
                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th></th> <!-- tombol expand -->
                                    <th class="text-center">No</th>
                                    <th class="text-start">Aspek</th>
                                    <th class="text-center min-w-100px">Nilai Soal</th>
                                    <th class="text-start">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function formatJawabanTable(soalId) {
            return `
                <div id="jawaban-wrapper-${soalId}">
                    <table class="table table-sm table-hover table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="table-jawaban-${soalId}">
                        <thead >
                            <tr class="text-gray-600 fw-bold text-uppercase text-center">
                                <th style="width: 5%;">#</th>
                                <th style="width: 30%;">Indikator</th>
                                <th style="width: 10%;">Bobot</th>
                                <th style="text-center width: 30%;">Keterangan</th>
                                <th style="text-center width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600"></tbody>
                    </table>
                </div>`;
        }
    
        $(document).ready(function () {
            const soalTable = $('#kt_table_soals').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('soal/data/' . $id_tahun_soal) }}",
                columns: [
                    {
                        className: 'dt-control text-center',
                        orderable: false,
                        data: null,
                        defaultContent: `
                            <a href="javascript:;" class="btn btn-icon btn-sm btn-light-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>`
                    },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'soal', name: 'soal' },
                    { data: 'nilai_soal', name: 'nilai_soal', className: 'text-center' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' },
                ],
                columnDefs: [
                    {
                        targets: [0],
                        className: 'text-center'
                    }
                ]
            });
    
            $('#kt_table_soals tbody').on('click', 'td.dt-control', function () {
                const tr = $(this).closest('tr');
                const row = soalTable.row(tr);
                const rowData = row.data();
    
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.find('td.dt-control i').removeClass('fa-minus-square').addClass('fa-plus-square');
                } else {
                    row.child(formatJawabanTable(rowData.id)).show();
                    tr.find('td.dt-control i').removeClass('fa-plus-square').addClass('fa-minus-square');
    
                    $(`#table-jawaban-${rowData.id}`).DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: `/soal/jawaban/${rowData.id}`,
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                            { data: 'jawaban', name: 'jawaban' },
                            { data: 'bobot_jawaban', name: 'bobot_jawaban' },
                            { data: 'keterangan', name: 'keterangan' },
                            { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' },
                        ],
                        columnDefs: [
                            {
                                targets: [0, 2],
                                className: 'text-center'
                            }
                        ],
                        paging: false,
                        searching: false,
                        info: false,
                        ordering: false
                    });
                }
            });
        });
    </script>
@endsection