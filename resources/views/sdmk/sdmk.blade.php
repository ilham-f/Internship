@extends('layouts.sdmk')

@section('content')
    <div class="container-fluid p-3">
        <div class="row gap-3">
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
        </div>
        <div class="row">
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h3 class="mb-4">Grafik Jumlah Siswa Magang dan Sisa Kuota Tiap Seksi</h3>
                    </div>
                    <canvas id="seksi"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Jurusan Chart
        var jurusanLabels = @json($jurusanLabels);
        var jurusanData = @json($jurusanData);
        var ctxJurusan = $("#jurusan-chart").get(0).getContext("2d");
        var jurusanChart = new Chart(ctxJurusan, {
            type: "doughnut",
            data: {
                labels: jurusanLabels,
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .6)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .4)",
                        "rgba(0, 156, 255, .3)"
                    ],
                    data: jurusanData
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    }
                },
                responsive: true
            }
        });

        // Kuota Chart
        var kuotaLabels = @json($kuotaLabels);
        var kuotaData = @json($kuotaData);
        var ctxKuota = $("#kuota-chart").get(0).getContext("2d");
        var kuotaChart = new Chart(ctxKuota, {
            type: "doughnut",
            data: {
                labels: kuotaLabels,
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .6)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .4)",
                        "rgba(0, 156, 255, .3)"
                    ],
                    data: kuotaData
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    }
                },
                responsive: true
            }
        });
    </script>
    {{-- @dd($jumlah) --}}
    <script>
        // Seksi Chart
        var labels = @json($seksiLabels);
        var jumlah = @json($jumlah);
        var sisaKuota = @json($sisaKuota);

        var ctx1 = $("#seksi").get(0).getContext("2d");
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
