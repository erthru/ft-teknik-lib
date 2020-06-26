@extends("admin.layout")
@section("title", "Admin Dashboard Detail Skripsi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/essay">Skripsi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Detail Skripsi</strong>
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
            
            <form method="post" action="/admin/essay/update?id={{ $item->id }}">
                @csrf

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?: $item->title }}" placeholder="Masukan judul skripsi" required/>
                </div>

                <div class="form-group">
                    <label>Klasifikasi</label>
                    <input type="text" class="form-control" name="classification" value="{{ old('classification') ?: $item->classification }}" placeholder="Masukan klasifikasi skripsi" required/>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" class="form-control" name="publication_year" value="{{ old('publication_year') ?: $item->publication_year }}" placeholder="Masukan tahun skripsi" required/>
                </div>   

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" class="form-control" name="author_name" value="{{ old('author_name') ?: $item->author_name }}" placeholder="Masukan nama dari penulis skripsi" required/>
                </div>       

                <button type="submit" class="btn btn-success">Perbarui</button>         
                <button type="button" data-toggle="modal" data-id="{{ $item->id }}" data-target="#modalDelete" class="btn btn-danger">Hapus</button>         
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
                <a href="/admin/essay/delete?id={{ $item->id }}" class="btn btn-danger">Hapus</a>
            </div>
            </div>
        </div>
    </div>
@endsection