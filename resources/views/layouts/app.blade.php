<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PT UnggulCipta | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('niceadmins/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmins/assets/css/style.css') }}" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <x-headers />

    <x-sidebars />

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <x-breadcrumbs />
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                @yield('contents')
            </div>
        </section>

    </main>

    {{-- <footer id="footer" class="footer bg-white">
        <div class="copyright">
            &copy; Copyright <strong><span>PT UnggulCipta Indra Megah</span></strong>. All Rights Reserved
        </div>
    </footer> --}}

    {{-- SCRIPT --}}
    <script src="{{ asset('niceadmins/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('niceadmins/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('niceadmins/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('niceadmins/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('niceadmins/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('niceadmins/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('niceadmins/assets/js/main.js') }}"></script>



    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>



</body>

</html>
