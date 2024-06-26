@extends('layouts.user')

@section('content')
    <div class="container p-4" style="margin-top: 80px">
        @foreach ($seksis as $seksi)
            <div class="row my-4">
                <div class="col-md-12">
                    <h4 class="fw-bold">{{ $seksi->nama_seksi }}</h4>
                    <div>{!! $seksi->deskripsi !!}</div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
