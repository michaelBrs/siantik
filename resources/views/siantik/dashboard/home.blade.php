@extends('siantik.layouts.main')

@section('title', 'Siantik - Dashboard')

@section('container')
    {{-- CSS Badge Blink --}}
    <style>
        @keyframes blink {
            0%   { background-color: #197feb; color: #0d6efd; } /* primary */
            50%  { background-color: #b47aea; color: #9c14fd; } /* orange */
            /* 50%  { background-color: #ffe5b4; color: #fd7e14; } orange */
            100% { background-color: #197feb; color: #0d6efd; } /* primary */
        }
        
        .blinking-badge {
            animation: blink 1s infinite;
        }
    </style>

    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Beranda</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Home</li>
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
            <!-- Beranda SPBE (Blade View Laravel - Metronic Template) -->
            @php
                $tahapanAktif = 1;
            @endphp

            <div class="card mb-5">
                <div class="card-body position-relative">
                    <h3 class="mb-6">Informasi Progress Tahapan Evaluasi</h3>
                    <!-- Tahapan -->
                    <div class="d-flex justify-content-between align-items-center position-relative z-index-2">
                        <!-- Garis tengah -->
                        <div style="height: 2px; background-color: #e4e6ef; position: absolute; top: 25px; left: 0; right: 0; z-index: 0;"></div>

                        @for ($i = 1; $i <= 7; $i++)
                            @php
                                $status = $i < $tahapanAktif ? 'selesai' : ($i == $tahapanAktif ? 'aktif' : 'belum');
                                $badgeClass = match($status) {
                                    'aktif' => 'badge badge-primary blinking-badge',
                                    'selesai' => 'badge-success',
                                    'belum' => 'badge-secondary',
                                };
                                $textClass = $status === 'aktif' ? 'fw-bold text-primary' : ($status === 'selesai' ? 'text-success' : 'text-muted');
                                $label = match($i) {
                                    1 => 'Penilaian<br>Mandiri',
                                    2 => 'Penilaian<br>Dokumen',
                                    3 => 'Penilaian<br>Interviu',
                                    4 => 'Penilaian<br>Visitasi',
                                    5 => 'Harmonisasi<br>Evaluasi',
                                    6 => 'Final<br>Evaluasi',
                                    7 => 'Selesai<br>Evaluasi',
                                };
                            @endphp

                            <div class="text-center position-relative" style="min-width: 90px;">
                                <div class="badge {{ $badgeClass }} rounded-circle mx-auto mb-1"
                                    style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center; z-index: 2;">
                                    <span class="fs-4 fw-bold text-white">{{ $i }}</span>
                                </div>
                                <div class="{{ $textClass }} small">{!! $label !!}</div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Informasi Formulir -->
            <div class="card card-flush mb-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="form-floating mb-7 w-50">
                            @php
                                // ambil id form_satker terbaru secara global utk fallback
                                $defaultSatker = $defaultFormSatker ?? null;
                            @endphp
                            <select class="form-select form-select-solid my-1" id="formSelect" aria-label="Pilih Tahun Evaluasi">
                                @forelse ($satkerForms as $row)
                                  @php $f = $row->formPenilaian; @endphp
                                  <option
                                    value="{{ $row->form_penilaian_id }}"
                                    data-satker="{{ $latestByForm[$row->form_penilaian_id] ?? '' }}"
                                    data-id="F{{ $row->form_penilaian_id }}"
                                    data-nama="{{ $f->nama_form }}"
                                    data-tahun="{{ $f->tahun }}"
                                    data-deskripsi="{{ $f->keterangan ?? '' }}">
                                    (F{{ $row->form_penilaian_id }}) {{ $f->nama_form }}
                                  </option>
                                @empty
                                  <option value="">— Tidak ada form tersedia —</option>
                                @endforelse
                            </select>
                            <label class="text-primary" for="formSelect">Pilih Tahun Evaluasi</label>
                        </div>
                    </div>
              
                  <div class="separator my-4"></div>
              
                  <div class="table-responsive">
                    <table class="table align-middle table-row-dashed gy-5">
                      <tbody>
                        <tr>
                          <td class="fw-semibold text-muted w-25">Nama Form</td>
                          <td id="detail-nama" class="fw-bold fs-6 text-gray-800">—</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold text-muted">Tahun</td>
                          <td id="detail-tahun" class="fw-bold fs-6 text-gray-800">—</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold text-muted align-top">Deskripsi</td>
                          <td id="detail-deskripsi" class="fw-normal text-gray-700">—</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

            <!-- Hasil Evaluasi Radar Chart -->
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title fw-bold">
                        <span class="me-2">
                            <div class="symbol symbol-5px symbol-square flex-shrink-0">
                                <img src="{{ asset('assets/media/icons/duotune/abstract/abs037.svg') }}" alt="logo" 
                                     style="width: 20px; height: 20px;" />  
                            </div>
                        </span>
                        Hasil Evaluasi Kematangan TIK 2025
                    </h3>
                </div>
                
                <div class="separator separator-dotted separator-content border-danger my-0"><span class="h6 text-danger"> CHART </span></div>

                <div class="card-body">
                    <div class="card-body">
                        <canvas id="spbeRadarChart" style="height: 600px"></canvas>
                    </div>

                    {{-- Tabel Evaluasi --}}
                    <div class="card card-flush mb-5">
                        <br> <br>
                        <div class="separator separator-dotted separator-content border-primary my-0"><span class="h6 text-primary"> INFORMASI & NILAI KEMATANGAN </span></div> <br>

                        <div class="card-body">
                            <table class="table table-bordered align-middle">
                                <tbody> 
                                    <tr class="fw-bold bg-light">
                                        <td colspan="3">
                                            <div class="text-muted">Nama Satuan Kerja</div>
                                            <span>
                                                <div class="fw-bold fs-6 text-gray-800 mt-1">{{ $userSatker ?? 'Belum diisi' }}</div>
                                            </span>
                                            <div class="separator border-primary-light my-2"></div>
                                        </td>
                                    </tr>
                                    <!-- Garis tebal hitam -->
                                    <tr>
                                        <td colspan="3" class="p-0">
                                            {{-- <div style="border-top: 3px dashed #000;"></div> --}}
                                        </td>
                                    </tr>
                                    <tr class="border-dashed border-dark">
                                        <td>Tingkat</td>
                                        <td>:</td>
                                        <td>{{ $userTingkatNama ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr class="bg-light fw-bold">
                                        <td>Indeks Kematangan TIK</td>
                                        <td>:</td>
                                        <td id="indeksKematangan">{{ number_format($indeksKematangan, 1) }}</td>
                                    </tr>
                                    <tr class="bg-light fw-bold">
                                        <td>Predikat Kematangan TIK</td>
                                        <td>:</td>
                                        <td id="predikatKematangan">{{ $predikatKematangan }}</td>
                                    </tr>
                    
                                    <!-- Garis tebal hitam -->
                                    <tr>
                                        <td colspan="3" class="p-0">
                                            {{-- <div style="border-top: 3px dashed #000;"></div> --}}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <br>
                        <br>
                        <div class="separator separator-dotted separator-content border-success my-0"><span class="h6 text-success"> ASPEK </span></div>
                        <br>

                        <div class="card-body">
                            <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                                <thead class="text-center fw-bold">
                                    <tr>
                                    <th>Aspek</th>
                                    <th></th>
                                    <th style="width: 60px;" class="text-center">Nilai Kematangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-soal-body">
                                    <tr><td colspan="3" class="text-center text-muted">Pilih form terlebih dahulu…</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="separator separator-dotted separator-content border-info my-0"><span class="h6 text-info"> INDIKATOR </span></div> 
                    <br>
                    <br>

                    <div class="table-responsive">
                        <table id="tbl-jawaban" class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                            <thead class="text-center fw-bold">
                                <tr>
                                    <th style="width:60px;">No.</th>
                                    <th>Indikator</th>
                                    <th style="width:180px;" class="text-center">Nilai</th>
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
                                        <th>Jawaban</th>
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


    {{-- Script untuk pilih formulir --}}
    <script>
        (function() {
            const select = document.getElementById('formSelect');
            // const idEl   = document.getElementById('detail-id');
            const namaEl = document.getElementById('detail-nama');
            const thnEl  = document.getElementById('detail-tahun');
            const descEl = document.getElementById('detail-deskripsi');

            function apply(selOpt) {
            if (!selOpt) return;
            // idEl.textContent   = selOpt.dataset.id || '—';
            // Hapus prefix “(Fxxxx) ” dari label jika ingin pakai text penuh:
            namaEl.textContent = selOpt.dataset.nama || '—';
            thnEl.textContent  = selOpt.dataset.tahun || '—';
            descEl.textContent = selOpt.dataset.deskripsi || '—';
            }

            // set nilai awal
            apply(select.options[select.selectedIndex]);

            // update saat berubah
            select.addEventListener('change', function() {
            apply(this.options[this.selectedIndex]);
            });
        })();
    </script>

    {{-- Script untuk Chart, Soal/Aspek dan jawaban/indikator --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
        const selectEl  = document.getElementById('formSelect');
        const radarCtx  = document.getElementById('spbeRadarChart').getContext('2d');
        const soalBody  = document.getElementById('tbl-soal-body');
        const jawabBody = document.querySelector('#tbl-jawaban tbody');
        let radarChart = null;

        function initJawabanDataTable() {
            if ($.fn.DataTable.isDataTable('#tbl-jawaban')) {
                $('#tbl-jawaban').DataTable().destroy();
            }
            $('#tbl-jawaban').DataTable({
                paging: true,
                pageLength: 10,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: false,
                // pakai style pagination yang cocok
                pagingType: 'simple_numbers', // « 1 2 3 »
                // biar kelas bootstrap/metronic nempel di pagination
                drawCallback: function () {
                const $p = $(this.api().table().container())
                    .find('.dataTables_paginate .pagination');
                $p.addClass('pagination-primary'); // metronic-ish
                }
            });
        }

        // ------ helpers
        const currentSatkerId = () => {
            const opt = selectEl.options[selectEl.selectedIndex];
            return opt ? opt.dataset.satker : null;
        };
        const fillDetails = (opt) => {
            if (!opt) return;
            document.getElementById('detail-nama').textContent      = opt.dataset.nama || '—';
            document.getElementById('detail-tahun').textContent     = opt.dataset.tahun || '—';
            document.getElementById('detail-deskripsi').textContent = opt.dataset.deskripsi || '—';
        };

        // ------ chart
        const loadChart = async (formSatkerId) => {
            if (!formSatkerId) return;
            const url = "{{ route('chart.data', ':id') }}".replace(':id', formSatkerId);
            const res = await fetch(url, { headers:{'Accept':'application/json'} });
            if (!res.ok) return console.error('chart HTTP', res.status);
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
        };

        // ------ tabel SOAL (aspek)
        const loadSoalTable = async (formSatkerId) => {
            if (!formSatkerId) return;
            soalBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Memuat…</td></tr>`;
            const url = "{{ route('dashboard.soalData', ':id') }}".replace(':id', formSatkerId);
            try {
            const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
            const data = await res.json();
            if (!data.length) return soalBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Data Belum Tersedia.</td></tr>`;
            soalBody.innerHTML = data.map(r => `
                <tr>
                <td class="bg-light fw-bold">${r.soal}</td>
                <td class="text-center bg-light fw-bold"></td>
                <td class="text-center bg-light fw-bold">${parseFloat(r.nilai ?? 0).toFixed(1)}</td>
                </tr>
            `).join('');
            } catch(e){ 
            console.error(e);
            soalBody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Data Belum Tersedia.</td></tr>`;
            }
        };

        // ------ tabel JAWABAN (indikator)
    const loadJawaban = async (formSatkerId) => {
            const tbody = document.querySelector('#tbl-jawaban tbody');

            // placeholder
            if (!formSatkerId) {
            if ($.fn.DataTable.isDataTable('#tbl-jawaban')) $('#tbl-jawaban').DataTable().destroy();
            tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Form belum dipilih.</td></tr>`;
            initJawabanDataTable();
            return;
            }

            // saat memuat
            if ($.fn.DataTable.isDataTable('#tbl-jawaban')) $('#tbl-jawaban').DataTable().destroy();
            tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Memuat…</td></tr>`;

            try {
            const url = "{{ route('dashboard.jawaban', ':id') }}".replace(':id', formSatkerId);
            const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept':'application/json' } });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const rows = await res.json();

            if (!Array.isArray(rows) || rows.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Data Belum Tersedia.</td></tr>`;
                initJawabanDataTable();
                return;
            }

            // render baris
            tbody.innerHTML = rows.map((r,i)=>`
                <tr>
                <td class="text-center">${i+1}</td>
                <td>${r.jawaban ?? '-'}</td>
                <td class="text-center">${r.bobot_jawaban ?? 0}</td>
                </tr>
            `).join('');

            // aktifkan DataTables
            initJawabanDataTable();
            } catch (e) {
            console.error('loadJawaban error:', e);
            tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Data Belum Tersedia.</td></tr>`;
            initJawabanDataTable();
            }
        };

        // ------ init pertama
        fillDetails(selectEl.options[selectEl.selectedIndex]);
        const firstSatker = currentSatkerId() || "{{ $defaultFormSatker }}";
        await loadChart(firstSatker);
        await loadSoalTable(firstSatker);
        await loadJawaban(firstSatker);

        // ------ saat dropdown berubah
        selectEl.addEventListener('change', async () => {
            fillDetails(selectEl.options[selectEl.selectedIndex]);
            const id = currentSatkerId() || "{{ $defaultFormSatker }}";
            await loadChart(id);
            await loadSoalTable(id);
            await loadJawaban(id);
        });
        });
    </script>

    {{-- Indek Kematangan dan Predikat --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const selectEl = document.getElementById('formSelect');
          const indeksEl = document.querySelector('#indeksKematangan');   // <td> target indeks
          const predEl   = document.querySelector('#predikatKematangan'); // <td> target predikat
        
          // helper ambil id_form_penilaian_satker dari option
          function currentSatkerId() {
            const opt = selectEl.options[selectEl.selectedIndex];
            return opt ? opt.dataset.satker : null;
          }
        
          async function loadSummary(formSatkerId) {
            if (!formSatkerId) {
              indeksEl.textContent = '0.0';
              predEl.textContent   = '-';
              return;
            }
            try {
              const url = "{{ route('dashboard.summary', ':id') }}".replace(':id', formSatkerId);
              const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
              if (!res.ok) throw new Error('HTTP ' + res.status);
              const json = await res.json();
        
              // Controller akan kirim { indeks: number, predikat: string }
              indeksEl.textContent = (json.indeks ?? 0).toFixed(1);
              predEl.textContent   = json.predikat ?? '-';
            } catch (e) {
              console.error('loadSummary error:', e);
              indeksEl.textContent = '0.0';
              predEl.textContent   = '-';
            }
          }
        
          // init pertama
          loadSummary(currentSatkerId());
        
          // saat dropdown berubah
          selectEl.addEventListener('change', () => loadSummary(currentSatkerId()));
        });
    </script>

@endsection
