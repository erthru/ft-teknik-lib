@extends("admin.layout")
@section("title", "Admin Dashboard Laporan")
@section("content")
    <style>
        .report-date {
            text-align: center;
            visibility: hidden;
            margin-top: -26px;
        }

        @media print{
            html, body {
                background-color: #FFF;
                visibility: hidden;
                margin-top: -245px;
            }

            .areaToPrint * {
                visibility: visible;
            }

            .areaToPrint table {
                font-size: 12px;
            }

            .areaToPrint table tbody {
                overflow-y: auto !important;
                height: auto !important;
            }

            .report-date {
                margin-top: 0px;
            }
        }
    </style>

    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Data Laporan</strong>
            </div>

            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Mulai Dari</label>
                                <input type="date" class="form-control" name="from" value="{{ Request::query('from') }}" required />
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Sampai</label>
                                <input type="date" class="form-control" name="to" value="{{ Request::query('to') }}" required />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Filter</button>
                </form>

                @if(!empty(Request::query('from')) && !empty(Request::query('to')))
                    <select id="selectPrintArea" class="form-control">
                        <option value="">Pilih data yang akan ingin ditampilkan</option>
                        <option value="book">Buku</option>
                        <option value="essay">Skripsi</option>
                        <option value="loan">Peminjaman</option>
                    </select>
                @endif

                <div id="printAreaBook">
                    <p class="report-date">Laporan dari {{ date("d/m/y", strtotime(Request::query("from"))) }} sampai {{ date("d/m/y", strtotime(Request::query("to"))) }}</p>

                    <h4>Buku</h4>
                    <span>Total: {{ $registeredBooks->count() }}</span>
                    
                    <div style="overflow-x:auto;">
                        <table class="table table-striped  table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>ISBN/ISSN</th>
                                    <th>Tahun Terbit</th>
                                    <th>Pengarang</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($registeredBooks as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->isbn_issn }}</td>
                                        <td>{{ $item->publication_year }}</td>
                                        <td>{{ $item->author_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="printAreaEssay">
                    <p class="report-date">Laporan dari {{ date("d/m/y", strtotime(Request::query("from"))) }} sampai {{ date("d/m/y", strtotime(Request::query("to"))) }}</p>

                    <h4>Skripsi</h4>
                    <span>Total: {{ $registeredEssays->count() }}</span>
                    
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Penulis</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($registeredEssays as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->publication_year }}</td>
                                        <td>{{ $item->author_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="printAreaLoan">
                    <p class="report-date">Laporan dari {{ date("d/m/y", strtotime(Request::query("from"))) }} sampai {{ date("d/m/y", strtotime(Request::query("to"))) }}</p>

                    <h4>Peminjaman</h4>
                    <span>Total: {{ $registeredLoans->count() }}</span>
                    <br />
                    <span>Aktif: {{ $registeredLoansActiveCount }}</span>
                    <br />
                    <span>Selesai: {{ $registeredLoans->count() - $registeredLoansActiveCount }}</span>
                    <br />
                    <span>Hilang: {{ $registeredLoansLostCount }}</span>
                    
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Tipe</th>
                                    <th>Tgl Jth Tempo</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($registeredLoans as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->member->nim }}</td>
                                        <td>{{ $item->member->full_name }}</td>
                                        <td>{{ $item->item->title }}</td>
                                        <td>{{ $item->item->type == "BOOK" ? "Buku" : "Skripsi" }}</td>
                                        <td>{{ date("d/m/y",strtotime($item->due_date)) }}</td>
                                        <td>
                                            @php
                                                if($item->is_lost == "1"){
                                                    echo "Hilang";
                                                }else {
                                                    if($item->returned_date == null){
                                                        echo "Belum dikembalikan";
                                                    }else{
                                                        $a = new DateTime($item->due_date);
                                                        $b = new DateTime($item->returned_date);
                                                        $c = $a->diff($b)->format("%R%a");

                                                        echo $c < 1 ? "Tepat Waktu" : "Terlambat ".str_replace("+", "", $c)." Hari";
                                                    }
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <button class="btn btn-success" id="btnPrint" onClick="printExecute()">Cetak</button>
            </div>
        </div>
    </div>

    <script>
        $("#printAreaBook").hide();
        $("#printAreaEssay").hide();
        $("#printAreaLoan").hide();
        $("#btnPrint").hide();

        $("#selectPrintArea").change(function (){
            if($(this).val() == ""){
                $("#printAreaBook").hide();
                $("#printAreaBook").removeAttr("class");

                $("#printAreaEssay").hide();
                $("#printAreaEssay").removeAttr("class");

                $("#printAreaLoan").hide();
                $("#printAreaLoan").removeAttr("class");

                $("#btnPrint").hide();
            }
            
            if($(this).val() == "book"){
                $("#printAreaBook").show();
                $("#printAreaBook").attr("class","areaToPrint");

                $("#printAreaEssay").hide();
                $("#printAreaEssay").removeAttr("class");

                $("#printAreaLoan").hide();
                $("#printAreaLoan").removeAttr("class");

                $("#btnPrint").show();
            }
            
            if($(this).val() == "essay"){
                $("#printAreaBook").hide();
                $("#printAreaBook").removeAttr("class");

                $("#printAreaEssay").show();
                $("#printAreaEssay").attr("class", "areaToPrint");

                $("#printAreaLoan").hide();
                $("#printAreaLoan").removeAttr("class");
                
                $("#btnPrint").show();
            }
            
            if($(this).val() == "loan"){
                $("#printAreaBook").hide();
                $("#printAreaBook").removeAttr("class");

                $("#printAreaEssay").hide();
                $("#printAreaEssay").removeAttr("class");

                $("#printAreaLoan").show();
                $("#printAreaLoan").attr("class", "areaToPrint");

                $("#btnPrint").show();
            }
        })

        function printExecute(){
            print();
        }
    </script>
@endsection