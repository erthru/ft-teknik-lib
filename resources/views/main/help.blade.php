@extends("main.layout")
@section("title", "Bantuan")
@section("content")
    <style>
        .col-item {
            padding-right: 10px;
            padding-left: 10px;
        }
    </style>
    
    <div class="mt-3">
        <div class="card">
            <div class="card-body">
                <h3>Bantuan</h3>
                <div>
                    <a href="#collapseZero" data-toggle="collapse">Mendaftar sebagai anggota</a>
                    <div class="collapse col-item" id="collapseZero">
                        1. Datang ke perpustakaan Fakultas Teknik UNG untuk melakukan registrasi anggota.
                        <br />
                        2. Jangan lupa untuk membawa kartu mahasiswa sebagai persyaratan pendaftaran.
                    </div>
                </div>

                <div>
                    <a href="#collapseOne" data-toggle="collapse">Cara mengecek ketersediaan buku</a>
                    <div class="collapse col-item" id="collapseOne">
                        1. Masukan judul buku pada kotak pencarian.
                        <br />
                        2. Klik tombol cari.
                    </div>
                </div>

                <div>
                    <a href="#collapseTwo" data-toggle="collapse">Tata cara peminjaman</a>
                    <div class="collapse col-item" id="collapseTwo">
                        1. Cek ketersediaan buku.
                        <br />
                        2. Datang ke perpustakaan untuk peminjaman dengan membawa kartu anggota.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
