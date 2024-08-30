<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll App | Registers</title>

    {{-- Styles --}}
    <link href="niceadmins/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="niceadmins/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="niceadmins/assets/css/style.css" rel="stylesheet">


</head>

<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Your Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Daftar</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}">Log
                                                    in</a></p>
                                        </div>
                                    </form>

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
