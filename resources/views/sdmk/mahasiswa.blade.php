@extends('layouts.sdmk')

@section('content')
    <div class="container-fluid p-4">
        @if (session('ubah'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('ubah') }}
                <button type="button" class="btn-close py-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('gagalubah'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('gagalubah') }}
                <button type="button" class="btn-close py-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    Mahasiswa
                    <a href="/export-mahasiswa" class="btn btn-success">
                        <i class="bi bi-download me-2"></i>
                        Excel
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover rounded" id="mahasiswa">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Nim</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Perguruan Tinggi</th>
                            <th scope="col">Seksi</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->perguruan_tinggi }}</td>
                                <td>{{ $mahasiswa->seksi->nama_seksi }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info infoBtn" data-id="{{ $mahasiswa->id }}"><i
                                            class="bi bi-info-lg"></i></button>
                                    <button class="btn btn-warning ubahBtn" data-id="{{ $mahasiswa->id }}"><i
                                            class="bi bi-pencil"></i></button>
                                    <button class="btn btn-danger hapusBtn" data-id="{{ $mahasiswa->id }}"><i
                                            class="bi bi-x-lg"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Info -->
    <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="infoBody">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah -->
    <div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/editmahasiswa" method="post">
                    @csrf
                    <div class="modal-body pb-0" id="ubahBody">
                    </div>
                    <div class="text-end px-3 pb-3">
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/deletemahasiswa" method="post">
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
                    url: "/detailmahasiswa",
                    data: {
                        id: data
                    },
                    success: function(response) {
                        $('#infoBody').html(response);
                        $('#info').modal("show");
                    }
                });
            });

            // UBAH
            $('.ubahBtn').click(function() {
                var data = $(this).attr("data-id");
                // alert(id)
                $.ajax({
                    type: "post",
                    url: "/ubahmahasiswa",
                    data: {
                        id: data
                    },
                    success: function(response) {
                        $('#ubahBody').html(response);
                        $('#ubah').modal("show");
                    }
                });
            });

            // HAPUS
            $('.hapusBtn').click(function() {
                var data = $(this).attr("data-id");
                // alert(id)
                $.ajax({
                    type: "post",
                    url: "/hapusmahasiswa",
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

    {{-- DataTable --}}
    <script>
        $(document).ready(function() {
            $('#mahasiswa').DataTable({
                pagingType: 'simple_numbers',
                ordering: false,
            });
        });
    </script>
@endsection
