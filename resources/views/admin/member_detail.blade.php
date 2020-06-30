@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Skripsi")
@section("content")
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/member">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
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

                <form method="post" action="/admin/member/update?id={{ $member->id }}">
                    @csrf

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" placeholder="Masukan NIM" name="nim" value="{{ old('nim') ?: $member->nim}}" required/>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="full_name" value="{{ old('full_name') ?: $member->full_name }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Telp (HP)</label>
                        <input type="text" class="form-control" placeholder="Masukan No. Telp (Handphone)" name="phone" value="{{ old('phone') ?: $member->phone }}" required/>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Masukan alamat" name="address" value="{{ old('address') ?: $member->address }}" required/>
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="MEN" {{ $member->gender == "MEN" ? "selected" : "" }}>Laki-Laki</option>
                            <option value="WOMEN" {{ $member->gender == "MEN" ? "" : "selected" }}>Perempuan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Perbarui</button>
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
                    <a href="/admin/member/delete?id={{ $member->id }}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection