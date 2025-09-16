@if (!$row->penilaianSoal->formPenilaianSatker->is_locked)
    @if (auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten']))
        <a href="{{ route('formPenilaianSatker.getModalJawaban', ['id_penilaianSoal' => $row->id_penilaian_soal, 'id_jawaban' => $row->id_jawaban]) }}"
            class="btn btn-sm btn-light-primary btn-nilai-jawaban"
            data-url="{{ route('formPenilaianSatker.getModalJawaban', ['id_penilaianSoal' => $row->id_penilaian_soal, 'id_jawaban' => $row->id_jawaban]) }}">
            <i class="fas fa-eye"></i> Lihat
        </a>
    @else
        <a href="{{ route('formPenilaianSatker.getModalJawaban', ['id_penilaianSoal' => $row->id_penilaian_soal, 'id_jawaban' => $row->id_jawaban]) }}"
            class="btn btn-sm btn-light-primary btn-nilai-jawaban"
            data-url="{{ route('formPenilaianSatker.getModalJawaban', ['id_penilaianSoal' => $row->id_penilaian_soal, 'id_jawaban' => $row->id_jawaban]) }}">
            <i class="fas fa-edit"></i> Nilai
        </a>
    @endif
@else
    <a href="{{ route('formPenilaianSatker.getModalJawaban', ['id_penilaianSoal' => $row->id_penilaian_soal, 'id_jawaban' => $row->id_jawaban]) }}"
        class="btn btn-sm btn-light-primary btn-nilai-jawaban"
        data-url="{{ route('formPenilaianSatker.getModalJawaban', ['id_penilaianSoal' => $row->id_penilaian_soal, 'id_jawaban' => $row->id_jawaban]) }}">
        <i class="fas fa-eye"></i> Lihat
    </a>

@endif
