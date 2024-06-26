@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-3">
        {{-- <div class="row gap-3">
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">Grafik Seksi per Kebutuhan</h5>
                    <canvas id="kebutuhan-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">Grafik Kebutuhan Jurusan</h5>
                    <canvas id="jurusan-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">Grafik Kuota per Kebutuhan</h5>
                    <canvas id="kuota-chart"></canvas>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h3 class="mb-4">Grafik Jumlah Mahasiswa dan Sisa Kuota Setiap Kebutuhan</h3>
                    </div>
                    <canvas id="kebutuhan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Kebutuhan Chart
        var labels = @json($kebutuhanLabels);
        var jumlah = @json($jumlah);
        var sisaKuota = @json($sisaKuota);

        var ctx1 = $("#kebutuhan").get(0).getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                        label: "Siswa Magang",
                        data: jumlah,
                        backgroundColor: "rgba(27, 58, 155, 1)"
                    },
                    {
                        label: "Sisa Kuota",
                        data: sisaKuota,
                        backgroundColor: "rgba(0, 156, 255, .5)"
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>

@endsection
