@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <a href="{{ route('datamou.index') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Data Kerjasama</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalDataMou }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-handshake text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <a href="{{ route('datamou.index') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kerjasama Aktif</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $kerjasamaAktif }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-check text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <a href="{{ route('datamou.index') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kerjasama Masa Tenggang</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $kerjasamaMasaTenggang }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-exclamation text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <a href="{{ route('datamou.index') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kerjasama Kadaluarsa</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $kerjasamaKadaluarsa }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-times text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>


  <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <a href="{{ route('datamou.index') }}">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <p class="mb-1 pt-2 text-bold">Sistem Navigasi Data dan Kerjasama</p>
                <h5 class="font-weight-bolder">SENADA IV</h5>
                <p class="mb-5">Lembaga Layanan Pendidikan Tinggi IV</p>
                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{ route('datamou.index') }}">
                  Lihat Semua Kerjasama
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
              <div class="bg-gradient-primary border-radius-lg h-100">
                <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                  <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </a>
    </div>
    <div class="col-lg-5">
    <a href="https://lldikti4.kemdikbud.go.id/" target="_blank" class="text-decoration-none">
        <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    <h5 class="text-white font-weight-bolder mb-4 pt-2">Laman LLDIKTI Wilayah 4</h5>
                    <p class="text-white">Mentor Sehati</p>
                    <span class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto">
                        Kunjungi
                        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>
    </a>
</div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-4">
      <div class="card z-index-2">
      <h6 class="ms-2 mt-4 mb-0"> Jenis Mitra </h6>
        <div class="card-body p-3">
          <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="360"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Kerjasama Setiap Tahun</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('dashboard')
  <script>
    window.onload = function() {
    var ptn = @json($ptn);  // Mengambil data jumlah PTN
    var pts = @json($pts);  // Mengambil data jumlah PTS
    var non_pt = @json($non_pt);  // Mengambil data jumlah Non-PT

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["PTN", "PTS", "Non-PT"],
            datasets: [{
                label: "Kerjasama",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [ptn, pts, non_pt],  // Menggunakan variabel dari controller
                maxBarThickness: 250
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });

    var data2022 = @json($dataPerTahun[2022]);
    var data2023 = @json($dataPerTahun[2023]);
    var data2024 = @json($dataPerTahun[2024]);

    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["2022", "2023", "2024"],  // Tahun sebagai label
            datasets: [{
                label: "Kerjasama",  // Label untuk data
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 0,
                borderColor: "#cb0c9f",  // Warna garis
                backgroundColor: gradientStroke1,
                fill: true,
                data: [data2022, data2023, data2024],  // Data berdasarkan tahun
                maxBarThickness: 20
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
    }
  </script>
@endpush