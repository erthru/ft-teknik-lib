<html>
    <head>
        <title>@yield("title") | {{ env("APP_TITLE") }}</title>
        @include("includes")
        
        <style>
            header {
                height: 200px;
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

            .header-nav{
                margin-top: 6px;
                text-align: right;
                padding-right: 30px;
            }

            .header-nav-item {
                color: #dee7ff;
                padding: 4px 10px 4px 10px;
            }

            .header-nav-item:hover {
                color: #abc2ff;
            }

            .header-nav-current {
                color: #000;
                background-color: #FFF;
                border-radius: 20px;
            }

            .header-nav-current:hover {
                color: #000;
            }

            .header-search {
                display: table;
                margin-left: auto;
                margin-right: auto;
                margin-top: 20px;
            }

            .input-search {
                width: 350px;
                text-align: center;
                border-radius: 20px;
            }

            .btn-search {
                display: table;
                margin-right: auto;
                margin-left: auto;
                margin-top: 6px;
                border-radius: 20px;
                {{ Request::is("search") ? "background-color: white; color: #000;" : "null" }}
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
            }

            @media (max-width: 768px) {
                header {
                    height: 250px;
                }

                .header-nav {
                    margin-top: 10px;
                    text-align: center;
                    padding-right: 10px;
                }

                .header-search {
                    margin-top: 20px;
                }
            }

            @media (max-width: 576px){
                header {
                    height: 410px;
                }

                .ung-logo {
                    display: table;
                    margin-right: auto;
                    margin-left: auto;
                }

                .header-nav {
                    width: 200px;
                    display: table;
                    margin-left: auto;
                    margin-right: auto;
                }

                .header-title-text {
                    margin-top: 10px;
                    text-align: center;
                }

                .header-nav-item {
                    display: block;
                }

                .input-search {
                    width: 240px;
                    margin-left: 10px;
                }

                .btn-search {
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

                <div class="col-xl-3 col-lg-4 col-md-12 col-12 header-nav">
                    <a class="header-nav-item {{ Request::is('/') ? 'header-nav-current' : ''}}" href="/">Beranda</a>
                    <a class="header-nav-item {{ Request::is('help') ? 'header-nav-current' : ''}}" href="/help">Bantuan</a>
                    <a class="header-nav-item {{ Request::is('about') ? 'header-nav-current' : ''}}" href="/about">Tentang</a>
                </div>
            </div>

            <div class="header-search">
                <form method="get" action="/search">
                    <input class="form-control mr-2 input-search" type="search" placeholder="Cari buku/skripsi..." name="q" value="{{ Request::query('q') }}" required>
                    <button class="btn btn-outline-light btn-search pr-4 pl-4" type="submit">Cari</button>
                </form>
            </div>
        </header>

        <main>
            <div class="content">
                @yield("content")
            </div>
        </main>

        <footer class="bg-dark">
            &copy; {{ now()->year }} - {{ env("APP_TITLE") }}
        </footer>
    </body>
</html>