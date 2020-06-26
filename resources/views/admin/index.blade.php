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
                <div class="card-header bg-light">
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
                <div class="card-header bg-light">
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
                <div class="card-header bg-light">
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
                <div class="card-header bg-light">
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
        <div class="col-12 col-md-8 mt-4">
            <div class="card">
                <div class="card-header bg-light">
                    <strong>Siklus Peminjaman</strong>
                </div>

                <div class="card-body">
                    <canvas id="chartCycler" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mt-4">
            <div class="card">
                <div class="card-header bg-light">
                    <strong>Banyak Peminjam</strong>
                </div>

                <div class="card-body">
                    <canvas id="chartGender" height="300"></canvas>
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
