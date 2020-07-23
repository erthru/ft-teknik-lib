<html>
    <head>
        <title>Hasil Pencarian | {{ env("APP_TITLE") }}</title>
        @include("includes")

        <style>
            .nav-holder {
                height: 55px;
            }

            .nav-holder input {
                margin-right: 10px;
            }

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

            @media (max-width: 576px){
                .nav-holder {
                    height: 170px;
                    padding-top: 30px;
                }

                .nav-holder form {
                    width: 100%;
                    margin-top: 10px;
                }

                .nav-holder input {
                    margin-right: 0;
                }

                .nav-holder button {
                    width: 100%;
                    margin-top: 6px;
                }
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark bg-primary nav-holder">
                <a class="navbar-brand" href="/" style="margin-top: -20px;">
                    <i class="fas fa-arrow-left" style="font-size: 18px;"></i>
                    <span class="ml-2">Kembali</span>
                </a>

                <form class="form-inline" method="get" action="/search">
                    <input class="form-control" type="search" placeholder="Cari buku/skripsi..." name="q" style="border-radius: 17px" value="{{ Request::query('q') }}" required>
                    <button class="btn btn-outline-light btn-search pr-4 pl-4" type="submit" style="border-radius: 17px">Cari</button>
                </form>
            </nav>
        </header>

        <main>
            <div class="container">
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

                        <span>Halaman {{ $items->currentPage() }} dari {{ $items->lastPage() }} halaman</span>
                    </div>
                </div>

                <br />
            </div>
        </main>
    </body>
</html>