@extends('siantik.layouts.main')

@section('title', 'Detail Satker - Siantik')

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
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Detail Satker</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>

            <div class="mb-3">
                <a href="{{ route('satker.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid px-10">

            <div class="card card-flush mb-5">
                <div class="card-body">
                    <div class="row align-items-center">

                        {{-- LEFT: Konten --}}
                        <div class="col-md-8 d-flex align-items-start gap-6">
                            {{-- Logo --}}
                            <div class="symbol symbol-70px symbol-rounded flex-shrink-0" style="width: 55px; height: 50px;">
                                <img src="{{ asset('assets/media/avatars/kpu.png') }}" alt="logo" style="width: 100%; height: 120%; object-fit: cover;" />
                            </div>

                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <h3 class="mb-0 text-hover-primary  fw-bold">{{ $instansiNama ?? '-' }}</h3>
                                    <span><img src="{{ asset('assets/media/icons/duotune/general/gen026.svg') }}" alt="logo" /></span>
                                    @php
                                        $status = $waktuSubmit;
                                        $badge =
                                            [
                                                'Proses' => 'badge-light-warning',
                                                'Selesai' => 'badge-light-success',
                                            ][$status] ?? 'badge-light-secondary';
                                    @endphp
                                    <span class="badge {{ $badge }} fw-semibold">{{ $status }}</span>
                                    <span>
                                        @if($formSatker->is_locked)
                                            <form id="form-unlock-{{ $formSatker->id }}" 
                                                action="{{ route('satkerMonitor.unlockSatker', $formSatker->id) }}" 
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="button" 
                                                    class="btn btn-sm btn-light-danger btn-unlock" 
                                                    data-id="{{ $formSatker->id }}">
                                                    <i class="fas fa-lock"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </span>
                                </div>

                                {{-- Sub title --}}
                                <span class="text-gray-600 mt-1">
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-success me-5 mb-2">
                                        <i class="ki-outline ki-geolocation text-success fs-4 me-1"></i> {{ $tingkatNama ?? '-' }}
                                    </a>
                                </span>

                                {{-- Small stats --}}
                                <div class="d-flex align-items-stretch gap-4 mt-5 flex-wrap">
                                    {{-- Due Date --}}
                                    {{-- <div class="border rounded px-5 py-4 min-w-175px">
                                        <div class="fw-bold fs-6">
                                            <span><img src="{{ asset('assets/media/icons/duotune/general/gen014.svg') }}"
                                                    alt="logo" /></span>
                                            {{ \Carbon\Carbon::parse($project['due'] ?? '2025-01-29')->translatedFormat('d M, Y') }}
                                        </div>
                                        <br>
                                        <div class="text-gray-500 fs-8">Tanggal <br> Submit</div>
                                    </div> --}}

                                    {{-- Indeks --}}
                                    <div class="border rounded px-5 py-4 min-w-175px border-bottom-dashed" style="background-color: #F1416C">
                                        <div class="d-flex align-items-center gap-2">
                                            <span>
                                                <img class="text-white" src="{{ asset('assets/media/icons/duotune/maps/map007.svg') }}" alt="logo" />
                                            </span>
                                            <div class="fw-bold text-white text-hover-success  fs-6">
                                                <strong> {{ number_format($indeksKematangan ?? 0, 1) }} </strong>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-white text-hover-primary  fs-8">
                                            <strong> Indeks <br> Kematangan </strong>
                                        </div>
                                    </div>

                                    {{-- Predikat --}}
                                    <div class="border rounded text-white px-5 py-4 min-w-175px border-bottom-dashed" style="background-color: #6FCF97">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="fw-bold fs-6">
                                                <span><img
                                                        src="{{ asset('assets/media/icons/duotune/abstract/abs041.svg') }}"
                                                        alt="logo" /></span>
                                                <strong>{{ $predikatKematangan ?? '-' }}</strong>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-white fs-8">
                                            <strong> Predikat<br>Kematangan </strong>
                                            </div>
                                    </div>
                                </div>
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

            {{-- Info ringkas form & satker --}}
            <div class="card card-flush mb-5">
                <div class="card-body">
                    {{-- <div class="separator my-6"></div> --}}

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed gy-5">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold text-muted w-25">Nama Form</td>
                                    <td class="fw-bold fs-6 text-gray-800">
                                        <span class="badge badge-light-primary badge-lg">
                                            {{ $formSatker->formPenilaian->nama_form ?? '-' }}</td>
                                        </span>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted">Tahun</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $formSatker->formPenilaian->tahun ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted align-top">Deskripsi</td>
                                    <td class="fw-normal text-gray-700">{{ $formSatker->formPenilaian->keterangan ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            {{-- Radar Chart + Tabel --}}
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title fw-bold">
                        <span class="me-2">
                            <div class="symbol symbol-5px symbol-square flex-shrink-0">
                                <img src="{{ asset('assets/media/icons/duotune/abstract/abs037.svg') }}" alt="logo" 
                                     style="width: 20px; height: 20px;" />  
                            </div>
                        </span>
                        Hasil Evaluasi
                    </h3>
                </div>

                <div class="separator separator-dotted separator-content border-danger my-0"><span class="h6 text-danger"> CHART </span></div>

                <div class="card-body">
                    <div class="card-body">
                        <canvas id="spbeRadarChart" style="height: 520px"></canvas>
                    </div>

                    <br>
                    <br>
                    <div class="separator separator-dotted separator-content border-success my-0"><span class="h6 text-success"> ASPEK </span></div>
                    <br>

                    <div class="card card-flush mb-5">
                        <div class="card-body">
                            <tr>
                                <td colspan="3" class="p-0">
                                    {{-- <div style="border-top:3px dashed #000;"></div> --}}
                                </td>
                            </tr>
                            <table class="table table-striped table-hover table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                                <thead class="text-center fw-bold">
                                    <tr>
                                        <th>ASPEK</th>
                                        <th></th>
                                        <th style="width:60px;" class="text-center">Nilai Kematangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-soal-body">
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Memuat…</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <tr>
                                <td colspan="3" class="p-0">
                                    <div style="border-top:3px dashed #000;"></div>
                                </td>
                            </tr> --}}
                        </div>
                    </div>

                    <br>
                    <div class="separator separator-dotted separator-content border-info my-0"><span class="h6 text-info"> INDIKATOR </span></div> 
                    <br>
                    <br>

                    <div class="table-responsive">
                        <table id="tbl-jawaban"
                            class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                            <thead class="text-center fw-bold">
                                <tr>
                                    <th style="width:60px;">NO</th>
                                    <th>INDIKATOR</th>
                                    <th style="width:180px;" class="text-center">NILAI KEMATANGAN</th>
                                    <th style="width:180px;" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Memuat…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-header">
                    <h3 class="card-title fw-bold">
                        <span class="me-2">
                            <div class="symbol symbol-5px symbol-square flex-shrink-0">
                                <img src="{{ asset('assets/media/icons/duotune/abstract/abs037.svg') }}" alt="logo" 
                                     style="width: 20px; height: 20px;" />  
                            </div>
                        </span>
                        Data Profilling
                    </h3>
                </div>

                <div class="card card-flush shadow-sm mb-10">
                    <div class="card-body pt-0">
                        <div class="separator separator-dotted separator-content border-primary my-0"><span class="h6 text-primary"> Profilling </span></div>
                        <br> <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                                <thead class="text-center fw-bold">
                                    <tr>
                                         <th style="width: 5%">No</th>
                                        <th style="width: 30%">Pertanyaan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($profilPertanyaans as $p)
                                        @php
                                            $jawaban = $profilJawabanMap[$p->id]->jawaban ?? '-';
                                            $keterangan = $profilJawabanMap[$p->id]->keterangan ?? null;
                                            $isArray = is_array(json_decode($jawaban, true));
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold text-gray-700">{{ $loop->iteration }}</td>
                                            <td class="fw-semibold w-25">
                                                <i class="ki-duotone ki-information-3 fs-4 me-2 text-primary"></i>
                                                {{ $p->keterangan }}
                                            </td>
                                            <td>
                                                <div class="text-gray-800 fs-6">
                                                    @if($isArray)
                                                        <ul class="mb-1 ps-4">
                                                            @foreach(json_decode($jawaban, true) as $index => $item)
                                                                <li class="d-flex align-items-center py-2">
                                                                    <div class="bg-gray-200 text-primary rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 24px; height: 24px; font-size: 1.1rem;">
                                                                        {{ $index + 1 }}
                                                                    </div>
                                                                    {{ $item }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="fs-6 px-3 py-2">{{ $jawaban }}</span>
                                                    @endif
                                                </div>

                                                @if($keterangan)
                                                    <div class="text-muted fst-italic mt-1 small">
                                                        <i class="ki-duotone ki-message-question fs-5 me-1"></i>
                                                        {{ $keterangan }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-muted text-center">Belum ada data profilling yang diinput.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const radarCtx = document.getElementById('spbeRadarChart').getContext('2d');
            const soalBody = document.getElementById('tbl-soal-body');
            const jawabBody = document.querySelector('#tbl-jawaban tbody');
            let radarChart = null;

            const formSatkerId = {{ $formSatker->id }};

            function initJawabanDT() {
                // kalau sudah pernah di-init, hancurkan dulu biar tidak "reinit" error
                if ($.fn.DataTable.isDataTable('#tbl-jawaban')) {
                    $('#tbl-jawaban').DataTable().destroy();
                }
                $('#tbl-jawaban').DataTable({
                    paging: true,
                    pageLength: 10,
                    searching: false,
                    ordering: false,
                    info: false,
                    lengthChange: false,
                });
            }

                // ---- CHART
                async function loadChart() {
                    try {
                        const res = await fetch("{{ route('satker.chart', ':id') }}".replace(':id',
                            formSatkerId), {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        if (!res.ok) throw new Error('HTTP ' + res.status);
                        const data = await res.json();

                        const cfg = {
                    type: 'radar',
                    data: {
                        labels: data.labels,
                        datasets: [
                        {
                            label: 'Target Aspek Kematangan TIK    ',
                            data: data.target,
                            backgroundColor:'rgba(59,153,252,0.2)',
                            borderColor:'#3b99fc',
                            borderWidth:2,
                            pointBackgroundColor:'#3b99fc'
                        },
                        {
                            label: 'Indeks Aspek Kematangan TIK',
                            data: data.indeks,
                            backgroundColor:'rgba(255,99,132,0.10)',
                            borderColor:'rgba(255,99,132,1)',
                            borderWidth:2,
                            pointBackgroundColor:'rgba(255,99,132,1)'
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,     // biar tinggi ikut container
                        layout: { padding: 0 },
                        plugins: { legend: { position: 'top' } },
                        scales: {
                            r: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            suggestedMax: 5,
                            ticks: { stepSize: 0.5, display: true },   // sembunyikan angka cincin agar ringkas
                            pointLabels: {
                                padding: 4,                              // lebih rapat
                                centerPointLabels: true,                 // **tarik label lebih ke dalam** (Chart.js v4)
                                font: { size: 10 },
                                // potong label yang terlalu panjang (opsional)
                                callback: (label) => label.length > 60 ? label.slice(0, 60) + '…' : label,
                            },
                            grid: { circular: true }
                            }
                        },
                        elements: { point: { radius: 2 } }
                    }
                };
                    if (radarChart) radarChart.destroy();
                    radarChart = new Chart(radarCtx, cfg);
                } catch (e) {
                    console.error(e);
                }
            }

            // ---- TABEL SOAL
            async function loadSoal() {
                soalBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Memuat…</td></tr>`;
                try {
                    const res = await fetch("{{ route('satker.soal', ':id') }}".replace(':id',
                        formSatkerId), {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();
                    if (!data.length) return soalBody.innerHTML =
                        `<tr><td colspan="3" class="text-center text-muted">Belum ada soal.</td></tr>`;
                    soalBody.innerHTML = data.map(r => `
                        <tr>
                        <td class="bg-light fw-bold">${r.soal}</td>
                        <td class="text-center bg-light fw-bold"></td>
                        <td class="text-center bg-light fw-bold">${parseFloat(r.nilai ?? 0).toFixed(1)}</td>
                        </tr>`).join('');
                } catch (e) {
                    console.error(e);
                    soalBody.innerHTML =
                        `<tr><td colspan="3" class="text-center text-muted">Data Belum Tersedia.</td></tr>`;
                }
            }

            // ---- TABEL JAWABAN
            async function loadJawaban() {
                // placeholder
                jawabBody.innerHTML =
                    `<tr><td colspan="3" class="text-center text-muted">Memuat…</td></tr>`;

                try {
                    const res = await fetch("{{ route('satker.jawaban', ':id') }}".replace(':id',
                        formSatkerId), {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    const rows = await res.json();

                    if (!Array.isArray(rows) || rows.length === 0) {
                        jawabBody.innerHTML =
                            `<tr><td colspan="3" class="text-center text-muted">Data Belum Tersedia.</td></tr>`;
                        // tetap init agar pagination terpasang (walau 1 baris)
                        initJawabanDT();
                        return;
                    }

                    // render baris normal
                    jawabBody.innerHTML = rows.map((r, i) => `
                            <tr>
                                <td class="text-center">${i+1}</td>
                                <td>${r.jawaban ?? '-'}</td>
                                <td class="text-center">${r.bobot_jawaban ?? 0}</td>
                                <td class="text-center">
                                ${r.id_penilaian_jawaban > 0 
                                    ? `<a href="javascript:void(0)" 
                                            class="btn btn-sm btn-light-info btn-show-jawaban"
                                            data-id="${r.id_penilaian_jawaban}" 
                                            data-pilihan="${r.id_jawaban}">
                                            <i class="fas fa-eye"></i> lihat
                                        </a>` 
                                    : `<span class="badge badge-light-warning">Belum Dinilai</span>`
                                }
                                </td>
                            </tr>
                        `).join('');

                    // pasang DataTables
                    initJawabanDT();

                } catch (e) {
                    console.error('loadJawaban error:', e);
                    jawabBody.innerHTML =
                        `<tr><td colspan="3" class="text-center text-muted">Data Belum Tersedia.</td></tr>`;
                    initJawabanDT();
                }
            }

            await loadChart();
            await loadSoal();
            await loadJawaban();
        });
    </script>

    <script>
    $(document).on('click', '.btn-show-jawaban', function(e) {
        e.preventDefault();
        let idJawaban = $(this).data('id');
        let idPilihan = $(this).data('pilihan');

        // Panggil route yang return view modal (modal-jawaban.blade)
        $.get("{{ url('satker/jawaban/modal') }}/" + idJawaban + "/" + idPilihan, function(html) {
            $('#kt_modal_penjelasan_indikator').remove();
            $('body').append(html);
            $('#kt_modal_penjelasan_indikator').modal('show');
        }).fail(function() {
            alert('Gagal memuat modal jawaban.');
        });
    });
    </script>

    {{-- Unlock Formsatker --}}
    <script>
        $(document).on('click', '.btn-unlock', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let form = $('#form-unlock-' + id);

            Swal.fire({
                title: 'Buka Kunci?',
                text: "Setelah dibuka, form bisa diubah kembali.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, buka kunci',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

    </script>
@endsection
