@extends('layouts.app')

@section('title', 'Admin Data user')

@section('contents')
    <div class="flex-column justify-content-center p-2 rounded text-white" style="background: #219C90;">
        <h3>Akses khusus administrator</h3>
        <p>Pembuatan Akun User</p>
    </div>

    <hr>
    @if (session('success'))
        <x-toasts-success>{{ session('success') }}</x-toasts-success>
    @endif

    @if (session('error'))
        <x-toasts-error>{{ session('error') }}</x-toasts-error>
    @endif

    <x-headings title="Data User">
        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Tambah User
        </button>
    </x-headings>

    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Position</th>
                            <th scope="col">Role</th>
                            <th scope="col">Images</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUsers as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ Str::limit($user->password, 9, '...') }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->position }}</td>
                                <td>
                                    @if ($user->id_role == 1)
                                        <span class="badge bg-primary">Admin</span>
                                    @else
                                        <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>

                                <td>
                                    <img src="{{ asset('images/' . $user->image) }}" alt="image"
                                        style="width: 50px; height: 50px;">
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editUser{{ $user->id_users }}">Edit</button>

                                        <x-modals id="editUser{{ $user->id_users }}" title="Edit User" size="modal-lg">
                                            <div class="modal-body">
                                                <form action="{{ route('edit-user-process', $user->id_users) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ $user->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email"
                                                            name="email" value="{{ $user->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" value="{{ $user->password }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            name="phone" value="{{ $user->phone }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="position" class="form-label">Position</label>
                                                        <input type="text" class="form-control" id="position"
                                                            name="position" value="{{ $user->position }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="id_role" class="form-label">Role</label>
                                                        <select class="form-select" id="id_role" name="id_role">
                                                            @foreach ($dataRole as $role)
                                                                <option value="{{ $role->id_role }}"
                                                                    {{ $user->id_role == $role->id_role ? 'selected' : '' }}>
                                                                    {{ $role->name_role }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image">
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-info w-100">Save</button>

                                                </form>
                                            </div>
                                        </x-modals>
                                        <form action="{{ route('delete-process', $user->id_users) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <x-modals id="addUserModal" title="Input User" size="modal-lg">
        <div class="modal-body">
            <form action="{{ route('add-user-process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position">
                </div>
                <div class="mb-3">
                    <label for="id_role" class="form-label">Role</label>
                    <select class="form-select" id="id_role" name="id_role">
                        @foreach ($dataRole as $role)
                            <option value="{{ $role->id_role }}">{{ $role->name_role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <br>
                <button type="submit" class="btn btn-info w-100">Save</button>

            </form>
        </div>
    </x-modals>

@endSection
