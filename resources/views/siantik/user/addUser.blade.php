@extends('siantik.layouts.main')

@section('title', 'Tambah Akun')

@section('container')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Users List</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">User Management</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Users List</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Akun</h3>
                </div>
                <div class="card-body">
                    {{-- Cek Error untuk Edit --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- end Cek Error untuk Edit --}}
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tipe Akun</label>
                                    <input type="text" class="form-control form-control-solid" value="KPU" disabled />
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Role</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="role" id="role">
                                        <option value="">Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Tingkat</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="tingkat" id="tingkat">
                                        <option value="">Pilih Tingkat</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Wilayah</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="wilayah" id="wilayah">
                                        <option value="">Pilih Wilayah</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">NIP</label>
                                    <input type="text" name="nip" class="form-control form-control-solid" value="{{ old('nip') }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-solid" value="{{ old('email') }}"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control form-control-solid" value="{{ old('nama') }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label d-block">Jenis Kelamin</label>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom form-check-inline me-5">
                                            <input class="form-check-input" type="radio" name="gender" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}/>
                                            <span class="form-check-label">Laki-laki</span>
                                        </label>
                                        <label class="form-check form-check-custom form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}/>
                                            <span class="form-check-label">Perempuan</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Nomor Handphone</label>
                                    <input type="text" name="phone" class="form-control form-control-solid" value="{{ old('phone') }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control form-control-solid" value="{{ old('jabatan') }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Satker</label>
                                    <input type="text" name="satker" class="form-control form-control-solid" value="{{ old('satker') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('user.index') }}" class="btn btn-secondary me-2">
                                    <i class="ki-duotone ki-arrow-left fs-2"></i> Kembali
                                </a>
                                <button type="submit" name="send_email" value="1" class="btn btn-primary me-2">
                                    Simpan & Kirim Email Aktivasi
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {      
        // Kelola inputan
        const roleSelect = $('#role');
        const tingkatSelect = $('#tingkat');
        const wilayahSelect = $('#wilayah');

        // Inisialisasi awal
        roleSelect.select2();
        tingkatSelect.select2();
        wilayahSelect.select2();

        const tingkatOptions = {
            pusat: { id: 1, label: 'Pusat' },
            provinsi: { id: 2, label: 'Provinsi' },
            kabkota: { id: 3, label: 'Kabupaten/Kota' }
        };

        const wilayahList = @json($wilayahList);

        roleSelect.on('change', function () {
            const roleId = parseInt(this.value);
            let tingkatKey = '';
            let wilayahTingkat = -1;

            switch (roleId) {
                case 2:
                case 3:
                    tingkatKey = 'provinsi';
                    wilayahTingkat = 1;
                    break;
                case 4:
                case 5:
                    tingkatKey = 'kabkota';
                    wilayahTingkat = 2;
                    break;
                default:
                    tingkatKey = 'pusat';
                    wilayahTingkat = 0;
                    break;
            }

            // Reset dan populate select tingkat
            tingkatSelect.empty().append(new Option(
                tingkatOptions[tingkatKey].label,
                tingkatOptions[tingkatKey].id
            )).trigger('change');

            // Reset dan populate select wilayah
            wilayahSelect.empty().append(new Option('Pilih Wilayah', ''));
            wilayahList
                .filter(w => w.tingkat_wilayah == wilayahTingkat)
                .forEach(w => {
                    wilayahSelect.append(new Option(w.nama_wilayah, w.id));
                });
            wilayahSelect.trigger('change');
        });

        // fungsi Old Input Tingkat dan wilayah
        const oldRole = "{{ old('role') }}";
        const oldTingkat = "{{ old('tingkat') }}";
        const oldWilayah = "{{ old('wilayah') }}";
        const oldGender = "{{ old('gender') }}"; // ini hanya bantu debug

        if (oldRole) {
            roleSelect.val(oldRole).trigger('change');
            setTimeout(() => {
                tingkatSelect.val(oldTingkat).trigger('change');
                wilayahSelect.val(oldWilayah).trigger('change');
            }, 200); // Delay agar opsi wilayah sudah terisi
        }
    });
    </script>
@endsection