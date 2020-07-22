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
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark">                        
                <div class="navbar-collapse">
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


        </header>

        <main class="container">
            @yield("content")
        </main>

        <footer>
            footer
        </footer>
    </body>
</html>