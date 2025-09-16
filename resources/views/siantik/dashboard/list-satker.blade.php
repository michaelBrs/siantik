@extends('siantik.layouts.main')

@section('title', 'Siantik - Monitoring')

@section('container')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Daftar Satuan Kerja</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">

            <div class="card card-xl-stretch mb-5">
                <div class="card card-xl-stretch mb-5">
                    <!-- Statistik -->
                    <div class="row g-4 px-6 py-5 pb-6">
                        <!-- Card 1 -->
                        <div class="col-md-4">
                            <div class="bg-light text-center py-8 rounded">
                                <div class="mb-2">
                                    <i class="fas fa-home fs-2 text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bolder text-gray-800">{{ $jumlahSatker }}</div>
                                <div class="fs-6 text-gray-600">Jumlah Satker</div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-4">
                            <div class="bg-light text-center py-8 rounded">
                                <div class="mb-2">
                                    <i class="fas fa-university fs-2 text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bolder text-gray-800">{{ $jumlahProvinsi }}</div>
                                <div class="fs-6 text-gray-600">Biro/Pusat/Provinsi</div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-4">
                            <div class="bg-light text-center py-8 rounded">
                                <div class="mb-2">
                                   <i class="fas fa-building fs-2 text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bolder text-gray-800">{{ $jumlahKabKota }}</div>
                                <div class="fs-6 text-gray-600">Kabupaten/Kota</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-xl-stretch mb-5">
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
                                        Monitoring Satuan Kerja
                                    </h3>
                                    <br> <br>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-4 w-100">
                                <div><span class="fw-bold text-muted">Filter</span></div>

                                {{-- Filter Form --}}
                                <div class="form-floating w-300px">
                                    <select id="filter_form" class="form-select form-select-sm form-select-solid"
                                        data-control="select2" data-placeholder="Pilih Form">
                                        <option value="">Semua Form</option>
                                        @foreach ($forms as $f)
                                            @php $p = $f->formPenilaian; @endphp
                                            <option value="{{ $f->form_penilaian_id }}">
                                                {{ $p->nama_form }} — {{ $p->tahun }} @if (($p->status ?? 0) == 1)
                                                    ✳︎
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Filter Wilayah --}}
                                {{-- <div class="form-floating w-200px">
                                    <select id="filter_wilayah" class="form-select form-select-sm form-select-solid"
                                        data-control="select2" data-placeholder="Pilih Wilayah">
                                        <option value="">Semua Wilayah</option>
                                        @foreach ($wilayahList as $w)
                                            <option value="{{ $w->id }}">{{ $w->nama_wilayah }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                {{-- Filter Kode Provinsi --}}
                                <div class="form-floating w-200px">
                                    <select id="filter_kode_pro" class="form-select form-select-sm form-select-solid"
                                        data-control="select2" data-placeholder="Pilih Provinsi">
                                        <option value="">Semua Provinsi</option>
                                        @foreach ($wilayahProv->unique('kode_pro') as $wp)
                                            <option value="{{ $wp->kode_pro }}">{{ $wp->nama_wilayah }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Filter Tingkat Wilayah --}}
                                <div class="form-floating w-220px">
                                    <select id="filter_tingkat" class="form-select form-select-sm form-select-solid"
                                        data-control="select2" data-placeholder="Pilih Tingkatan">
                                        <option value="">Semua Tingkat</option>
                                        {{-- <option value="0">Pusat</option> --}}
                                        <option value="1">Biro/Pusat/Provinsi</option>
                                        <option value="2">Kabupaten/Kota</option>
                                    </select>
                                </div>

                                {{-- Filter Status --}}
                                <div class="form-floating w-200px">
                                    <select id="filter_status" class="form-select form-select-sm form-select-solid"
                                        data-control="select2" data-placeholder="Pilih Status">
                                        <option value="">Semua Status</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>


                                {{-- Search --}}
                                <div class="position-relative">
                                    <input type="text" id="filter_search"
                                        class="form-control form-control-sm form-control-solid w-250px ps-10"
                                        placeholder="Cari Satker/Wilayah" />
                                    <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                            <rect opacity="0.5" x="17" y="15" width="8" height="2" rx="1"
                                                transform="rotate(45 17 15)" fill="black" />
                                            <path
                                                d="M11 19C6.6 19 3 15.4 3 11S6.6 3 11 3s8 3.6 8 8-3.6 8-8 8Zm0-14a6 6 0 100 12 6 6 0 000-12Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>

                                <div>
                                    <button type="button" id="btn_reset_filter" class="btn btn-sm btn-danger">
                                        <i class="fas fa-filter me-1"></i> Hapus Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-4">
                        <table
                            class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7"
                            id="kt_table_satker">
                            <thead>
                                <tr class="text-center text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-40px">No</th>
                                    <th class="min-w-150px">Progres</th>
                                    <th class="min-w-100px">Wilayah</th>
                                    <th class="min-w-100px">Tingkat</th>
                                    <th class="min-w-100px">Satuan Kerja</th>
                                    <th class="min-w-130px">Indeks Kematangan</th>
                                    <th class="min-w-150px">Predikat Kematangan</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-100px text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const defaultFormId = @json($defaultFormId);

            const selForm = $('#filter_form').select2({
                allowClear: true
            });
            const selStatus = $('#filter_status').select2({
                allowClear: true
            });
            const selWil = $('#filter_wilayah').select2({
                allowClear: true
            });
            const selTingkat = $('#filter_tingkat').select2({ allowClear: true });
            const selKodePro = $('#filter_kode_pro').select2({ allowClear: true });
                selKodePro.on('change', () => table.ajax.reload(null, false));   

            if (defaultFormId) {
                $('#filter_form').val(String(defaultFormId)).trigger('change.select2');
            }

            const table = $('#kt_table_satker').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('satker.data') }}",
                    data: function(d) {
                        d.form_id         = $('#filter_form').val() || '';
                        d.status          = $('#filter_status').val() || '';
                        d.wilayah_id      = $('#filter_wilayah').val() || '';
                        d.tingkat_wilayah = $('#filter_tingkat').val() || '';
                        d.kode_pro       = $('#filter_kode_pro').val() || '';
                    },
                    dataSrc: 'data'
                },
                order: [[9, 'asc']],
                columns: [
                    { data: null, className: 'text-center', orderable: false, searchable: false, defaultContent: '' },
                    { data: 'kemajuan', orderable: false, searchable: false },   
                    { data: 'wilayah', visible: false, searchable: false },
                    { data: 'tingkat', visible: false, searchable: false  },
                    { data: 'satker' },
                    { data: 'indeks_kematangan', className: 'text-center' },
                    { data: 'predikat', className: 'text-center' },
                    { data: 'status', className: 'text-center',
                            render: data => `<span class="badge badge-light-${data==='Selesai'?'success':'warning'}">${data}</span>` },
                    { data: 'aksi', className: 'text-center', orderable: false, searchable: false },
                    { data: 'wilayah_sort', visible: false, searchable: false } // hidden sort helper
                ]
            });

            table.on('order.dt search.dt draw.dt', function() {
                const info = table.page.info();
                table.column(0, {
                        search: 'applied',
                        order: 'applied',
                        page: 'current'
                    })
                    .nodes()
                    .each(function(cell, i) {
                        cell.innerHTML = info.start + i + 1;
                    });
            }).draw();

            // reload saat filter berubah
            selForm.on('change', () => table.ajax.reload(null, false));
            selStatus.on('change', () => table.ajax.reload(null, false));
            selWil.on('change', () => table.ajax.reload(null, false));
            selTingkat.on('change', () => table.ajax.reload(null,false));

            // live search
            $('#filter_search').on('keyup', function() {
                table.search(this.value).draw();
            });

            // reset
            $('#btn_reset_filter').on('click', function() {
                // $('#filter_form, #filter_status, #filter_wilayah, #filter_tingkat').val('').trigger('change');
                $('#filter_status, #filter_wilayah, #filter_tingkat, #filter_kode_pro').val('').trigger('change');
                $('#filter_search').val('');
                table.search('').ajax.reload(null, false);
            });
        });
    </script>
@endsection
