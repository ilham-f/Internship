@extends('layouts.user')

@section('content')
    <div class="container p-4" style="margin-top: 50px">
        <h4 class="text-center mb-2 mt-4">
            Informasi Lowongan Magang
        </h4>
        <div class="row row-cols-3">
            @foreach ($lowongans as $lowongan)
                <div class="col mt-4">
                    <div class="card">
                        <div class="card-header" style="background-color: transparent; white-space: nowrap; text-overflow: ellipsis; overflow: hidden">
                            {{ $lowongan->seksi->nama_seksi }}
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden">{{ $lowongan->kebutuhan }}</h6>
                            <p class="card-text">Kualifikasi : {{ $lowongan->kualifikasi }}</p>
                            @if (Auth::user())
                                @if (Auth::user()->jenis_kelamin && Auth::user()->notelp && Auth::user()->fakultas && Auth::user()->jurusan && Auth::user()->perguruan_tinggi && Auth::user()->nim && Auth::user()->semester)
                                    <button class="btn btn-outline-dark w-100 infoBtn" data-id="{{ $lowongan->id }}">Detail</button>
                                @else
                                    <button class="btn btn-outline-dark w-100 infoBtn" data-bs-toggle="modal" data-bs-target="#lengkapi">Detail</button>
                                @endif
                            @else
                                <button class="btn btn-outline-dark w-100 infoBtn" data-bs-toggle="modal" data-bs-target="#login">Detail</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Info -->
    <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="infoBody">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lengkapi Profil -->
    <div class="modal fade" id="lengkapi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="hapusBody">
                    <h5 class="">Mohon untuk melengkapi profil Anda terlebih dahulu!</h5>
                    <div class="text-end mt-3">
                        <a href="/profil" class="btn btn-info px-3">Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // INFO
            $('.infoBtn').click(function() {
                var data = $(this).attr("data-id");
                // alert(id)
                $.ajax({
                    type: "post",
                    url: "/detaillowongan",
                    data: {
                        id: data
                    },
                    success: function(response) {
                        $('#infoBody').html(response);
                        $('#info').modal("show");
                    }
                });
            });
        });
    </script>
@endsection
