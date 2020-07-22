<html>
    <head>
        <title>@yield("title") | {{ env("APP_TITLE") }}</title>
        @include("includes")
        
        <style>
            header {
                height: 260px;
                width: 100%;
                background-image: url("{{ url('/img/bg_header.jpg') }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }

            .ung-logo {
                margin-top: -5px;
                width: 45px;
                width: 45px;
            }

            .header-title {
                font-weight: bold;
                font-size: 20px;
                display: inline-block; 
                margin-top: 20px
            }

            .header-item-holder {
                text-align: right;
                margin-top: 20px;
            }

            .header-item {
                color: #d4ddff;
                padding: 5px 10px 5px 10px;
            }

            .header-item:hover{
                color: #99afff;
            }

            .current {
                color: #000;
                background-color: #f0f0f0;
                border-radius: 20px;
            }

            .current:hover {
                color: #000;
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
                padding-bottom: 8px;
                flex-shrink: 0;
            }

            hr {
                margin-top: 4px; 
                margin-bottom: 4px
            }

            @media (max-width: 991px){
                header {
                    height: 430px;
                }

                .header-title {
                    text-align: center;
                    display: block;
                }

                .header-item-holder {
                    text-align: center;
                    margin-top: 0px;
                }

                .header-item {
                    display: block;
                    margin-right: 40px;
                    margin-left: 40px;
                }

                .ung-logo {
                    display: block;
                    margin-top: 20px;
                    margin-left: auto;
                    margin-right: auto;
                    width: 80px;
                    height: 80px;
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
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-12">
                    <div class="ml-3">
                        <img class="ung-logo" src="{{ url('/img/ung.png') }}"/>
                        <p class="text-white ml-2 header-title">PERPUSTAKAAN FAKULTAS TEKNIK</p>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 col-12 header-item-holder">
                    <a class="header-item {{ Request::is('/') ? 'current' : '' }}" href="/">Beranda</a>
                    <a class="header-item {{ Request::is('vm') ? 'current' : '' }}" href="/vm">Visi Misi</a>
                    <a class="header-item {{ Request::is('help') ? 'current' : '' }}" href="/help">Bantuan</a>
                    <a class="header-item {{ Request::is('about') ? 'current' : '' }}" href="/about">Tentang</a>
                </div>
            </div>

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
                <div class="col-xl-9 col-lg-8 col-md-8 col-12">
                    @yield("content")
                </div>
                
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
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

        <footer class="bg-dark text-white mt-3 pl-2">
            &copy; {{ now()->year }} - {{ env("APP_TITLE") }}
        </footer>
    </body>
</html>