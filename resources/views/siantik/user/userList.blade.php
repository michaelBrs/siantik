@extends('siantik.layouts.main')

@section('title', 'Siantik - Pengguna')

@section('container')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 text-uppercase">Daftar Pengguna</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary"></a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">
            <div class="card card-xl-stretch mb-5">
            
                <!-- Statistik -->
                <div class="row g-4 px-6 py-5 pb-6">
                    <!-- Card 1 -->
                    <div class="col-md-3">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-user fs-2 text-primary"></i>
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">{{ $totalUser  }}</div>
                            <div class="fs-6 text-gray-600">User</div>
                        </div>
                    </div>
            
                    <!-- Card 2 -->
                    <div class="col-md-3">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-user-cog fs-2 text-primary"></i>
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">{{ $totalAdmin ?? '-' }}</div>
                            <div class="fs-6 text-gray-600">Admin</div>
                        </div>
                    </div>
            
                    <!-- Card 3 -->
                    <div class="col-md-3">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-user-edit fs-2 text-primary"></i> 
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">{{ $totalOperator ?? '-' }}</div>
                            <div class="fs-6 text-gray-600">Operator</div>
                        </div>
                    </div>
            
                    <!-- Card 4 -->
                    <div class="col-md-3">
                        <div class="bg-light text-center py-8 rounded">
                            <div class="mb-2">
                                <i class="fas fa-user-check fs-2 text-primary"></i>
                            </div>
                            <div class="fs-1 fw-bolder text-gray-800">{{ $totalVerified ?? '-' }}</div>
                            <div class="fs-6 text-gray-600">Terverifikasi</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-start flex-wrap">
                    <!-- Kolom kanan -->
                    <div class="card-toolbar flex-column w-100">
                        <!-- Baris 1: Tombol di pojok kanan -->
                        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                            <div class="card-title">
                                <h3 class="mb-0">
                                    <span class="me-2">
                                        <i class="ki-duotone ki-profile-user fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    KELOLA PENGGUNA
                                </h3>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                                    <i class="fas fa-download me-1"></i> Export
                                </button>
                        
                                @can('create', \App\Models\User::class)
                                <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('user.create') }}'">
                                    <i class="fas fa-plus me-1"></i> Tambah Pengguna
                                </button>
                                @endcan
                            </div>
                        </div>
                        <br>

                        <!-- Baris 2: Filter horizontal -->
                        <div class="d-flex flex-wrap align-items-center gap-4 w-100">
                            <div>
                                <span class="fw-bold text-muted">Filter</span>
                            </div>

                            <div>
                                <!-- Filter Tingkat -->
                                <select id="filter_tingkat" class="form-select form-select-sm form-select-solid w-200px" data-control="select2" data-placeholder="Pilih Tingkatan">
                                    <option></option>
                                    @foreach ($tingkats as $tingkat)
                                        @php
                                            $label = $tingkat->nama === 'Provinsi' ? 'Biro/Pusat/Provinsi' : $tingkat->nama;
                                        @endphp
                                        <option value="{{ $tingkat->id }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <!-- Filter Wilayah -->
                                <select id="filter_wilayah" class="form-select form-select-sm form-select-solid w-180px" data-control="select2" data-placeholder="Pilih Wilayah Satker">
                                    <option></option>
                                    @foreach ($wilayahList as $wilayah)
                                        <option value="{{ $wilayah->id }}">{{ $wilayah->nama_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <!-- Filter Role -->
                                <select id="filter_role" class="form-select form-select-sm form-select-solid w-150px" data-control="select2" data-placeholder="Pilih Role">
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div>
                                <!-- Filter Status -->
                                <select id="filter_status" class="form-select form-select-sm form-select-solid w-150px" data-control="select2" data-placeholder="Pilih Status">
                                    <option></option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>

                            <div>
                                <!-- Search -->
                                <div class="position-relative">
                                    <input type="text" id="filter_search" class="form-control form-control-sm form-control-solid w-200px ps-10" placeholder="Cari NIK/Nama" />
                                    <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <!-- Tombol Reset -->
                                <button type="button" id="btn_reset_filter" class="btn btn-sm btn-danger">
                                    <i class="fas fa-filter me-1"></i> Hapus Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div> 
                <br>
                <!--end::Card header-->

                <!--begin::Card body-->
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
                    <!--begin::Table-->
                    <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-center text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-10px">No</th>
                                <th class="min-w-1100px">Wilayah</th>
                                <th class="min-w-100px">Role</th>
                                <th class="min-w-100px">User</th>
                                <th class="min-w-70px">Nip</th>
                                <th class="min-w-100">Jabatan</th>
                                <th class="min-w-70px">Satuan Kerja</th>
                                <th class="min-w-50px">Status</th>
                                <th class="min-w-50px">Status Verifikasi</th>
                                <th class="text-center min-w-200px">Aksi</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold"> </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


    {{-- Datatable versi server-side --}}
    <script>
        $(document).ready(function () {
            const table = $('#kt_table_users').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.getData') }}',
                    data: function (d) {
                        d.filter_tingkat = $('#filter_tingkat').val();
                        d.filter_wilayah = $('#filter_wilayah').val();
                        d.filter_role = $('#filter_role').val();
                        d.filter_status = $('#filter_status').val();
                        d.search_text = $('#filter_search').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'wilayah', name: 'profile.wilayah.nama_wilayah' },
                    { data: 'role', name: 'roles.name' },
                    { data: 'user', name: 'name' },
                    { data: 'nip', name: 'profile.nip' },
                    { data: 'jabatan', name: 'profile.jabatan' },
                    { data: 'satker', name: 'profile.satker' },
                    { data: 'status', name: 'status' },
                    { data: 'verifikasi', name: 'email_verified_at' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
                ],
                columnDefs: [
                    {
                        targets: [0, 7, 8, 9],
                        className: 'text-start'
                    }
                ],
                language: {
                    url: "{{ asset('assets/plugins/custom/datatables/lang/id.json') }}"
                }
            });

            // Event filter
            $('#filter_tingkat, #filter_wilayah, #filter_role, #filter_status').on('change', function () {
                table.ajax.reload();
            });

            $('#filter_search').on('keyup', function () {
                table.ajax.reload();
            });

            $('#btn_reset_filter').on('click', function () {
                $('#filter_tingkat, #filter_wilayah, #filter_role, #filter_status').val('').trigger('change');
                $('#filter_search').val('');
                table.ajax.reload();
            });
        });
    </script>


    {{-- Untuk tombol delete dalam datatables --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Supaya berfungsi ulang setiap DataTable redraw (pagination, search, dll)
            $('#kt_table_users').on('draw.dt', function () {
                attachDeleteHandlers();
            });

            function attachDeleteHandlers() {
                const deleteButtons = document.querySelectorAll('.btn-delete-user');

                deleteButtons.forEach(button => {
                    button.removeEventListener('click', deleteHandler); // prevent duplicate
                    button.addEventListener('click', deleteHandler);
                });
            }

            function deleteHandler() {
                const userId = this.dataset.userId;
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data pengguna akan dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${userId}`).submit();
                    }
                });
            }

            attachDeleteHandlers(); // initial attach
        });
    </script>

@endsection