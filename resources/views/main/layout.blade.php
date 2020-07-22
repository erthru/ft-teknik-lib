<html>
    <head>
        <title>@yield("title") | {{ env("APP_TITLE") }}</title>
        @include("includes")
        
        <style>
            header {
                height: 90px;
                width: 100%;
                background-image: url("{{ url('/img/bg_header.jpg') }}");
            }

            .ung-logo {
                margin-top: -10px;
                width: 60px;
                width: 60px;
            }

            .header-title {
                margin-left: 6px;
            }

            .header-title-text {
                font-weight: bold; 
                font-size: 26px; 
                display: inline-block;
            }

            .sidebar-item-holder {
                margin-top: 16.5px;
            }

            .sidebar-item {
                display: block;
                text-align:center;
                color: #595959;
                padding: 5px 10px 5px 10px;
            }

            .sidebar-item:hover{
                color: #292929;
            }

            .sidebar-current {
                color: #FFF;
                background-color: #0984e3;
                border-radius: 20px;
            }

            .sidebar-current:hover {
                color: #FFF;
            }

            .btn-search:hover {
                color: #000;
                cursor: hand;
            }

            main {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin-top: 10px;
                margin-left: 20px;
                margin-right: 6px;
            }

            .content {
                text-align: justify;
                margin-right: 20px;
            }

            hr {
                margin-top: 4px;
                margin-bottom: 4px;
            }
            
            footer {
                margin-top: 18px;
                padding-top: 8px;
                padding-bottom: 8px;
                padding-left: 16px;
                flex-shrink: 0;
                color: #FFF;
            }

            @media (max-width: 991px){
                .header-title {
                    display: table;
                    margin-right: auto;
                    margin-left: auto;
                }

                .header-search {
                    margin-top: 5px;
                }

                .header-search form {
                    display: table;
                    margin-right: auto;
                    margin-left: auto;
                }

                .content {
                    margin-top: 0px;
                }

                .content-text{
                    margin-top: 20px;
                }
            }

            @media (max-width: 768px) {
                header {
                    height: 156px;
                }

                .sidebar-item-holder {
                    margin-right: 16px;
                }
            }

            @media (max-width: 576px){
                header {
                    height: 300px;
                }

                .ung-logo {
                    display: table;
                    margin-right: auto;
                    margin-left: auto;
                }

                .header-title-text {
                    margin-top: 10px;
                    text-align: center;
                }

                .content {
                    margin-left: 0;
                    margin-right: 16px;
                }

                .header-search input {
                    text-align: center;
                }

                .header-search button {
                    display: table;
                    margin-right: auto;
                    margin-left: auto;
                    margin-top: 10px;
                }
            }
        </style>
    </head>

    <body>
        <header>
            <div class="row pt-4 header-title">
                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                    <img class="ung-logo" src="{{ url('/img/ung.png') }}"/>
                    <p class="text-white ml-2 header-title-text">PERPUSTAKAAN FAKULTAS TEKNIK</p>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-12 col-12 header-search">
                    <form class="form-inline" method="get" action="/search">
                        <input class="form-control mr-2" type="search" placeholder="Cari buku/skripsi..." name="q" style="border-radius: 17px" required>
                        <button class="btn btn-outline-light btn-search pr-4 pl-4" type="submit" style="border-radius: 17px">Cari</button>
                    </form>
                </div>
            </div>
        </header>

        <main>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                    <div class="sidebar-item-holder">
                        <div class="card">
                            <div class="card-body">
                                <a class="sidebar-item {{ Request::is('/') ? 'sidebar-current' : ''}}" href="/">Beranda</a>
                                <a class="sidebar-item {{ Request::is('vm') ? 'sidebar-current' : ''}}" href="/vm">Visi Misi</a>
                                <a class="sidebar-item {{ Request::is('help') ? 'sidebar-current' : ''}}" href="/help">Bantuan</a>
                                <a class="sidebar-item {{ Request::is('about') ? 'sidebar-current' : ''}}" href="/about">Tentang</a>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <a href="https://ung.ac.id" target="blank">Universitas Negeri Gorontalo</a>
                                <hr />
                                <a href="https://ft.ung.ac.id" target="blank">Fakultas Teknik</a>
                                <hr />
                                <a href="https://mahasiswa.ung.ac.id" target="blank">Blog Mahasiswa</a>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                    <div class="content">
                        @yield("content")
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-dark">
            &copy; {{ now()->year }} - {{ env("APP_TITLE") }}
        </footer>
    </body>
</html>