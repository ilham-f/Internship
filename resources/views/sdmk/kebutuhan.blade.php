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
                    Kebutuhan Magang
                    <a href="/export-kebutuhan" class="btn btn-success">
                        <i class="bi bi-download me-2"></i>
                        Excel
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover rounded" id="kebutuhan">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Kebutuhan</th>
                            <th scope="col">Kualifikasi</th>
                            <th scope="col" class="text-center">Kuota</th>
                            <th scope="col">Output</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kebutuhans as $kebutuhan)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $kebutuhan->kebutuhan }}</td>
                                <td>{{ $kebutuhan->kualifikasi }}</td>
                                <td class="text-center">{{ $kebutuhan->kuota }}</td>
                                @if ($kebutuhan->output)
                                    <td>{{ $kebutuhan->output }}</td>
                                @else
                                    <td>Belum ada</td>
                                @endif
                                <td class="text-center">
                                    <button class="btn btn-info infoBtn" data-id="{{ $kebutuhan->id }}"><i
                                            class="bi bi-info-lg"></i></button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kebutuhan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="infoBody">
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
                    url: "/detailkebutuhan",
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

        $(document).on('input', '#detail', function() {
            console.log('tes');
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight + 2) + 'px';
        });
    </script>

    {{-- DataTable --}}
    <script>
        $(document).ready(function() {
            $('#kebutuhan').DataTable({
                pagingType: 'simple_numbers',
                ordering: false,
            });
        });
    </script>
@endsection
