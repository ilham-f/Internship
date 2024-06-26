<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top px-3">
    <div class="container-fluid">
        <div class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('img/dinass.png') }}" alt="Dinas Kesehatan Prov Jatim" width="75"
                height="50" />
            <a href="/" class="ml-2 text-decoration-none text-light">Dinas Kesehatan Provinsi Jawa Timur</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Tombol Data dengan Submenu -->
                <li class="nav-item ms-4">
                    <a class="nav-link text-light" href="/"> Beranda </a>
                </li>

                <li class="nav-item ms-4">
                    <a class="nav-link text-light" href="/seksi"> Seksi </a>
                </li>

                <li class="nav-item ms-4">
                    <a class="nav-link text-light" href="/lowongan"> Lowongan </a>
                </li>

                <div class="vr ms-4" id="vr"></div>

                @if (Auth::user())
                    <li class="nav-item dropdown ms-4">
                        <a class="dropdown-toggle nav-link text-light" style="cursor: pointer"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            @if (Auth::user()->role == 'mahasiswa')
                                <li><a class="dropdown-item" href="/profil">Profil</a></li>
                                <li><a class="dropdown-item" href="/kegiatanku">Kegiatanku</a></li>
                                @if (Auth::user()->tgl_selesai)
                                    @php
                                        $threeDaysAgo = Carbon\Carbon::parse(Auth::user()->tgl_selesai)->subDays(3);
                                    @endphp

                                    @if (Carbon\Carbon::now() >= $threeDaysAgo)
                                        <li><a class="dropdown-item" href="/evaluasi">Evaluasi</a></li>
                                    @endif
                                @endif
                                <form action="/logout" method="post">
                                    @csrf
                                    <li><button type="submit" class="dropdown-item text-uppercase">Logout</button></li>
                                </form>
                            @elseif (Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="/admin">Profil</a></li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <li><button type="submit" class="dropdown-item text-uppercase">Logout</button></li>
                                </form>
                            @elseif (Auth::user()->role == 'sdmk')
                                <li><a class="dropdown-item" href="/sdmk">Profil</a></li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <li><button type="submit" class="dropdown-item text-uppercase">Logout</button></li>
                                </form>
                            @endif
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-4">
                        <a class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#login"
                            href="#login"> Masuk </a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link text-light" data-bs-toggle="modal" data-bs-target="#daftar"
                            href="#daftar"> Daftar </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <script>
        let exist = '{{ Session::has('errors') }}';
        let msg = '{{ Session::get('errors') }}';
        msg = msg.replace(/&quot;/g, '\"');

        if (exist) {
            let json = JSON.parse(msg);
            let emailErr = ((typeof(json["email"]) !== 'undefined') ? json["email"] : '');
            let passErr = ((typeof(json["password_confirmation"]) !== 'undefined') ? json["password_confirmation"] : '');

            let alertText = emailErr + "\n" + passErr;
            alert(alertText);
        }

        let daftarmsg = '{{ Session::get('daftar') }}';
        if (daftarmsg) {
            alert(daftarmsg);
        }

        let masukmsg = '{{ Session::get('masuk') }}';
        if (masukmsg) {
            alert(masukmsg);
        }
    </script>
</nav>
