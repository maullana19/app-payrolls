@extends('layouts.app')

@section('title', 'Profile')

@section('contents')

    <section class="section profile">
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('images/avatars/' . Auth::user()->image) }}" alt="Profile" class="rounded-circle">
                        <h2>{{ Auth::user()->name }}</h2>
                        <h3>{{ Auth::user()->position }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profil</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profil Detail</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8"> : {{ Auth::user()->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Posisi</div>
                                    <div class="col-lg-9 col-md-8"> : {{ Auth::user()->position }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">: {{ Auth::user()->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No HP</div>
                                    <div class="col-lg-9 col-md-8">: {{ Auth::user()->phone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tgl Dibuat</div>
                                    <div class="col-lg-9 col-md-8">: {{ Auth::user()->created_at->format('d M Y') }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{ route('update-process', Auth::user()->id_users) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No HP</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="password">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="position" class="col-md-4 col-lg-3 col-form-label">Posisi</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="position" type="text" class="form-control " id="position"
                                                value="{{ Auth::user()->position }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="id_role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="id_role" type="number" class="form-control " id="id_role"
                                                value="{{ Auth::user()->id_role }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-lg-3 col-form-label">Foto</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="image" type="file" class="form-control" id="image">
                                        </div>
                                    </div>

                                    <br>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endSection
