@extends('layouts.app')

@section('title', 'Data Potongan')

@section('contents')

    @if (session('success'))
        <x-toasts-success>{{ session('success') }}</x-toast-success>
    @endif

    @if (session('error'))
        <x-toasts-error>{{ session('error') }}</x-toast-error>
    @endif
    <div class="card">
        <div class="card-body p-0">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-bold">Data Potongan</h5>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                        data-bs-target="#addPotongan">
                        Input Potongan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Potongan</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPotongan as $potongan)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $potongan->nama_potongan }}</td>
                            <td>{{ $potongan->nominal }} %</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editPotongan{{ $potongan->id_potongan }}">Edit</button>
                                    <form action="{{ route('delete-potongan', $potongan->id_potongan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <x-modals id="editPotongan{{ $potongan->id_potongan }}" title="Edit Potongan" size=modal-lg>
                            <form action="{{ route('edit-potongan-process', $potongan->id_potongan) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 row">
                                    <label for="nama_potongan" class="col-sm-4 col-form-label fw-bold">Nama Potongan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nama_potongan" name="nama_potongan"
                                            value="{{ $potongan->nama_potongan }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nominal" class="col-sm-4 col-form-label fw-bold">Persentase
                                        Potongan</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="nominal" name="nominal"
                                            min="0" max="100" step="0.01" value="{{ $potongan->nominal }}">%
                                    </div>
                                </div>
                                <br>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary ">Simpan</button>
                                </div>

                            </form>
                        </x-modals>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-modals id="addPotongan" title="Input Potongan" size="modal-lg">
        <div class="modal-body">
            <form action="{{ route('add-potongan-process') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="nama_potongan" class="col-sm-4 col-form-label fw-bold">Nama Potongan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_potongan" name="nama_potongan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nominal" class="col-sm-4 col-form-label fw-bold">Persentase
                        Potongan</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="nominal" name="nominal" min="0"
                            max="100" step="0.01">
                        %
                    </div>
                </div>
                <br>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </x-modals>


@endSection
