@extends('layouts.user')

@section('content')
    <style>
        #pdf {
            width: 80%;
            height: 70vh;
        }
    </style>
    <div class="container p-4" style="margin-top: 80px">
        <div class="card p-4">
            <h4 class="text-center mb-3">
                Informasi Kegiatan Magang
            </h4>
            @if (session('hapus'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('hapus') }}
                    <button type="button" class="btn-close py-3" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('gagalhapus'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('gagalhapus') }}
                    <button type="button" class="btn-close py-3" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (count($permohonans))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Penempatan</th>
                            <th class="text-center" scope="col">Tugas</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonans as $permohonan)
                            <tr>
                                <td>{{ $permohonan->seksi->nama_seksi }}</td>
                                <td class="text-center">{{ $permohonan->kebutuhan_magang->kebutuhan }}</td>
                                @if ($permohonan->status == 1)
                                    <td class="text-center text-success">Diterima</td>
                                @elseif ($permohonan->status == 0)
                                    <td class="text-center text-warning">Diproses</td>
                                @else
                                    <td class="text-center text-danger">Ditolak</td>
                                @endif
                                <td class="text-center">
                                    @if ($permohonan->status != 1)
                                        <button class="btn btn-danger hapusBtn" data-id="{{ $permohonan->id }}"><i
                                            class="bi bi-x-lg"></i></button>
                                    @else
                                        <button class="btn btn-info infoBtn" data-id="{{ $permohonan->id }}"><i
                                                class="bi bi-info-lg"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center">
                    <span class="mt-5">Anda belum memiliki kegiatan magang</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Info -->
    <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="infoBody">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/deletepermohonanku" method="post">
                    @csrf
                    <input type="hidden" name="status" value="0">
                    <div class="modal-body" id="hapusBody">
                    </div>
                    <div class="text-end px-3 pb-3">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary me-2">Batal</button>
                        <button type="submit" class="btn btn-danger">Yakin</button>
                    </div>
                </form>
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
                    url: "/detailpermohonanku",
                    data: {
                        id: data
                    },
                    success: function(response) {
                        $('#infoBody').html(response);
                        $('#info').modal("show");
                    }
                });
            });

            // HAPUS
            $('.hapusBtn').click(function() {
                var data = $(this).attr("data-id");
                // alert(id)
                $.ajax({
                    type: "post",
                    url: "/hapuspermohonanku",
                    data: {
                        id: data
                    },
                    success: function(response) {
                        $('#hapusBody').html(response);
                        $('#hapus').modal("show");
                    }
                });
            });
        });
    </script>
@endsection
