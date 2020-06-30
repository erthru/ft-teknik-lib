@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Skripsi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/member">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Tambah Member Baru</strong>
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

                <form method="post" action="/admin/member/add">
                    @csrf

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" placeholder="Masukan NIM" name="nim" value="{{ old('nim') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="full_name" value="{{ old('full_name') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Telp (HP)</label>
                        <input type="text" class="form-control" placeholder="Masukan No. Telp (Handphone)" name="phone" value="{{ old('phone') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Masukan alamat" name="address" value="{{ old('address') }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="MEN">Laki-Laki</option>
                            <option value="WOMEN">Perempuan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection