<html>
    <head>
        <title>Print Kartu Anggota | {{ env("APP_TITLE") }}</title>
        @include("includes")
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark bg-primary">
                <a class="navbar-brand" href="/admin/member">
                    <i class="fas fa-arrow-left" style="font-size: 18px;"></i>
                    <span class="ml-2">Kembali</span>
                </a>

                <button class="btn btn-light">Cetak</button>
            </nav>
        </header>

        <main class="container">
            <div class="mt-3 bg-primary text-white p-3" style="width: 380px">
                <h5>{{ $member->full_name }}</h5>
                
                <p>
                    <span>{{ $member->major->name }}</span>
                    <br />
                    <span style="font-size:13px">{{ $member->studyProgram->name }}</span>
                </p>
                
                <div class="d-flex justify-content-center">
                    <img src="data:image/png;base64,{{ $generatedBarcode }}"/>
                </div>
            </div>
        </main>
    </body>
</html>