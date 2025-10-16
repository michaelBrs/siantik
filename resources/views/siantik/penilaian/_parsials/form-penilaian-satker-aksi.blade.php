<div class="d-flex justify-content-center gap-2">
    @if (! $row->is_generate)
        @role(['Admin', 'Admin Provinsi', 'Admin Kabupaten'])
            <form action="{{ route('formPenilaianSatker.generateSoalJawaban', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin generate penilaian?')">
                @csrf
                <button class="btn btn-sm btn-success">
                    <span class="text-primary">
                        <i class="bi bi-arrow-right fs-2"> </i>
                    </span> Buka
                </button>
            </form>
        @endrole

        @role(['Operator Provinsi', 'Operator Kabupaten'])
            <div class="badge badge-light-danger" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Harus dibuka terlebih dahulu oleh Verifikator."> Belum di Buka </div>
        @endrole
    @elseif ($row->formPenilaian && $row->formPenilaian->status)
        
        @if (!$row->is_locked)
            @role(['Operator Provinsi', 'Operator Kabupaten'])
                @if(!$row->submit)
                    <a href="{{ route('formPenilaianSatker.profilling', $row->id) }}" class="btn btn-sm btn-light-success">
                        <i class="fas fa-edit"></i> Profilling
                    </a>
                @else
                    <a href="{{ route('formPenilaianSatker.editProfilling', $row->id) }}" class="btn btn-sm btn-light-success">
                        <i class="fas fa-edit"></i> Profilling
                    </a>
                    <a href="{{ route('formPenilaianSatker.show', $row->id) }}" class="btn btn-sm btn-light-primary">
                        <i class="fas fa-edit"></i> Kerjakan
                    </a>
                @endif
            @endrole

            @role(['Admin', 'Admin Provinsi', 'Admin Kabupaten'])
                <a href="{{ route('formPenilaianSatker.lihatProfilling', $row->id) }}" class="btn btn-sm btn-light-success">
                    <i class="fas fa-eye"></i> Profilling
                </a>

                <a href="{{ route('formPenilaianSatker.show', $row->id) }}" class="btn btn-sm btn-light-primary">
                    <i class="fas fa-eye"></i> Lihat
                </a>

                <form id="form-kunci-{{ $row->id }}" action="{{ route('formPenilaianSatker.kunci', $row->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="button" 
                            class="btn btn-sm btn-light-danger btn-submit-kunci" 
                            data-id="{{ $row->id }}">
                        <i class="fas fa-unlock"></i> Submit
                    </button>
                </form>
            @endrole
        @else
            <a href="{{ route('formPenilaianSatker.lihatProfilling', $row->id) }}" class="btn btn-sm btn-light-success">
                <i class="fas fa-eye"></i> Profilling
            </a>

            <a href="{{ route('formPenilaianSatker.show', $row->id) }}" class="btn btn-sm btn-light-primary">
                <i class="fas fa-eye"></i> Lihat
            </a>

            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-light-danger">
                    <i class="fas fa-lock"></i>
                </button>
            </form>
        @endif
    @else
        <a href="{{ route('formPenilaianSatker.show', $row->id) }}" class="btn btn-sm btn-light-primary">
            <i class="fas fa-eye"></i> Lihat
        </a>

        <form action="" method="POST" onsubmit="return confirm('Setelah dikunci, Anda tidak bisa mengubah data. Lanjutkan?')">
            @csrf
            <button type="submit" class="btn btn-sm btn-light-danger">
                <i class="fas fa-lock"></i>
            </button>
        </form>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

