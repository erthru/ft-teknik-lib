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
                    <h1 class="display-4 text-primary">{{ number_format($totalBook) }}</h1>
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
                    <h1 class="display-4 text-primary">{{ number_format($totalEssay) }}</h1>
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
                    <h1 class="display-4 text-primary">{{ number_format($totalMember) }}</h1>
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
                    <h1 class="display-4 text-primary">{{ number_format($loanActive) }}</h1>
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
                        <table class="table table-striped table-bordered" id="tableLoan">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Denda</th>
                                    <th>Keterangan</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($lastTenLoans as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->member->nim }}</td>
                                        <td>{{ $item->member->full_name }}</td>
                                        <td>{{ $item->item->title }}</td>
                                        <td>{{ date("d-m-y", strtotime($item->borrowed_date)) }}</td>
                                        <td>{{ $item->returned_date ? date("d-m-y", strtotime($item->returned_date)) : "-" }}</td>
                                        <td>
                                            Rp. 
                                            
                                            @php 
                                                $diff = date_diff(date_create($item->borrowed_date), date_create($item->returned_date))->format("%a");
                                                $diffFixed = $diff > 7 ? $diff - 7 : 0;

                                                $fine = 0;

                                                if($diffFixed > 0) {
                                                    $fine = $diffFixed * 1000;
                                                }

                                                echo !$item->returned_date ? "-" : number_format($fine) 
                                            @endphp
                                        </td>
                                        <td>
                                            @php 
                                                $diff = date_diff(date_create($item->borrowed_date), date_create($item->returned_date))->format("%a");
                                                $diffFixed = $diff > 7 ? $diff - 7 : 0;

                                                echo !$item->returned_date 
                                                    ? "Belum dikembalikan" 
                                                    : ($diffFixed == 0 
                                                        ? "Tepat waktu" 
                                                        : "Terlambat ".$diffFixed." hari") 
                                            @endphp
                                        </td>
                                        <td><a href="/admin/loan/detail?id={{ $item->id }}" class="btn btn-warning">Lihat</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanByMen = {!! json_encode($loanByMen) !!}
        const loanByWomen = {!! json_encode($loanByWomen) !!}

        const thisMonthDate = {!! json_encode($thisMonthDate) !!}
        const thisMonthNextDate = {!! json_encode($thisMonthNextDate) !!}
        const thisMonthNext2Date = {!! json_encode($thisMonthNext2Date) !!}
        const thisMonthNext3Date = {!! json_encode($thisMonthNext3Date) !!}
        const thisMonthNext4Date = {!! json_encode($thisMonthNext4Date) !!}

        const loanCycleThisMonth = {!! json_encode($loanCycleThisMonth) !!}
        const loanCycleNextMonth = {!! json_encode($loanCycleNextMonth) !!}
        const loanCycleNext2Month = {!! json_encode($loanCycleNext2Month) !!}
        const loanCycleNext3Month = {!! json_encode($loanCycleNext3Month) !!}
        const loanCycleNext4Month = {!! json_encode($loanCycleNext4Month) !!}

        const chartCycler = document.getElementById('chartCycler').getContext('2d');

        const dataCycler = {
            labels: [thisMonthNext4Date, thisMonthNext3Date, thisMonthNext2Date, thisMonthNextDate, thisMonthDate],
            datasets: [{
                label: 'Data 5 Bulan Terakhir',
                data: [loanCycleNext4Month, loanCycleNext3Month, loanCycleNext2Month, loanCycleNextMonth, loanCycleThisMonth],
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
                data: [loanByMen, loanByWomen],
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

        $("#tableLoan td").each(function (){
            console.log($(this).html())

            if($(this).html().includes("Tepat waktu")){
                $(this).attr("class", "text-success")
            }else if($(this).html().includes("Terlambat")){
                $(this).attr("class", "text-danger")
            }
        });
    </script>
@endsection