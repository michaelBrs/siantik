@extends('siantik.layouts.main') {{-- sesuaikan dengan layout Metronic Anda --}}

@section('title', 'Penilaian Soal')

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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Daftar Penilaian Mandiri</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary"> {{ $nama_form }} </a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">Aspek</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('formPenilaianSatker.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">
            <div class="card card-flush mb-5">
                <div class="card-body">
                    <div class="row align-items-center">

                        {{-- LEFT: Konten --}}
                        <div class="col-md-8 d-flex align-items-start gap-6">
                            {{-- Logo --}}
                            <div class="symbol symbol-150px symbol-square flex-shrink-0">
                                <img src="{{ asset('assets/media/stock/600x600/img-31.jpg') }}" alt="logo" />
                            </div>

                            {{-- <div class="d-flex flex-column">
                                <div class="d-flex align-items-stretch gap-4 mt-5 flex-wrap">
                                    <div class="border rounded px-5 py-4 min-w-175px">
                                        <div class="d-flex align-items-center gap-2">
                                            <span><img src="{{ asset('assets/media/icons/duotune/maps/map007.svg') }}"
                                                    alt="logo" /></span>
                                            <div class="fw-bold fs-6">5</div>
                                        </div>
                                        <br>
                                        <div class="text-gray-500 fs-8">Jumlah <br> Aspek</div>
                                    </div>
                                    <div class="border rounded px-5 py-4 min-w-175px">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="fw-bold fs-6">
                                                <span><img
                                                        src="{{ asset('assets/media/icons/duotune/abstract/abs041.svg') }}"
                                                        alt="logo" /></span>
                                                25
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-gray-500 fs-8">Jumlah<br>Indikator</div>
                                    </div>
                                </div>
                            </div> --}}
                            @php
                                $progress = (int) preg_replace('/\D/', '', (string) ($progres ?? 0));
                                $progress = max(0, min(100, $progress));

                                if ($progress >= 100) {
                                    $bar = 'white';
                                } elseif ($progress >= 50) {
                                    $bar = 'primary';
                                } else {
                                    $bar = 'warning';
                                }
                            @endphp

                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end w-100 h-150px mb-5 mb-xl-10" 
                            style="background-color: #F1416C;
                                    background-image: url('{{ asset('assets/media/misc/') }}');
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: center;">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">   
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">5</span>
                                        <!--end::Amount-->
                            
                                        <!--begin::Subtitle-->
                                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Aspek {{ $nama_form }}</span>             
                                        <!--end::Subtitle--> 
                                    </div>
                                    <!--end::Title-->         
                                </div>
                                <!--end::Header-->
                            
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-end pt-0">
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                                        <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                            <span>Progres Pengisian</span>
                                            <span>{{ $progress }}%</span>
                                        </div>
                            
                                        <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                            <div class="bg-{{$bar}} rounded h-8px" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>

                        {{-- RIGHT: Ilustrasi --}}
                        <div class="col-md-4 text-end">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/media/illustrations/sketchy-1/2.png') }}" alt="ilustrasi"
                                    style="max-height:220px;" />
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
                                <span>
                                    <div class="symbol symbol-10px symbol-square flex-shrink-0">
                                        <img src="{{ asset('assets/media/illustrations/unitedpalms-1/4.png') }}" alt="logo" />
                                    </div>
                                </span>
                                <h3 class="mb-0"> PENILAIAN ASPEK - <span class="text-primary">{{ strtoupper($nama_form) }}</span> </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body py-3">
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

                    <h7 class="text-gray-400 text-hover-primary fst-italic">*Silakan pilih Aspek yang ingin diisi, kemudian nilai setiap indikator berdasarkan jawaban yang paling sesuai.</h7> 
                    <br> <br>
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7"
                            id="kt_table_penilaian_aspek">
                            <thead>
                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th></th> <!-- tombol expand -->
                                    <th class="text-center">No</th>
                                    <th class="text-start">Aspek</th>
                                    {{-- <th class="text-center min-w-100px">Nilai Aspek</th> --}}
                                    <th class="text-center min-w-100px">Progres Pengisian</th>
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

    {{-- Script untuk memunculkan halaman Aspek --}}
    <script>
        const idFormPenilaianSatker = "{{ $id_formPenilaianSatker }}";

        function formatJawabanTable(soalId) {
            return `
                <div class="py-3">
                    <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="table-jawaban-${soalId}">
                        <thead>
                            <tr class="text-center fw-bold text-uppercase text-gray-600">
                                <th>#</th>
                                <th>Indikator</th>
                                <th>Penilaian Mandiri</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600"></tbody>
                    </table>
                </div>`;
        }

        $(document).ready(function() {
            const soalTable = $('#kt_table_penilaian_aspek').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('formPenilaianSatker.getPenilaianSoal', $id_formPenilaianSatker) }}",
                columns: [{
                        className: 'dt-control text-center',
                        orderable: false,
                        data: null,
                        defaultContent: `<a href="javascript:;" class="btn btn-icon btn-sm btn-light-primary"><i class="fas fa-plus-square"></i></a>`
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'soal',
                        name: 'soal'
                    },
                    // {
                    //     data: 'nilai',
                    //     name: 'nilai',
                    //     className: 'text-center'
                    // },
                    {
                        data: 'progres',
                        name: 'progres'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });

            $('#kt_table_penilaian_aspek tbody').on('click', 'td.dt-control', function() {
                const tr = $(this).closest('tr');
                const row = soalTable.row(tr);
                const rowData = row.data();
                const soalId = rowData.id;

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.find('td.dt-control i').removeClass('fa-minus-square').addClass('fa-plus-square');
                } else {
                    row.child(formatJawabanTable(soalId)).show();
                    tr.find('td.dt-control i').removeClass('fa-plus-square').addClass('fa-minus-square');

                    const tableId = `#table-jawaban-${soalId}`;
                    console.log('Loading nested table: ', tableId);

                    // Destroy jika sebelumnya sudah ada
                    if ($.fn.DataTable.isDataTable(tableId)) {
                        $(tableId).DataTable().clear().destroy();
                    }

                    // Load jawaban berdasarkan soal & form_penilaian_satker
                    $(tableId).DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: `/formPenilaianSatker/penilaianSoal/jawaban/${soalId}`,
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'jawaban',
                                name: 'jawaban'
                            },
                            // {
                            //     data: 'bobot_jawaban',
                            //     name: 'bobot_jawaban',
                            //     className: 'text-center'
                            // },
                            {
                                data: 'aksi',
                                name: 'aksi',
                                orderable: false,
                                searchable: false,
                                className: 'text-center'
                            },
                        ],
                        columnDefs: [{
                            targets: [0],
                            className: 'text-center'
                        }],
                        paging: false,
                        searching: false,
                        info: false,
                        ordering: false
                    });
                }
            });
        });
    </script>

    {{-- Script untuk modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('click', '.btn-penjelasan-indikator', function() {
                let id = $(this).data('id');
                let indikator = $(this).data('indikator');

                // Misal isi modal
                $('#kt_modal_penjelasan_indikator input[name="id_soal"]').val(id);
                $('#kt_modal_penjelasan_indikator .indikator-text').text(indikator);
            });
        });
    </script>


    {{-- Mengisi Tabel Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('click', '.btn-penjelasan-indikator', function() {
                const idSoal = $(this).data('id');
                const tbody = $('#indikator-jawaban-body');
                // tbody.html('<tr><td colspan="3" class="text-center">Loading...</td></tr>'); 

                $.get(`/jawaban/by-soal/${idSoal}`, function(data) {
                    let html = '';

                    if (data.length === 0) {
                        html =
                            '<tr><td colspan="3" class="text-center text-muted">Tidak ada data jawaban.</td></tr>';
                    } else {
                        data.forEach(function(item) {
                            html += `
                                <tr>
                                    <td class="text-center align-top">${item.tingkat}</td>
                                    <td class="text-gray-700">${item.deskripsi ?? '-'}</td>
                                    <td class="text-center">
                                        <input type="radio" name="mandiri" class="form-check-input" value="${item.tingkat}" />
                                    </td>
                                </tr>`;
                        });
                    }

                    tbody.html(html);
                });
            });
        });
    </script>

@endsection
