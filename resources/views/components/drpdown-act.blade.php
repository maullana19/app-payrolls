<div class="dropdown">
    <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Aksi
    </button>
    <ul class="dropdown-menu">
        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#editKaryawan{{ $karyawan->id }}">Edit</button>
        </li>
        <li><a class="dropdown-item" href="#">Cetak PDF</a></li>
        <li>
            <form action="{{ route('delete-karyawan', $karyawan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">Hapus</button>
            </form>
        </li>

    </ul>
</div>
