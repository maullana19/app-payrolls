<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll App | Login</title>

    {{-- Styles --}}
    <link href="niceadmins/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="niceadmins/assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">


</head>

<body style="background: #3AA6B9;">
    <main>
        <div class="container ">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="text-center">
                                <h3 class="text-white">Payroll System PT UCI</h3>
                            </div>

                            @if (session()->has('mustLogin'))
                                <x-toasts-error>
                                    {{ session('mustLogin') }}
                                </x-toasts-error>
                            @endif

                            {{-- Jika email atau password salah --}}
                            @if ($errors->any())
                                <x-toasts-error>
                                    {{ $errors->first() }}
                                </x-toasts-error>
                            @endif


                            <div class="card">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <form action="{{ route('login-process') }}" method="POST">
                                            @csrf
                                            <div class="mb-3 row">
                                                <label for="email"
                                                    class="col-sm-4 col-form-label fw-bold text-muted"> Email </label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control border-1" id="email"
                                                        name="email" required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="password"
                                                    class="col-sm-4 col-form-label fw-bold text-muted">Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control border-1" id="password"
                                                        name="password" required>
                                                </div>
                                            </div>

                                            <div class="divider"></div>
                                            <br>
                                            <div>
                                                <button class="btn btn-primary w-100" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>



    {{-- SCRIPT --}}
    <script src="niceadmins/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="niceadmins/assets/vendor/quill/quill.js"></script>
    <script src="niceadmins/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="niceadmins/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="niceadmins/assets/js/main.js"></script>
</body>

</html>
