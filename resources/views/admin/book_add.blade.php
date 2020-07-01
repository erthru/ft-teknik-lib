@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Buku")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/book">Buku</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Tambah Buku Baru</strong>
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
                
                <form method="post" action="/admin/book/add">
                    @csrf

                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Masukan kode buku" required/>
                    </div>

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Masukan judul buku" required/>
                    </div>

                    <div class="form-group">
                        <label>ISBN / ISSN</label>
                        <input type="text" class="form-control" name="isbn_issn" value="{{ old('isbn_issn') }}" placeholder="Masukan ISBN/ISSN buku" required/>
                    </div> 

                    <div class="form-group">
                        <label>Klasifikasi</label>
                        <textarea type="text" class="form-control" name="classification" value="{{ old('classification') }}" placeholder="Masukan klasifikasi buku" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <input type="number" class="form-control" name="publication_year" value="{{ old('publication_year') }}" placeholder="Masukan tahun terbit buku" required/>
                    </div>   

                    <div class="form-group">
                        <label>Pengarang</label>
                        <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" placeholder="Masukan nama dari pengarang buku" required/>
                    </div>       

                    <button type="submit" class="btn btn-success">Simpan</button>         
                </form>
            </div>
        </div>
    </div>
@endsection