@extends("admin.layout")
@section("title", "Admin Dashboard Laporan")
@section("content")
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
            </div>
        </div>
    </div>
@endsection