@extends('layouts.app')

@section('title', 'Data Departement')

@section('contents')
    <div>
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif
    </div>

    <x-headings title="Data Departemen">
        <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#addDepartemen">
            input Departemen
        </button>
    </x-headings>


    <div class="row">
        @foreach ($departements as $departemen)
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card ">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Settings</h6>
                            </li>
                            <li>
                                <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#editDepartemen{{ $departemen->id_departement }}">Edit</button>
                            </li>
                            <li>
                                <form action="{{ route('delete-departement', $departemen->id_departement) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <x-modals id="editDepartemen{{ $departemen->id_departement }}" title="Edit Departemen" size="modal-lg">
                        <div class="modal-body">
                            <form action="{{ route('edit-departemen-process', $departemen->id_departement) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3 row">
                                    <label for="nama_dept" class="col-sm-4 col-form-label fw-bold">Departemen</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nama_dept" name="nama_dept"
                                            value="{{ $departemen->nama_dept }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="kode_dept" class="col-sm-4 col-form-label fw-bold">Kode</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="kode_dept" name="kode_dept"
                                            value="{{ $departemen->kode_dept }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="desk_dept" class="col-sm-4 col-form-label fw-bold">Deskripsi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="desk_dept" name="desk_dept"
                                            value="{{ $departemen->desk_dept }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </x-modals>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $departemen->nama_dept }}</h5>
                        <p class="card-text">{{ $departemen->desk_dept }}</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="card-text">Kode :
                            </p>
                            <span class="badge text-bg-primary">{{ $departemen->kode_dept }}</span>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <x-modals id="addDepartemen" title="Input Departemen" size="modal-lg">

        <div class="modal-body">
            <form action="{{ route('add-departemen-process') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="nama_dept" class="col-sm-4 col-form-label fw-bold">Departemen</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_dept" name="nama_dept" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kode_dept" class="col-sm-4 col-form-label fw-bold">Kode</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kode_dept" name="kode_dept" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desk_dept" class="col-sm-4 col-form-label fw-bold">Deskripsi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="desk_dept" name="desk_dept" required>
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>

            </form>
        </div>

    </x-modals>

@endsection
