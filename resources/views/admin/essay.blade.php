@extends("admin.layout")
@section("title", "Admin Dashboard Skripsi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Skripsi</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Data Skripsi</strong>
            </div>

            <div class="card-body">
                @if(session("success"))
                    <div class="alert alert-success">{{ session("success") }}</div>
                @endif

                @if(session("error"))
                    <div class="alert alert-danger">{{ session("error") }}</div>
                @endif

                <table class="table table-striped table-bordered" width="100%" id="tableEssay">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Tahun</th>
                            <th>Penulis</th>
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
            $("#tableEssay").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/admin/essay/json/datatable/group_by_all_exclude_code",
                order: [0, "DESC"],
                columns: [
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: "title" },
                    { data: "publication_year" },
                    { data: "author_name" },
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return "<a href='/admin/essay/detail?id="+data+"' class='btn btn-warning'>Lihat</a>";
                        }
                    }
                ]
            });
        });
    </script>
@endsection