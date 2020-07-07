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

                @if(count($items) > 1)
                    <div class="alert alert-warning">
                        <p>
                            Skripsi ini memiliki {{ count($items) }} kode yang berbeda, pilih salah satu kode tersebut untuk melakukan pembaruan.
                        </p>
                    </div>
                @endif

                @foreach($items as $item)
                    <div class="pb-3" id="layoutBtnCollapse">
                        <button class="btn btn-secondary w-100" data-toggle="collapse" data-target="#collapse{{ $item->code }}" id="btnCollapse">Kode: {{ $item->code }}</button>
                    </div>

                    <div class="collapse" id="collapse{{ $item->code }}">
                        <form method="post" action="/admin/essay/update?id={{ $item->id }}">
                            @csrf

                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code') ?: $item->code }}" placeholder="Masukan kode skripsi" required/>
                            </div>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') ?: $item->title }}" placeholder="Masukan judul skripsi" required/>
                            </div>

                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="publication_year" value="{{ old('publication_year') ?: $item->publication_year }}" placeholder="Masukan tahun skripsi" required/>
                            </div>   

                            <div class="form-group">
                                <label>Penulis</label>
                                <input type="text" class="form-control" name="author_name" value="{{ old('author_name') ?: $item->author_name }}" placeholder="Masukan nama dari penulis skripsi" required/>
                            </div>     

                            @if(count($item->loans) > 0)
                                <div class="alert alert-warning">* Tidak dapat memperbarui atau hapus, buku ini sementara dipinjam / belum dikembalikan</div>
                            @else
                                <button type="submit" class="btn btn-success">Perbarui</button>         
                                <button type="button" data-toggle="modal" data-id="{{ $item->id }}" data-target="#modalDelete" class="btn btn-danger">Hapus</button>
                            @endif              
                        </form>                
                    </div>
                @endforeach
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
                    <a href="#" class="btn btn-danger" id="linkModalDelete">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const items = {!! json_encode($items) !!};

        console.log(items);

        if(items.length == 1){
            $("#btnCollapse").click();
            $("#layoutBtnCollapse").hide();
        }

        $("#modalDelete").on("show.bs.modal", function(e) {
            const passedId = $(e.relatedTarget).data("id");
            $("#linkModalDelete").attr("href", "/admin/essay/delete?id="+passedId)
        });
    </script>
@endsection