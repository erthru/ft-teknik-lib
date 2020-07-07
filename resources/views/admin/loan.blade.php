@extends("admin.layout")
@section("title", "Admin Dashboard Peminjaman")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Data Peminjaman</strong>
            </div>

            <div class="card-body">
                @if(session("success"))
                    <div class="alert alert-success">{{ session("success") }}</div>
                @endif

                <select class="form-control" id="selectType">
                    <option selected>Semua</option>
                    <option>Aktif</option>
                    <option>Selesai</option>
                </select>

                <br />

                <table class="table table-striped table-bordered" width="100%" id="tableLoan">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Prodi</th>
                            <th>Judul</th>
                            <th>Tipe</th>
                            <th>Pengarang / Penulis</th>
                            <th>Tahun Terbit</th>
                            <th>ISBN / ISSN</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Jth Tempo</th>
                            <th>Tgl Pengembalian</th>
                            <th>Denda</th>
                            <th>Keterangan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            loadAll();

            $("#selectType").on("change", function(){
                if(this.value == "Semua")
                    loadAll();
                else if(this.value == "Aktif")
                    loadActive();
                else if(this.value == "Selesai")
                    loadFinish();
            });

            function loadAll(){
                loadTable("");
            }

            function loadActive(){
                loadTable("active");
            }

            function loadFinish(){
                loadTable("finish");
            }

            function loadTable(type){
                $("#tableLoan").DataTable().clear();
                $("#tableLoan").DataTable().destroy();
                $("#tableLoan").DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    ajax: "/admin/loan/json/datatable/"+type,
                    order: [0, "DESC"],
                    columns: [
                        {
                            data: "id",
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: "member.nim" },
                        { data: "member.full_name" },
                        { data: "member.major.name" },
                        { data: "member.study_program.name" },
                        { data: "item.title" },
                        { 
                            data: "item.type" ,
                            render: function(data, type, row, meta){
                                return data == "BOOK" ? "Buku" : "Skripsi"
                            }
                        },
                        { data: "item.author_name" },
                        { data: "item.publication_year" },
                        { data: "item.isbn_issn" },
                        { 
                            data: "borrowed_date",
                            render: function(data, type, row, meta){
                                return moment(data).format("DD-MM-YY");
                            }
                        },
                        { 
                            data: "due_date",
                            render: function(data, type, row, meta){
                                return moment(data).format("DD-MM-YY");
                            }
                        },
                        { 
                            data: "returned_date",
                            render: function(data, type, row, meta){
                                return data == null ? "-" : moment(data).format("DD-MM-YY");
                            }
                        },
                        { 
                            data: null,
                            render: function(data, type, row, meta){
                                const a = moment(row.due_date);
                                const b = moment(row.returned_date);

                                const c = b.diff(a, "days") < 1 ? 0 : b.diff(a, "days");

                                let fine = 0;

                                if(c > 0){
                                    fine = c*1000;
                                }

                                return "Rp. " + (row.returned_date == null ? "-" : fine);
                            }
                        },
                        { 
                            data:null,
                            render: function(data, type, row, meta){
                                const a = moment(row.due_date);
                                const b = moment(row.returned_date);

                                const c = b.diff(a, "days") < 1 ? 0 : b.diff(a, "days");

                                return row.is_lost == "1" ? "Hilang" : row.returned_date == null ? "Belum dikembalikan" : (c == 0 ? "Tepat waktu" : "Terlambat "+c+" hari");
                            }
                        },
                        {
                            data: "id",
                            render: function (data, type, row, meta) {
                                return "<a href='/admin/loan/detail?id="+data+"' class='btn btn-warning'>Lihat</a>";
                            }
                        }
                    ],
                    drawCallback: function(settings){
                        $("#tableLoan td").each(function (){
                            console.log($(this).html())
                            
                            if($(this).html().includes("Tepat waktu")){
                                $(this).attr("class", "text-success")
                            }else if($(this).html().includes("Terlambat") || $(this).html().includes("Hilang")){
                                $(this).attr("class", "text-danger")
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection