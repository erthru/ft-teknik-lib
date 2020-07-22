<html>
    <head>
        <title>@yield("title") | {{ env("APP_TITLE") }}</title>
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

            main {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            footer {
                padding-top: 8px;
                padding-bottom: 30px;
                flex-shrink: 0;
            }

            hr {
                margin-top: 4px; 
                margin-bottom: 4px
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
                        <li class="header-item {{ Request::is('/') ? 'current' : '' }}">
                            <a href="/">Beranda</a>
                        </li>

                        <li class="header-item {{ Request::is('vm') ? 'current' : '' }}">
                            <a href="/vm">Visi Misi</a>
                        </li>

                        <li class="header-item {{ Request::is('help') ? 'current' : '' }}">
                            <a href="/help">Bantuan</a>
                        </li>

                        <li class="header-item {{ Request::is('about') ? 'current' : '' }}">
                            <a href="/about">Tentang</a>
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
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                    @yield("content")
                </div>
                
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="mt-3">
                        <div class="card">
                            <div class="card-body d-flex justify-content-center">
                                <script async defer id='202072274622346' src='https://widgets.worldtimeserver.com/Public.ashx?rid=202072274622346&theme=Analog&action=clock&wtsid=ID2&hex=00c7ff&city=Gorontalo&size=small'></script>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <a target="blank" href="http://ung.ac.id">Universitas Negeri Gorontalo</a>
                                <hr />
                                <a target="blank" href="http://ft.ung.ac.id/">Fakultas Teknik</a>
                                <hr />
                                <a href="https://mahasiswa.ung.ac.id">Blog Mahasiswa</a>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-dark text-white mt-3">
            <div style="position:absolute; right: 16px">
                &copy; {{ now()->year }} - {{ env("APP_TITLE") }}
            </div>
        </footer>
    </body>
</html>