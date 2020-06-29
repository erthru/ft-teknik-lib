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

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tableBook">
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
    </div>

    <script>
        $(document).ready(function () {
            $("#tableBook").DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/essay/datatable/group_by_all_exclude_code",
                columns: [
                    {
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