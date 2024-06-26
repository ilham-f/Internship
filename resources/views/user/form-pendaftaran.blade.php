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
                Form Pendaftaran
            </h4>
            <div class="row g-3">
                <form action="/pendaftaran" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kebutuhan_magang_id" value="{{ $kebutuhan->id }}">
                    <input type="hidden" name="seksi_id" value="{{ $seksi->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <label for="">Proposal Magang</label>
                    <small style="font-size: 11px" class="text-danger">(PDF Max 2MB)</small>
                    <input type="file" name="proposal" class="mt-1 form-control">
                    <br>
                    <label for="">Surat Pengantar Magang</label>
                    <small style="font-size: 11px" class="text-danger">(PDF Max 2MB)</small>
                    <input type="file" name="surat_pengantar" class="mt-1 form-control">
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
