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
            <div class="mt-3 bg-primary text-white" style="width: 8.6cm; height: 5.2cm; border-radius: 8px">
                <div class="bg-white" style="height: 22px">
                    <div class="bg-white ml-auto mr-4" style="height: 40px; width: 100px; border-radius: 6px">
                        <p class="text-dark ml-2" style="font-size: 14px; font-weight: bold;">KARTU <img src="{{ url('/img/ung.png') }}" style="width: 17px; height: 17px; margin-top: -8px; margin-left: 4px"/></p>
                        <p class="text-dark ml-2" style="font-size: 14px; font-weight: bold; margin-top: -20px">ANGGOTA</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p style="font-size: 16px; text-align: center; font-weight: bold">PERPUSTAKAAN FAKULTAS TEKNIK</p>
                    <p style="font-size: 14px; text-align: center; margin-top: -20px">UNIVERSITAS NEGERI GORONTALO</p>
                </div>
                
                <div class="bg-white d-flex justify-content-center" style="height: 1.5px; margin-top: -16px; margin-right: 18px; margin-left: 18px"></div>

                <div class="mt-2" style="margin-left: 18px;">
                    <span style="font-size: 14px; font-weight: bold">{{ strtoupper($member->full_name) }}</span>
                    <br />
                    <p style="font-size: 13px; margin-top: -4px">{{ $member->major->name }} - {{ $member->studyProgram->name }}</p>
                </div>
                
                <div class="ml-auto mr-auto bg-white p-1" style="margin-top: -4px; width: min-content;">
                    <img src="data:image/png;base64,{{ $generatedBarcode }}"/>
                </div>
            </div>
        </main>
    </body>
</html>