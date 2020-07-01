@extends("admin.layout")
@section("title", "Admin Dashboard Buku")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Anggota</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Data Anggota</strong>
            </div>

            <div class="card-body">
                @if(session("success"))
                    <div class="alert alert-success">{{ session("success") }}</div>
                @endif

                <table class="table table-striped table-bordered" width="100%" id="tableMember">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Prodi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#tableMember").DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "/admin/member/json/datatable",
                order: [0, "DESC"],
                columns: [
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: "nim" },
                    { data: "full_name" },
                    { data: "phone" },
                    { data: "address" },
                    { 
                        data: "gender",
                        render: function(data, type, row, meta){
                            return data == "MEN" ? "Laki-Laki" : "Perempuan";
                        }
                    },
                    { data: "major.name" },
                    { data: "study_program.name" },
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return "<a href='/admin/member/detail?id="+data+"' class='btn btn-warning'>Lihat</a>";
                        }
                    }
                ]
            });
        });
    </script>
@endsection