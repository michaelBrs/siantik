

    {{-- Modal indikator --}}
    <div class="modal fade" tabindex="-1" id="kt_modal_penjelasan_indikator">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span>
                            <div class="symbol symbol-10px symbol-square flex-shrink-0">
                                <img src="{{ asset('assets/media/illustrations/unitedpalms-1/4.png') }}" alt="logo" />
                            </div>
                        </span>
                        <h2 class="fw-bolder mb-0">
                            Hasil Penilaian Indikator - 
                            @if ($soals->formPenilaianSatker->is_locked) 
                                <span class="badge badge-light-success">
                                    Selesai
                                </span>
                            @else
                                <span class="badge badge-light-warning">
                                    Belum Submit
                                </span>
                            @endif
                        </h2>
                    </div>

                    <div class="btn btn-sm btn-icon btn-active-light-primary btn-close-custom" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-abstract-11">
                            <span class="path1"></span>
                            <span class="path2"></span>
                           </i>

                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-4">
                        {{-- <div class="card card-flush mb-5"> --}}
                            <div class="card-body">
                                <div class="row align-items-start">
                                    {{-- LEFT: Tabel --}}
                                    <div class="col-md-10">
                                        <table class="table gs-7 gy-7 gx-7">
                                            <tr>
                                                <td class="text-uppercase"><strong>Domain</strong></td>
                                                <td>: </td>
                                                <td> {{ $soals->soal->keterangan }} </td>
                                            </tr>
                                            <tr>
                                                <td class="text-uppercase"><strong>Aspek</strong></td>
                                                <td>: </td>
                                                <td> {{ $soals->soal->soal }} </td>
                                            </tr>
                                            <tr>
                                                <td class="text-uppercase"><strong>Indikator</strong></td>
                                                <td>: </td>
                                                <td class="text-primary text-uppercase fs-4"><strong>{{ $jawabans->jawaban->jawaban }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                            
                                    {{-- RIGHT: Ilustrasi di pojok kanan --}}
                                    <div class="col-md-2 text-end">
                                        <img src="{{ asset('assets/media/illustrations/sigma-1/4.png') }}"
                                            alt="ilustrasi"
                                            style="max-height:200px;" />
                                    </div>
                                </div>
                                <!-- Tombol Penjelasan Indikator -->
                                <div class="d-flex justify-content-start mb-5">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#penjelasanIndikator" aria-expanded="false"
                                        aria-controls="penjelasanIndikator">
                                        <i class="fas fa-info-circle me-1"></i> Penjelasan Indikator
                                    </button>
                                </div>

                                <!-- Isi Penjelasan (Collapse) -->
                                <div class="collapse" id="penjelasanIndikator">
                                    <div class="alert alert-primary">
                                        <strong>Penjelasan:</strong>
                                        <h9>{{ $jawabans->jawaban->keterangan }}</h9>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        <div class="card card-flush mb-5">
                            <div class="card-body">
                                <h7 class="text-gray-400 text-hover-primary fst-italic">
                                    *Detail hasil penilaian mandiri yang dilakukan oleh Verifikator & Operator untuk pengisian penilaian terhadap indikator sesuai kondisi aktual satuan kerjanya.
                                </h7> 
                                <br> <br>
    
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped table-hover table-rounded border border-gray-300 table-row-bordered table-row-gray-300 gy-7 gs-7">
                                        <thead class="text-center fw-bold text-uppercase text-gray-600">
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 30%;">Keterangan</th>
                                                <th style="width: 55%;">Deskripsi</th>
                                                <th style="width: 20%;">Jawaban<br>Penilaian</th>
                                            </tr>
                                        </thead>
                                        <tbody id="indikator-jawaban-body">
                                            @if (isset($pilihans) && count($pilihans) > 0)
                                                @foreach ($pilihans as $pilihan)
                                                    <tr>
                                                        <td class="text-center align-top">{{ $pilihan->pilihan->urutan ?? '-' }}</td>
                                                        <td class="align-top">{{ $pilihan->pilihan->keterangan ?? '-' }}</td>
                                                        <td class="text-start text-gray-700">{{ $pilihan->pilihan->deskripsi ?? '-' }}</td>
                                                        <td class="text-center">
                                                            <input type="radio" name="id_penilaian_pilihan"
                                                                class="form-check-input"
                                                                @if(auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten'])) 
                                                                    style="pointer-events: none; opacity: 1;" 
                                                                @elseif ($soals?->formPenilaianSatker?->is_locked) 
                                                                    style="pointer-events: none; opacity: 1;" 
                                                                @endif
                                                                value="{{ $pilihan->id }}"
                                                                {{ $pilihan->is_select ? 'checked' : '' }} required />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">Data tidak ditemukan</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
    
                                <div class="separator my-4"></div>
    
                                <div class="mt-10">
                                    <h6 class="required fs-6 fw-semibold mb-2 text-muted">
                                        <span>
                                            <img class="text-white" src="{{ asset('assets/media/icons/duotune/general/gen005.svg') }}" alt="logo" />
                                        </span>
                                        Keterangan Pendukung
                                    </h6>
    
                                    <div class="mb-5">
                                        <label for="keterangan_pilihan" class="form-label fw-semibold">Catatan</label>
                                        <textarea name="keterangan_pilihan" id="keterangan_pilihan" class="form-control form-control-solid"
                                        disabled rows="4" placeholder="Tuliskan penjelasan pilihan di sini..." minlength="50" required>{{ old('keterangan_pilihan', $jawabans->keterangan_pilihan ?? '') }}</textarea>
                                    </div>
                                </div>
    
                                <div class="separator my-4"></div>
    
                                <!-- Upload Dokumen Pendukung -->
                                <div class="mb-10">
                                    <h6 for="link_pendukung" class="required fs-6 fw-semibold mb-2 text-muted">
                                        <span>
                                            <img class="text-white" src="{{ asset('assets/media/icons/duotune/general/gen002.svg') }}" alt="logo" />
                                        </span>
                                        Link Dokumen Pendukung
                                    </h6>
                                        <a href="{{ $jawabans->link_pendukung }}" class="card hover-elevate-up shadow-sm text-primary text-hover-danger parent-hover" target="_blank" rel="noopener noreferrer">
                                            <div class="card-body d-flex align-items">
                                                <span class="ms-3 text-primary text-hover-danger parent-hover-primary fs-6 fw-bold hover-elevate-down">
                                                    {{ \Illuminate\Support\Str::limit($jawabans->link_pendukung, 50) }}
                                                </span>
                                            </div>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            <div class="text-muted fs-7">Klik untuk membuka link pendukung</div>
                                        </div>
    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer justify-content-end">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
