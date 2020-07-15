@extends("admin.layout")
@section("title", "Admin Dashboard Prodi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prodi</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Data Prodi</strong>
            </div>

            <div class="card-body">
                @if(session("success"))
                    <div class="alert alert-success">{{ session("success") }}</div>
                @endif

                <table class="table table-striped table-bordered" width="100%" id="tableMajor">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
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
                $("#tableMajor").DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "/admin/study_program/json/datatable",
                    order: [0, "DESC"],
                    columns: [
                        {
                            data: "id",
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: "name" },
                        { data: "major.name" },
                        { 
                            data: "id",
                            render: function (data, type, row, meta) {
                                return "<a href='/admin/study_program/detail?id="+data+"' class='btn btn-warning'>Lihat</a>";
                            }
                        },
                    ]
                });
            });
        </script>
@endsection