<html>
    <head>
        <title>@yield("title") {{ env("APP_TITLE") }}</title>
        @include("includes")
        
        <style>
            header {
                height: 260px;
                width: 100%;
                background-image: url("{{ url('/img/bg_header.jpg') }}");
            }

            .header-title {
                font-weight: bold;
                font-size: 20px;
                padding-top: 5px;
            }

            .header-item {
                padding: 5px 10px 5px 10px;
            }

            .header-item a{
                color: #d4ddff;
            }

            .header-item a:hover{
                color: #99afff;
            }

            .current {
                background-color: #f0f0f0;
                border-radius: 20px;
            }

            .current a{
                color: #525252 !important;
            }

            .btn-search:hover {
                color: #000;
                cursor: hand;
            }

            @media (max-width: 991px){
                header {
                    height: 350px;
                }

                .header-title {
                    text-align: center;
                }
            }

            @media (max-width: 370px){
                .header-title {
                    font-size: 16px;
                }
            }

            @media (max-width: 310px){
                .header-title {
                    font-size: 12px;
                }
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark">                        
                <div class="navbar-collapse">
                    <p class="header-title text-white mt-3">PERPUSTAKAAN FAKULTAS TEKNIK</p>
                    
                    <ul class="navbar-nav ml-auto mt-3">
                        <li class="header-item current">
                            <a href="#">Beranda</a>
                        </li>

                        <li class="header-item">
                            <a href="#">Visi Misi</a>
                        </li>

                        <li class="header-item">
                            <a href="#">Bantuan</a>
                        </li>

                        <li class="header-item">
                            <a href="#">Tentang</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row justify-content-center mt-4">
                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                    <form class="pr-4 pl-4" method="get" action="/search">
                        <input class="form-control text-center" type="search" placeholder="Cari buku/skripsi..." name="q" style="border-radius: 20px" required>
                        
                        <div class="d-flex justify-content-center mt-2">
                            <button class="btn btn-outline-light w-50 btn-search" type="submit" style="border-radius: 20px">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </header>

        <main class="container">
            @yield("content")
        </main>

        <footer>
            footer
        </footer>
    </body>
</html>