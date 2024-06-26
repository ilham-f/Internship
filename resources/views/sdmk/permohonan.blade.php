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
                    Permohonan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover rounded" id="permohonan">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Seksi</th>
                            <th scope="col">Kebutuhan</th>
                            <th scope="col" class="text-center">Proposal</th>
                            <th scope="col" class="text-center">Pengantar</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonanbaru as $permohonan)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $permohonan->user->nama }}</td>
                                <td>{{ $permohonan->seksi->nama_seksi }}</td>
                                <td>{{ $permohonan->kebutuhan_magang->kebutuhan }}</td>
                                <td class="text-center"><a target="_blank" href="{{ asset('storage/'. $permohonan->proposal) }}" class="btn btn-outline-dark"><i class="bi bi-file-earmark-pdf"></i></a></td>
                                <td class="text-center"><a target="_blank" href="{{ asset('storage/'. $permohonan->surat_pengantar) }}" class="btn btn-outline-dark"><i class="bi bi-file-earmark-pdf"></i></a></td>
                                <td class="text-center">
                                    <button class="btn btn-info infoBtn" data-id="{{ $permohonan->id }}"><i
                                            class="bi bi-info-lg"></i></button>
                                    <button class="btn btn-warning ubahBtn" data-id="{{ $permohonan->id }}"><i
                                            class="bi bi-pencil"></i></button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Permohonan</h1>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Permohonan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/editpermohonan" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pb-0" id="ubahBody">
                    </div>
                    <div class="text-end px-3 pb-3 mt-3">
                        <button type="submit" class="btn btn-warning">Simpan</button>
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
                    url: "/detailpermohonan",
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
                    url: "/ubahpermohonan",
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
                    url: "/hapuspermohonan",
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
            $('#permohonan').DataTable({
                pagingType: 'simple_numbers',
                ordering: false,
            });
        });
    </script>
@endsection
