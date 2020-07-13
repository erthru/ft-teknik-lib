@extends("admin.layout")
@section("title", "Admin Dashboard Detail Jurusan")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/major">Jurusan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Detail Jurusan</strong>
            </div>

            <div class="card-body">
                @if(session("error"))
                    <div class="alert alert-danger">{{ session("error") }}</div>
                @endif

                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach

                <form method="post" action="/admin/major/update?id={{ $major->id }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Masukan nama" name="name" value="{{ old('name') ?: $major->name }}" required />
                    </div>

                    <button type="submit" class="btn btn-warning">Perbarui</button>
                    <button type="button" data-toggle="modal" data-target="#modalDelete" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Hapus data ini ?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="/admin/major/delete?id={{ $major->id }}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection