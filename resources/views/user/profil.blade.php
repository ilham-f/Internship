@extends('layouts.user')

@section('content')
    <div class="container p-4" style="margin-top: 80px">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card p-4">
            <h4 class="text-center mb-3">
                Profil Anda
            </h4>
            <figcaption class="blockquote-footer text-center mt-2">
                Harap memasukkan data sesuai <cite title="Source Title">PDDIKTI</cite>
            </figcaption>
            <div class="row g-3">
                <form action="/ubahProfil" method="post">
                    @csrf
                    <input type="text" name="nama" class="form-control mb-2"
                        placeholder="Nama Lengkap" value="{{ Auth::user()->nama }}">
                    <input type="text" name="notelp" class="form-control mb-2"
                        placeholder="No. Telepon" value="{{ Auth::user()->notelp }}">
                    {{-- @dd(Auth::user()->jenis_kelamin) --}}
                    <select name="jenis_kelamin" class="form-select mb-2">
                        @if (Auth::user()->jenis_kelamin !== null)
                            @if (Auth::user()->jenis_kelamin == 0)
                                <option value="0" selected>Perempuan</option>
                                <option value="1">Laki-laki</option>
                            @else
                                <option value="0">Perempuan</option>
                                <option value="1" selected>Laki-laki</option>
                            @endif
                        @else
                            <option value="">Jenis Kelamin</option>
                            <option value="0">Perempuan</option>
                            <option value="1">Laki-laki</option>
                        @endif
                    </select>
                    <input type="text" name="nim" class="form-control mb-2"
                        placeholder="NIM" value="{{ Auth::user()->nim }}">
                    <input type="text" name="perguruan_tinggi" class="form-control mb-2"
                        placeholder="Perguruan Tinggi" value="{{ Auth::user()->perguruan_tinggi }}">
                    <input type="text" name="fakultas" class="form-control mb-2"
                        placeholder="Fakultas" value="{{ Auth::user()->fakultas }}">
                    <input type="text" name="jurusan" class="form-control mb-2"
                        placeholder="Program Studi" value="{{ Auth::user()->jurusan }}">
                    <input type="number" name="semester" class="form-control mb-3"
                        placeholder="Semester" value="{{ Auth::user()->semester }}">
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
