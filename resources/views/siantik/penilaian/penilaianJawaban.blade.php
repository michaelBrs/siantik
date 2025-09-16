@extends('siantik.layouts.main') {{-- sesuaikan dengan layout Metronic Anda --}}

@section('title', 'Penilaian Jawaban')

@section('container')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ strtoupper($nama_form) }}</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('formPenilaianSatker.getPenilaianSoalPage', $id_formPenilaianSatker) }}" class="text-muted text-hover-primary">{{$nama_form}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('formPenilaianSatker.getPenilaianSoalPage', $id_formPenilaianSatker) }}" class="text-muted text-hover-primary">Aspek</a>
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
                <button type="button" class="btn btn-primary"
                    onclick="location.href='{{ route('formPenilaianSatker.getPenilaianSoalPage', $id_formPenilaianSatker) }}'">
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
                                <h3 class="mb-0">
                                    <span>
                                        <div class="symbol symbol-10px symbol-square flex-shrink-0">
                                            <img src="{{ asset('assets/media/illustrations/unitedpalms-1/4.png') }}" alt="logo" />
                                        </div>
                                    </span>
                                    PENILAIAN INDIKATOR - <span class="text-primary">{{ strtoupper($soal) }}</span>
                                </h3>
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
                                <i class="ki-duotone ki-archive-tick fs-2hx text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                   </i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-success">Berhasil!</h4>
                                <span>{{ session('success') }}</span>
                            </div>
                            <!--begin::Close-->
                            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto bg-light-success" data-bs-dismiss="alert">
                                <i class="ki-duotone ki-abstract-11 fs-1 text-success">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                   </i>
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
                    
                    <h7 class="text-gray-400 text-hover-primary fst-italic">*Setiap Indikator harus disertakan alasan/keterangan beserta dokumen pendukung. Mohon dipersiapkan dokumen pendukung sebelum melakukan penilaian. Kemudian silakan pilh Indikator yang ingin dinilai, kemudian klik tombol pada kolom aksi untuk memberikan penilaian.</h7> 
                    <br> <br>

                    <div class="table-responsive">
                        <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="kt_table_penilaian_indikator">
                            <thead>
                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th> <!-- tombol expand -->
                                    <th class="text-center">No</th>
                                    <th class="text-center">Indikator</th>
                                    {{-- <th class="text-start">Nilai Kematangan</th> --}}
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
        const idFormPenilaianSoal = "{{ $id_penilaianSoal }}";
    
        function formatPilihanTable(id_penilaianJawaban) {
            return `
                <div class="py-3">
                    <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="table-pilihan-${id_penilaianJawaban}">
                        <thead>
                            <tr class="text-center fw-bold  text-gray-600">
                                <th>#</th>
                                <th>Keterangan</th>
                                <th>Deskripsi</th>
                                <th>Pilihan Jawaban</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700"></tbody>
                    </table>
                </div>`;
        }
    
        $(document).ready(function () {
            const soalTable = $('#kt_table_penilaian_indikator').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('formPenilaianSatker.getPenilaianJawaban', $id_penilaianSoal) }}",
                columns: [
                    {
                        className: 'dt-control text-center',
                        orderable: false,
                        data: null,
                        defaultContent: `<a href="javascript:;" class="btn btn-icon btn-sm btn-light-primary"><i class="fas fa-plus-square"></i></a>`
                    },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'jawaban', name: 'jawaban' },
                    // { data: 'bobot_jawaban', name: 'bobot_jawaban' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' },
                ],
                columnDefs: [
                            {
                                targets: [1, 3],
                                className: 'text-center'
                            }
                ],
                initComplete: function() { 
                    setTimeout(() => {
                        $('#kt_table_penilaian_indikator tbody td.dt-control').each(function() {
                            $(this).click();
                        });
                    }, 500);
                } //Membuka anak table
            });
    
            $('#kt_table_penilaian_indikator tbody').on('click', 'td.dt-control', function () {
                const tr = $(this).closest('tr');
                const row = soalTable.row(tr);
                const rowData = row.data();
                const id_penilaianJawaban = rowData.id;

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.find('td.dt-control i').removeClass('fa-minus-square').addClass('fa-plus-square');
                } else {
                    row.child(formatPilihanTable(id_penilaianJawaban)).show();
                    tr.find('td.dt-control i').removeClass('fa-plus-square').addClass('fa-minus-square');

                    const tableId = `#table-pilihan-${id_penilaianJawaban}`;
                    console.log('Loading nested table: ', tableId); 

                    // Destroy jika sebelumnya sudah ada
                    if ($.fn.DataTable.isDataTable(tableId)) {
                        $(tableId).DataTable().clear().destroy();
                    }

                    // Load pilihan berdasarkan jawaban, id_penilaian_soal & form_penilaian_satker
                    $(tableId).DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: `/formPenilaianSatker/penilaianSoal/jawaban/pilihan/${id_penilaianJawaban}`,
                        columns: [
                            { data: 'urutan', name: 'urutan' },
                            { data: 'keterangan', name: 'keterangan' },
                            { data: 'deskripsi', name: 'deskripsi' },
                            { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' },
                        ],
                        drawCallback: function(settings) {
                            $('#kt_table_penilaian_indikator tbody td:nth-child(4) input[type="radio"]').css({
                                'pointer-events': 'none',
                                'opacity': 1
                            });
                        },
                        columnDefs: [
                            {
                                targets: [0],
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

    {{-- View Modal jawaban dan pilihan --}}
    <script>
        function loadModalJawaban(url) {
            $('#kt_modal_penjelasan_indikator').remove(); // pastikan hapus modal lama
            $.get(url, function (html) {
                $('body').append(html); // render 1 modal utuh
                $('#kt_modal_penjelasan_indikator').modal('show');
            }).fail(function () {
                alert('Gagal memuat data jawaban.');
            });
        }
    
        $(document).on('click', '.btn-nilai-jawaban', function (e) {
            e.preventDefault();
            const url = $(this).data('url');
            loadModalJawaban(url);
        });
    </script>
     
@endsection