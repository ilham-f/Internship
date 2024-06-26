@extends('layouts.sdmk')

@section('content')
    <div class="container-fluid p-3">
        <div class="row gap-3">
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">pengetahuan</h5>
                    <canvas id="pengetahuan-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">keterampilan</h5>
                    <canvas id="keterampilan-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">komunikasi</h5>
                    <canvas id="komunikasi-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">problem_solve</h5>
                    <canvas id="problem_solve-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">bimbingan</h5>
                    <canvas id="bimbingan-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="row gap-3">
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">gambaran_kerja</h5>
                    <canvas id="gambaran_kerja-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">waktu_diskusi</h5>
                    <canvas id="waktu_diskusi-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">pengarahan</h5>
                    <canvas id="pengarahan-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">wifi</h5>
                    <canvas id="wifi-chart"></canvas>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="mb-4">ruangan</h5>
                    <canvas id="ruangan-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Saran Pelaksanaan Magang
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover rounded" id="saran">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pembimbing</th>
                                <th scope="col">Saran Pelaksanaan</th>
                                <th scope="col">Saran Pembimbing</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sarans as $saran)
                                <tr>
                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $saran->nama }}</td>
                                    <td>{{ $saran->pembimbing }}</td>
                                    <td>{{ $saran->saran_pelaksanaan }}</td>
                                    <td>{{ $saran->saran_pembimbing }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- @dd($pengetahuan) --}}

    <script>
        // pengetahuan Chart
        var pengetahuan = @json($pengetahuan);
        var ctxpengetahuan = $("#pengetahuan-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var pengetahuanChart = new Chart(ctxpengetahuan, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: pengetahuan
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // keterampilan Chart
        var keterampilan = @json($keterampilan);
        var ctxketerampilan = $("#keterampilan-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var keterampilanChart = new Chart(ctxketerampilan, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: keterampilan
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // komunikasi Chart
        var komunikasi = @json($komunikasi);
        var ctxkomunikasi = $("#komunikasi-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var komunikasiChart = new Chart(ctxkomunikasi, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: komunikasi
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // problem_solve Chart
        var problem_solve = @json($problem_solve);
        var ctxproblem_solve = $("#problem_solve-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var problem_solveChart = new Chart(ctxproblem_solve, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: problem_solve
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // bimbingan Chart
        var bimbingan = @json($bimbingan);
        var ctxbimbingan = $("#bimbingan-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var bimbinganChart = new Chart(ctxbimbingan, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: bimbingan
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // gambaran_kerja Chart
        var gambaran_kerja = @json($gambaran_kerja);
        var ctxgambaran_kerja = $("#gambaran_kerja-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var gambaran_kerjaChart = new Chart(ctxgambaran_kerja, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: gambaran_kerja
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // waktu_diskusi Chart
        var waktu_diskusi = @json($waktu_diskusi);
        var ctxwaktu_diskusi = $("#waktu_diskusi-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var waktu_diskusiChart = new Chart(ctxwaktu_diskusi, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: waktu_diskusi
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // pengarahan Chart
        var pengarahan = @json($pengarahan);
        var ctxpengarahan = $("#pengarahan-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var pengarahanChart = new Chart(ctxpengarahan, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: pengarahan
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // wifi Chart
        var wifi = @json($wifi);
        var ctxwifi = $("#wifi-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var wifiChart = new Chart(ctxwifi, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: wifi
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
        });

        // ruangan Chart
        var ruangan = @json($ruangan);
        var ctxruangan = $("#ruangan-chart").get(0).getContext("2d");
        // Change default options for ALL charts
        Chart.defaults.set('plugins.datalabels', {
            color: '#FE777B'
        });
        var ruanganChart = new Chart(ctxruangan, {
            type: "doughnut",
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 156, 255, .3)",
                        "rgba(0, 156, 255, .5)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .9)",
                    ],
                    data: ruangan
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // This hides all text in the legend and also the labels.
                    },
                },
                responsive: true,
            }
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
