@extends("admin.layout")
@section("title", "Admin Dashboard")
@section("content")
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
                <div class="card-header bg-primary text-white">
                    <strong>Buku Terdaftar</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-3 text-primary">0</h1>
                    <strong>BUKU</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Skripsi Terdaftar</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-3 text-primary">0</h1>
                    <strong>SKRIPSI</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Anggota Terdaftar</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-3 text-primary">0</h1>
                    <strong>ANGGOTA</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Peminjaman Aktif</strong>
                </div>

                <div class="card-body text-center">
                    <h1 class="display-3 text-primary">0</h1>
                    <strong>DIPINJAM</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Siklus Peminjaman</strong>
                </div>

                <div class="card-body">
                    <canvas id="chartCycler"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartCycler').getContext('2d');

        const data = {
            labels: ['01/2020', '02/2020', '03/2020', '04/2020', '05/2020'],
            datasets: [{
                label: 'Data 5 Bulan Terakhir',
                data: [12, 19, 3, 5, 2],
                borderWidth: 1,
                backgroundColor: "rgba(0, 123, 255, 0.4)"
            }]
        };

        const options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }

        new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>
@endsection
