<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dinas Kesehatan Prov Jatim</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <style>
        a {
            text-decoration: none;
        }

        .vr {
            display: inline-block;
            align-self: stretch;
            width: 1px;
            min-height: 1em;
            background-color: #fff;
            opacity: 0.5;
        }

        .raleway{
            font-family: "Raleway", sans-serif;
            font-size: 40px;
            font-optical-sizing: auto;
        }

        .raleway-regular{
            font-family: "Raleway", sans-serif;
            font-optical-sizing: auto;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
        @include('layouts.navbar')
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="">
        @yield('content')
    </div>

    {{-- Modal Login --}}
    <div class="modal fade" id="login" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/login" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2" placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <button type="submit" class="btn btn-dark mb-2" style="width: 100%">Masuk</button>
                            </div>

                        </form>
                        <div class="px-2">
                            <p class="mt-3" style="font-size: 13px; text-align: center;">Belum punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#daftar" class="text-dark"
                                    style="font-size: 13px; font-weight: 600; cursor: pointer;">Daftar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Daftar --}}
    <div class="modal fade" id="daftar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Daftar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/register" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="nama" class="form-control mb-2"
                                    placeholder="Nama Lengkap">
                            </div>
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2" placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2" id="password1"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password_confirmation" class="form-control mb-2"
                                    id="password2" placeholder="Konfirmasi Password">
                            </div>
                            <div class="row g-3 mb-2">
                                <button type="submit" class="btn btn-dark" style="width: 100%;">Daftar</button>
                            </div>
                        </form>
                        <div class="row">
                            <p class="mt-4" style="font-size: 13px; text-align: center;">Sudah punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#login" class="text-dark"
                                    style="font-size: 13px; font-weight: 600; cursor: pointer;">Masuk</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
