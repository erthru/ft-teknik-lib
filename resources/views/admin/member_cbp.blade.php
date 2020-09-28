@extends("admin.layout")
@section("title", "Admin Dashboard Kartu Anggota")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/member">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cek Bebas Perpustakaan</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Cek Bebas Perpustakaan</strong>
            </div>

            <div class="card-body">
                @if(count($loanIsNotPaid) > 0)
                    <div class="alert alert-danger">
                        Masih terdapat beberapa peminjaman yang belum dikembalikan atau mempunyai denda/hilang dan belum diganti/dibayarkan
                        <br />
                        <a href="/admin/loan">Cek Data Peminjaman</a>
                    </div>
                @else
                    <div class="alert alert-success">
                        Semua peminjaman tidak ada masalah
                    </div>

                    <button class="btn btn-success mt-2">Cetak Bebas Perpustakaan</button>
                @endif
            </div>
        </div>
    </div>
@endsection