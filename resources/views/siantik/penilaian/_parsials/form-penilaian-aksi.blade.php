<div class="d-flex justify-content-center gap-2">
    <a href="{{ $editUrl }}" class="btn btn-sm btn-light-primary">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form action="{{ $generateForm }}" method="POST" onsubmit="return confirm('Yakin ingin generate penilaian?')">
        @csrf
        <button class="btn btn-sm btn-light-success">
            <span class="text-primary">
                <i class="bi bi-arrow-right fs-2"> </i>
            </span> 
            Generate Form
        </button>
    </form>
    <form action="{{ $deleteUrl }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-light-danger">
            <i class="fas fa-trash"></i> Hapus
        </button>
    </form>
</div>