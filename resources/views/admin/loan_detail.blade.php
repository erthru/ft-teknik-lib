@extends("admin.layout")
@section("title", "Admin Dashboard Peminjaman Detail")
@section("content")
    <style>
        .text-detail {
            margin-top: -6px
        }
    </style>
    
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/loan">Peminjaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Detail Peminjaman</strong>
            </div>

            <div class="card-body">
                <label class="text-primary"><strong>Tanggal Pinjam</strong></label>
                <h3 class="text-detail">{{ date("d-m-yy", strtotime($loan->borrowed_date)) }}</h3>

                <br />

                <label class="text-primary"><strong>Tanggal Jatuh Tempo</strong></label>
                <h3 class="text-detail">{{ date("d-m-yy", strtotime($loan->due_date)) }}</h3>

                <br />

                <label class="text-primary"><strong>Tanggal Pengembalian</strong></label>
                <h3 class="text-detail">{{ $loan->returned_date ? date("d-m-yy", strtotime($loan->returned_date)) : "-" }}</h3>

                <br />

                <label class="text-primary"><strong>Keterangan</strong></label>
                <h3 class="text-detail">
                    @php
                        $a = new DateTime($loan->due_date);
                        $b = new DateTime($loan->returned_date);
                        $c = $a->diff($b)->days;
                        
                        echo $loan->is_lost == "1" 
                            ? "Hilang" 
                            : (
                                $loan->returned_date 
                                    ? (
                                        $b > $a 
                                            ? "Denda Keterlambatan Rp. ".number_format($c*1000) 
                                            : "Tepat Waktu"
                                    )
                                    : "Belum Dikembalikan"
                            );
                    @endphp
                </h3>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-light">
                <strong>Data Peminjam</strong>
            </div>

            <div class="card-body">
                <label class="text-primary"><strong>NIM</strong></label>
                <h3 class="text-detail">{{ $loan->member->nim }}</h3>

                <br />

                <label class="text-primary"><strong>Nama</strong></label>
                <h3 class="text-detail">{{ $loan->member->full_name }}</h3>

                <br />

                <label class="text-primary"><strong>Telp</strong></label>
                <h3 class="text-detail">{{ $loan->member->phone }}</h3>

                <br />

                <label class="text-primary"><strong>Alamat</strong></label>
                <h3 class="text-detail">{{ $loan->member->address }}</h3>

                <br />

                <label class="text-primary"><strong>Jenis Kelamin</strong></label>
                <h3 class="text-detail">{{ $loan->member->gender == "MEN" ? "Laki-Laki" : "Perempuan" }}</h3>

                <br />

                <label class="text-primary"><strong>Jurusan</strong></label>
                <h3 class="text-detail">{{ $loan->member->major->name }}</h3>

                <br />

                <label class="text-primary"><strong>Prodi</strong></label>
                <h3 class="text-detail">{{ $loan->member->studyProgram->name }}</h3>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-light">
                <strong>Buku / Skripsi Yang Dipinjam</strong>
            </div>

            <div class="card-body">
                <label class="text-primary"><strong>Kode</strong></label>
                <h3 class="text-detail">{{ $loan->item->code }}</h3>

                <br />

                <label class="text-primary"><strong>Tipe</strong></label>
                <h3 class="text-detail">{{ $loan->item->type == "BOOK" ? "Buku" : "Skripsi" }}</h3>

                <br />

                <label class="text-primary"><strong>Judul</strong></label>
                <h3 class="text-detail">{{ $loan->item->title }}</h3>

                <br />

                <label class="text-primary"><strong>ISBN / ISSN</strong></label>
                <h3 class="text-detail">{{ $loan->item->isbn_issn ?: "-" }}</h3>

                <br />

                <label class="text-primary"><strong>Klasifikasi</strong></label>
                <h3 class="text-detail">{{ $loan->item->classification ?: "-" }}</h3>

                <br />

                <label class="text-primary"><strong>Tahun Terbit</strong></label>
                <h3 class="text-detail">{{ $loan->item->publication_year }}</h3>

                <br />

                <label class="text-primary"><strong>Pengarang / Penulis</strong></label>
                <h3 class="text-detail">{{ $loan->item->author_name }}</h3>
            </div>
        </div>

        @if($loan->is_lost != "1" && $loan->returned_date == null)
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <strong>Aksi</strong>
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

                    <a href="#modalReturned" data-toggle="modal" class="btn btn-success">Set Telah Dikembalikan</a>
                    <a href="#modalLost" data-toggle="modal" class="btn btn-warning">Set Telah Hilang</a>
                </div>
            </div>
        @endif

        <div class="modal fade" tabindex="-1" role="dialog" id="modalReturned">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informasi</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="get" action="/admin/loan/set_returned">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $loan->id }}"/>

                            <div class="form-group">
                                <label>Tanggal Pengembalian</label>
                                <input type="date" name="returned_date" class="form-control" placeholder="Masukan tanggal" required/>
                            </div>    
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Set</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalLost">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">                        
                        <p>Set data ini telah hilang ?</p>  
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="/admin/loan/set_lost?id={{ $loan->id }}" class="btn btn-warning">Set</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection