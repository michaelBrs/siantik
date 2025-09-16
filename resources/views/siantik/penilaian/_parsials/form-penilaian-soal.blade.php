@if (!$row->formPenilaianSatker->is_locked)
    @if (auth()->user()->hasAnyRole(['Admin', 'Admin Provinsi', 'Admin Kabupaten']))
        <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('formPenilaianSatker.getPenilaianJawaban', $row->id) }}" class="btn btn-sm btn-light-primary">
                <i class="fas fa-eye"></i> lihat
            </a>
        </div>
    @else
        <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('formPenilaianSatker.getPenilaianJawaban', $row->id) }}" class="btn btn-sm btn-light-success">
                <i class="fas fa-edit"></i> Kerjakan
            </a>
        </div>
    @endif
@else
    <div class="d-flex justify-content-center gap-2">
        <a href="{{ route('formPenilaianSatker.getPenilaianJawaban', $row->id) }}" class="btn btn-sm btn-light-primary">
            <i class="fas fa-eye"></i> lihat
        </a>
    </div>
@endif