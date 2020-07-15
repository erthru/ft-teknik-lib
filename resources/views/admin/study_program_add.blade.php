@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Prodi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/study_program">Prodi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Tambah Prodi Baru</strong>
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

                <form method="post" action="/admin/study_program/add">
                    @csrf

                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" name="major_id" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ old("major_id") == $major->id ? "selected" : "" }}>{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Masukan nama" name="name" value="{{ old('name') }}" required />
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection