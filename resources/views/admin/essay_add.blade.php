@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Skripsi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/essay">Skripsi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Tambah Skripsi Baru</strong>
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
                
                <form method="post" action="/admin/essay/add">
                    @csrf

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Masukan judul skripsi" required/>
                    </div>

                    <div class="form-group">
                        <label>Klasifikasi</label>
                        <input type="text" class="form-control" name="classification" value="{{ old('classification') }}" placeholder="Masukan klasifikasi skripsi" required/>
                    </div>

                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" class="form-control" name="publication_year" value="{{ old('publication_year') }}" placeholder="Masukan tahun skripsi" required/>
                    </div>   

                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" placeholder="Masukan nama dari penulis skripsi" required/>
                    </div>       

                    <button type="submit" class="btn btn-success">Simpan</button>         
                </form>
            </div>
        </div>
    </div>
@endsection