@extends("admin.layout")
@section("title", "Admin Dashboard")
@section("content")
    <style>
        .data-title {
            font-size: 13px;
        }
    </style>

    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
            </ol>
        </nav>
    </div>

    <div class="row" style="margin-top: -20px">
        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Buku Terdaftar</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-4 text-primary">9,621</h1>
                    <strong class="data-title">BUKU</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Skripsi Terdaftar</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-4 text-primary">4,120</h1>
                    <strong class="data-title">SKRIPSI</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Anggota Terdaftar</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-4 text-primary">987</h1>
                    <strong class="data-title">ANGGOTA</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Peminjaman Aktif</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-4 text-primary">1,129</h1>
                    <strong class="data-title">DIPINJAM</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Siklus Peminjaman</strong>
                </div>

                <div class="card-body">
                    <canvas id="chartCycler" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Banyak Peminjam</strong>
                </div>

                <div class="card-body">
                    <canvas id="chartGender" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>10 Orang Peminjam Terakhir</strong>
                </div>

                <div class="card-body">
                    <div class="tabler-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Dikembalikan</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>531414020</td>
                                    <td>Suprianto D</td>
                                    <td>How To Join Competitive Programming</td>
                                    <td>Buku</td>
                                    <td>04/10/19</td>
                                    <td>10/10/19</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>531412087</td>
                                    <td>Kayla Olivia</td>
                                    <td>Implement of Neutral Network in Big Data</td>
                                    <td>Skripsi</td>
                                    <td>01/09/19</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>531415002</td>
                                    <td>Robert Ainstain</td>
                                    <td>Algorithm and Data Structure</td>
                                    <td>Buku</td>
                                    <td>29/07/19</td>
                                    <td>04/08/19</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chartCycler = document.getElementById('chartCycler').getContext('2d');

        const dataCycler = {
            labels: ['01/2020', '02/2020', '03/2020', '04/2020', '05/2020'],
            datasets: [{
                label: 'Data 5 Bulan Terakhir',
                data: [12, 19, 3, 5, 2],
                borderWidth: 1,
                backgroundColor: "rgba(0, 123, 255, 0.4)"
            }]
        };

        const optionsCycler = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            responsive: true,
            maintainAspectRatio: false
        };

        new Chart(chartCycler, {
            type: 'line',
            data: dataCycler,
            options: optionsCycler
        });

        const chartGender = document.getElementById('chartGender').getContext('2d');

        const dataGender = {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: 'Data 5 Bulan Terakhir',
                data: [55, 102],
                borderWidth: 1,
                backgroundColor: ["rgba(0, 123, 255, 0.4)","rgba(0, 123, 255, 0.70)"]
            }]
        };

        const optionsGender = {
            responsive: true,
            maintainAspectRatio: false
        };

        new Chart(chartGender, {
            type: 'pie',
            data: dataGender,
            options: optionsGender
        });
    </script>
@endsection
