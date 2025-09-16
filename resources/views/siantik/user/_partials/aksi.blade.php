<div class="text-end">
    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-light-primary">
        <i class="fas fa-edit"></i> Edit
    </a>

    <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
    </form>
    <button type="button" class="btn btn-sm btn-light-danger btn-delete-user"
        data-user-id="{{ $user->id }}">
        <i class="fas fa-trash"></i> Hapus
    </button>
</div>
