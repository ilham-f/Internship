@extends('layouts.user')

@section('content')
    <style>

    </style>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="margin-top: 0px; ">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h2 class="text-uppercase text-light raleway p-3 rounded"
                    style="background-color: #00000082; white-space: nowrap; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    RUMAH TEMPAT ANDA BELAJAR DAN BERKEMBANG</h2>
                <img style="height: 85vh; object-fit:cover;" src="{{ asset('img/dinas.png') }}" class="d-block w-100"
                    alt="...">
            </div>
        </div>
    </div>
    <div class="d-flex flex-column justify-content-center align-items-center d-none d-md-flex position-relative">
        <div class="rounded-circle position-absolute bg-success" style="width: 75px; height: 75px">
            <img class="position-absolute top-50 start-50 translate-middle" src="{{ asset('img/arrow-circle.png') }}"
                alt="circle">
        </div>
    </div>

    {{-- <div class="text-center mt-2">
        <i class="bi bi-arrow-down-circle" style="font-size: 60px"></i>
    </div> --}}
    <div class="container mt-5">
        <div class="text-center py-2 mb-5 fw-medium raleway-regular">
            Di sinilah imajinasi individu berkumpul, berkomitmen pada nilai-nilai yang menghasilkan karya besar. Di sini,
            Anda akan melakukan lebih dari sekadar bergabung dengan sesuatu, Anda akan menambahkan sesuatu.
        </div>
        {{-- <div class="d-flex align-items-center">
            <div class="p-4">
                <h1 class="raleway p-3 text-center">VISI</h1>
                <p class="text-center">Terwujudnya Masyarakat Jawa Timur yang Adil, Sejahtera, Unggul, dan Berakhlak dengan Tata Kelola Pemerintahan yang Partisipatoris Inklusif melalui Kerja Bersama dan Semangat Gotong Royong</p>
            </div>
            <div class="p-4">
                <h1 class="raleway p-3 text-center">MISI</h1>
                <p class="text-center">Terciptanya Kesejahteraan yang Berkeadilan Sosial, Pemenuhan Kebutuhan Dasar Terutama Kesehatan dan Pendidikan, Penyediaan Lapangan Kerja dengan Memperhatikan Kelompok Rentan</p>
            </div>
        </div> --}}

        <p class="raleway text-center mt-5 fw-medium">Fasilitas Kami</p>
        <div class="d-flex justify-content-evenly mb-5">
            <div class="position-relative">
                <p class="text-uppercase text-light raleway-reguler px-3 py-2 rounded"
                        style="background-color: #00000082; white-space: nowrap; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        lapangan voli
                </p>
                <img src="{{ asset('img/voli.jpeg') }}" style="height: 300px" class="d-block rounded w-100" alt="...">
            </div>
            <div class="position-relative">
                <p class="text-uppercase text-light raleway-reguler px-3 py-2 rounded"
                        style="background-color: #00000082; white-space: nowrap; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        masjid
                </p>
                <img src="{{ asset('img/masjid.jpeg') }}" style="height: 300px" class="d-block rounded w-100" alt="...">
            </div>
            <div class="position-relative">
                <p class="text-uppercase text-light raleway-reguler px-3 py-2 rounded"
                        style="background-color: #00000082; white-space: nowrap; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        fitness center
                </p>
                <img src="{{ asset('img/gym.jpeg') }}" style="height: 300px" class="d-block rounded w-100" alt="...">
            </div>
        </div>
        <p class="raleway text-center mt-5 fw-medium">Bergabunglah dengan kami dan dapatkan inspirasi dalam berkarya.</p>
        <div class="text-center mb-5">
            <a href="/lowongan" class="btn btn-dark rounded-pill py-3 px-5">Lihat lowongan magang</a>
        </div>
    </div>
@endsection
