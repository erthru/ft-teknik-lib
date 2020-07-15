<html>
    <head>
        <title>@yield("title") {{ env("APP_TITLE") }}</title>
        @include("includes")
    </head>

    <body>
        <header>
            header
        </header>

        <main class="container">
            @yield("content")
        </main>

        <footer>
            footer
        </footer>
    </body>
</html>