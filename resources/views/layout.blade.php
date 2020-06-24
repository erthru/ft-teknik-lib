<html>
    <head>
        <title>@yield("title") | Perpustakaan Fakultas Teknik UNG</title>
                
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Perpustakaan Fakultas Teknik Universitas Negeri Gorontalo">
        <meta name="author" content="FT Teknik UNG">

        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ url('/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/favicon-16x16.png') }}">

        <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.css') }}">

        <script src="{{ url('/assets/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ url('/assets/jquery/js/jquery.js') }}"></script>
    </head>

    <body>@yield("body")</body>
</html>