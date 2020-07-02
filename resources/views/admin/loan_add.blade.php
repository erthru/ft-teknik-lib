@extends("admin.layout")
@section("title", "Admin Dashboard Tambah Peminjaman")
@section("content")
    <div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item"><a href="/admin/loan">Peminjaman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-light">
            <strong>Tambah Peminjaman Baru</strong>
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

            <form>
                <div class="form-group">
                    <label>Buku/Skripsi</label>
                    <select id="selectItem" class="form-control" required></select>
                </div>

                <div class="form-group">
                    <label>Anggota</label>
                    <select id="selectMember" class="form-control" required></select>
                </div>

                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" class="form-control" placeholder="Tentukan tanggal pinjam" required/>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $("#selectItem").select2({
                theme: "bootstrap",
                placeholder: "Cari Buku",
                ajax: {
                    url: '/admin/book/json/data/search_item_available_to_borrow',
                    data: function (params) {
                        let query = {
                            key: params.term,
                        }
                        
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.title + " ["+item.code+"] - " + (item.type == "BOOK" ? "Buku" : "Skripsi"),
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });

            $("#selectMember").select2({
                theme: "bootstrap",
                placeholder: "Cari Anggota"
            });
        });
    </script>
@endsection