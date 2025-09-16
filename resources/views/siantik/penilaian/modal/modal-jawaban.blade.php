<form action="{{ route('formPenilaianSatker.simpanJawaban') }}" method="POST">
    @csrf
    {{-- @dump($pilihans) --}}
    <input type="hidden" name="id_penilaian_jawaban" value="{{ $jawabans->id }}">
    <input type="hidden" name="id_jawaban" value="{{ $jawabans->id_jawaban }}">
    <input type="hidden" name="id_penilaian_soal" value="{{ $jawabans->id_penilaian_soal }}">

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
                        <h2 class="fw-bolder mb-0">Penilaian Indikator - <span class="text-muted">{{ \Illuminate\Support\Str::limit($jawabans->jawaban->jawaban, 50) }}</span> </h2>
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
                                <h7 class="text-gray-400 text-hover-primary fst-italic">*Silakan baca indikator dan penjelasan indikator dengan cermat, kemudian tentukan jawaban yang paling tepat sesuai dengan kondisi nyata di lapangan, serta berikan penjelasan atau keterangan beserta link dokumen pendukung.</h7> 
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
                                                @foreach ($pilihans as $pilih)
                                                    @foreach ($pilih->penilaianPilihans as $pilihan)
                                                        <tr>
                                                            <td class="text-center align-top">{{ $pilihan->pilihan->urutan ?? '-' }}</td>
                                                            <td class="align-top">{{ $pilihan->pilihan->keterangan ?? '-' }}</td>
                                                            <td class="text-start text-gray-700">{{ $pilihan->pilihan->deskripsi ?? '-' }}</td>
                                                            <td class="text-center">
                                                                <input type="radio" name="id_penilaian_pilihan"
                                                                    class="form-check-input"
                                                                    @if(auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten'])) 
                                                                        style="pointer-events: none; opacity: 1;" 
                                                                    @elseif ($soals->formPenilaianSatker->is_locked) 
                                                                        style="pointer-events: none; opacity: 1;" 
                                                                    @endif
                                                                    value="{{ $pilihan->id }}"
                                                                    {{ $pilihan->is_select ? 'checked' : '' }} required />
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Data tidak ditemukan</td>
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
                                        Penjelasan Pendukung
                                    </h6>
                                    @if (!$soals->formPenilaianSatker->is_locked)  
                                        <p class="text-gray-600 fst-italic">
                                            Tulis keterangan yang menjelaskan alasan memilih jawaban tersebut (misalnya referensi dokumen,
                                            catatan evaluasi, atau bukti lainnya).
                                        </p>
                                    @endif
    
                                    <div class="mb-5">
                                        {{-- <label for="keterangan_pilihan" class="form-label fw-semibold">Catatan</label> --}}
                                        <textarea name="keterangan_pilihan" id="keterangan_pilihan" class="form-control form-control-solid"
                                            @if (auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten']))
                                                disabled
                                            @elseif ($soals->formPenilaianSatker->is_locked) 
                                                disabled 
                                            @endif 
                                            rows="4" placeholder="Tuliskan penjelasan pilihan di sini..." minlength="50" maxlength="300" required>{{ old('keterangan_pilihan', $jawabans->keterangan_pilihan ?? '') }}</textarea>
                                        
                                        @if (!$soals->formPenilaianSatker->is_locked)  
                                            <small class="text-muted">Minimal 50 karakter, maksimal 300 karakter.</small>
                                        @endif
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
                                    @if ($soals->formPenilaianSatker->is_locked)  
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
                                    @else
                                        <input type="url" name="link_pendukung" id="link_pendukung"
                                            class="form-control form-control-solid"
                                            placeholder="Tuliskan link pendukung disini..."
                                            value="{{ old('link_pendukung', $jawabans->link_pendukung ?? '') }}" 
                                            @if (auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten']))
                                                disabled 
                                            @endif
                                            required>

                                        @if (auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten']))
                                            <small>
                                                @if ($jawabans->link_pendukung)
                                                    <a href="{{ $jawabans->link_pendukung }}" target="_blank" class="btn">
                                                        <div class="text-primary fs-7">Klik untuk membuka link pendukung</div>
                                                    </a>
                                                @endif

                                            </small> 
                                        @endif
                                        <small class="text-muted d-block mt-2">
                                            Masukkan URL/link ke dokumen pendukung (contoh: Google Drive, Dropbox, website, dll)
                                        </small>
                                        <small class="text-muted d-block fst-italic">
                                            *Pastikan link dapat diakses publik, jika tidak sistem tidak bisa memverifikasi dokumen.
                                        </small>
                                    @endif
    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer justify-content-end">
                    <div class="modal-footer">
                        @if (!$soals->formPenilaianSatker->is_locked)
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        
                        @role(['Operator Provinsi', 'Operator Kabupaten'])
                                <button type="submit" class="btn btn-success">Simpan</button>
                            @endrole
                        @else
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
</form>
