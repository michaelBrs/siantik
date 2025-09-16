<div class="d-flex gap-2">
    <a href="{{ route('soal.editSoal', $row->id) }}" class="btn btn-sm btn-light-primary">
        <i class="fas fa-edit"></i> Ubah
    </a>
    <a href="{{ route('soal.showJawaban', $row->id) }}" class="btn btn-sm btn-light-info">
        <i class="fas fa-eye"></i> Indikator
    </a>
    <form action="{{ $deleteUrl }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-light-danger">
            <i class="fas fa-trash"></i> Hapus
        </button>
    </form>
</div>