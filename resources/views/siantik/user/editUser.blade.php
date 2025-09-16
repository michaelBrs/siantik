@extends('siantik.layouts.main')

@section('title', 'Ubah Akun')

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
                    <h3 class="card-title">Ubah Pengguna</h3>
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
                    <form method="POST" action="{{ route('user.update', $userToEdit->id) }}">
                        @method('put')
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
                                            <option value="{{ $role->id }}" {{ old('role', $userToEdit->roles->first()->id ?? '') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Tingkat</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="tingkat" id="tingkat">
                                        <option value="">Pilih Tingkat</option>
                                        @foreach ($tingkats as $tingkat)
                                            <option value="{{ $tingkat->id }}" {{ old('tingkat', $userToEdit->profile->tingkat_id ?? '' ) == $tingkat->id ? 'selected' : '' }}>
                                                {{ $tingkat->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Wilayah</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="wilayah" id="wilayah">
                                        <option value="">Pilih Wilayah</option>
                                        @foreach ($wilayahList as $wilayah)
                                            <option value="{{ $wilayah->id }}" {{ old('wilayah', $userToEdit->profile->wilayah_id) == $wilayah->id ? 'selected' : '' }}>
                                                {{ $wilayah->nama_wilayah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">NIP</label>
                                    <input type="text" name="nip" class="form-control form-control-solid" value="{{ old('nip', $userToEdit->profile->nip ?? '' ) }}" />
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-solid" value="{{ old('email', $userToEdit->email ?? '' ) }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control form-control-solid" value="{{ old('nama', $userToEdit->name ?? '' ) }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label d-block">Jenis Kelamin</label>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom form-check-inline me-5">
                                            <input class="form-check-input" type="radio" name="gender" value="Laki-laki" {{ old('gender', $userToEdit->profile->gender ?? '') == 'Laki-laki' ? 'checked' : '' }}/>
                                            <span class="form-check-label">Laki-laki</span>
                                        </label>
                                        <label class="form-check form-check-custom form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Perempuan" {{ old('gender', $userToEdit->profile->gender ?? '') == 'Perempuan' ? 'checked' : '' }}/>
                                            <span class="form-check-label">Perempuan</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Nomor Handphone</label>
                                    <input type="text" name="phone" class="form-control form-control-solid" value="{{ old('phone', $userToEdit->profile->phone ?? '' ) }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control form-control-solid" value="{{ old('jabatan', $userToEdit->profile->jabatan ?? '' ) }}"/>
                                </div>

                                <div class="mb-5">
                                    <label class="required form-label">Satker</label>
                                    <input type="text" name="satker" class="form-control form-control-solid" value="{{ old('satker', $userToEdit->profile->satker ?? '' ) }}"/>
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
        function populateTingkat(roleId, isInit = false) {
            tingkatSelect.innerHTML = '<option value="">Pilih Tingkat</option>';

            if (tingkatOptions[roleId]) {
                const opt = document.createElement('option');
                opt.value = tingkatOptions[roleId].id;
                opt.textContent = tingkatOptions[roleId].label;

                // Saat awal load, gunakan oldTingkat
                if (isInit) {
                    opt.selected = tingkatOptions[roleId].id === oldTingkat;
                } else {
                    opt.selected = true; // otomatis pilih saat role berubah
                }

                tingkatSelect.appendChild(opt);
            }
        }

        function populateWilayah(roleId, isInit = false) {
            wilayahSelect.innerHTML = '<option value="">Pilih Wilayah</option>';

            const tingkat = tingkatOptions[roleId]?.wilayahTingkat;
            if (tingkat === undefined) return;

            wilayahList
                .filter(w => w.tingkat_wilayah == tingkat)
                .forEach(w => {
                    const opt = document.createElement('option');
                    opt.value = w.id;
                    opt.textContent = w.nama_wilayah;

                    // Saat load awal pakai oldWilayah
                    if (isInit && w.id == oldWilayah) {
                        opt.selected = true;
                    }

                    // Saat role dipilih, otomatis pilih opsi pertama
                    if (!isInit && wilayahSelect.options.length === 1) {
                        opt.selected = true;
                    }

                    wilayahSelect.appendChild(opt);
                });
        }

        // Saat DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const tingkatSelect = document.getElementById('tingkat');
            const wilayahSelect = document.getElementById('wilayah');

            const wilayahList = @json($wilayahList);

            const tingkatOptions = {
                1: { id: 1, label: 'Pusat', wilayahTingkat: 0 },
                2: { id: 2, label: 'Provinsi', wilayahTingkat: 1 },
                3: { id: 2, label: 'Provinsi', wilayahTingkat: 1 },
                4: { id: 3, label: 'Kabupaten/Kota', wilayahTingkat: 2 },
                5: { id: 3, label: 'Kabupaten/Kota', wilayahTingkat: 2 },
            };

            const oldRole = parseInt(@json(old('role', $userToEdit->roles->first()->id ?? null)));
            const oldTingkat = parseInt(@json(old('tingkat', $userToEdit->profile->tingkat_id ?? null)));
            const oldWilayah = parseInt(@json(old('wilayah', $userToEdit->profile->wilayah_id ?? null)));

            // Inisialisasi saat pertama kali load
            if (oldRole) {
                populateTingkat(oldRole, true);
                populateWilayah(oldRole, true);
            }

            // Saat role berubah
            roleSelect.addEventListener('change', function () {
                const roleId = parseInt(this.value);
                populateTingkat(roleId, false);
                populateWilayah(roleId, false);
            });
        });    
    </script>
@endsection