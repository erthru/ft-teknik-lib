@extends("main.layout")
@section("title", "Hasil Pencarian")
@section("content")
    <style>
        hr {
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .bullet {
            height: 8px;
            width: 8px;
            display: inline-block;
            margin-bottom: 2.5px;
            margin-left: 4px;
            border-radius: 4px;
        }
    </style>

    <div class="card mt-3">
        <div class="card-body">
            <h3>Hasil pencarian dengan kata kunci: <span class="text-danger">{{ Request::query("q") }}</span></h3>
            <label style="margin-top: -6px">Menampilkan {{ $items->total() }} Hasil</label>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div>
                <div class="bullet bg-success"></div> <span style="font-size: 14px"> : Bisa dipinjam</span>
                <br />
                <div class="bullet bg-danger"></div> <span style="font-size: 14px"> : Tidak dapat dipinjam</span>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            @foreach($items as $item)
                <h5>
                    {{ strtoupper($item->title) }}
                    <div class="bullet {{ count($item->loans) ? 'bg-danger' : 'bg-success' }}"></div>
                </h5>

                <p>
                    <span style="font-size: 14px">{{ $item->type == "BOOK" ? "BUKU" : "SKRIPSI" }} | kode: {{ strtoupper($item->code) }}</span>
                    <br />
                    <strong>oleh: {{ $item->author_name }} | {{ $item->publication_year }}</strong>
                </p>   

                <hr />                         
            @endforeach

            <nav style="display: table; margin-left: auto; margin-right: auto; margin-top: 30px">
                <ul class="pagination">
                    <li class="page-item {{ $items->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="/search?q={{ Request::query('q') }}&page={{ $items->currentPage() - 1 }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                        
                    @for($i=0; $i<$items->lastPage(); $i++)
                        <li class="page-item {{ $items->currentPage() == $i+1 ? 'active' : '' }}">
                            <a class="page-link" href="/search?q={{ Request::query('q') }}&page={{ $i+1 }}">{{ $i+1 }}</a>
                        </li>
                    @endfor
                    
                    <li class="page-item {{ $items->currentPage() == $items->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="/search?q={{ Request::query('q') }}&page={{ $items->currentPage() + 1 }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <br />
@endsection