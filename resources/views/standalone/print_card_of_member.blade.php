<html>
    <head>
        <title>Print Kartu Anggota | {{ env("APP_TITLE") }}</title>
        @include("includes")

        <style>
            .card-init {
                width: 8.6cm; 
                height: 5.2cm; 
                border-radius: 8px;
                overflow: hidden;
                border: solid 1px #9e9e9e;
            }

            @media print {
                html {
                    background-color: #FFF;
                }

                body {
                    visibility: hidden;
                }

                .cardToPrint * {
                    visibility: visible;
                }

                .cardToPrint {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark bg-primary">
                <a class="navbar-brand" href="/admin/member">
                    <i class="fas fa-arrow-left" style="font-size: 18px;"></i>
                    <span class="ml-2">Kembali</span>
                </a>

                <button class="btn btn-light" data-target="#modalPrint" data-toggle="modal">Cetak</button>
            </nav>
        </header>

        <main class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-12">
                    <div style="width: min-content">
                        <div id="cardFront">
                            <div class="mt-3 text-white card-init" style="background-image: url('{{ url('/img/bg_card.jpg') }}')">
                                <div class="bg-white" style="height: 22px;">
                                    <div class="bg-white ml-auto mr-4" style="height: 40px; width: 100px; border-radius: 6px; padding-top: 3px">
                                        <p class="text-dark ml-2" style="font-size: 14px; font-weight: bold;">KARTU <img src="{{ url('/img/ung.png') }}" style="width: 17px; height: 17px; margin-top: -8px; margin-left: 4px"/></p>
                                        <p class="text-dark ml-2" style="font-size: 14px; font-weight: bold; margin-top: -20px">ANGGOTA</p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <p style="font-size: 16px; text-align: center; font-weight: bold">PERPUSTAKAAN FAKULTAS TEKNIK</p>
                                    <p style="font-size: 14px; text-align: center; margin-top: -22px">UNIVERSITAS NEGERI GORONTALO</p>
                                </div>
                                
                                <div class="bg-white d-flex justify-content-center" style="height: 1px; margin-top: -14px; margin-right: 18px; margin-left: 18px"></div>

                                <div class="mt-2" style="margin-left: 18px;">
                                    <span style="font-size: 14px; font-weight: bold">{{ strtoupper($member->full_name) }}</span>
                                    <br />
                                    <p style="font-size: 11px; margin-top: -4px">{{ strtoupper($member->major->name) }} - {{ strtoupper($member->studyProgram->name) }}</p>
                                </div>
                                
                                <div class="ml-auto mr-auto bg-white p-1" style="margin-top: -4px; width: min-content;">
                                    <img src="data:image/png;base64,{{ $generatedBarcode }}"/>
                                </div>
                            </div>
                        </div>
                        
                        <label class="d-flex justify-content-center mt-1">[tampak depan]</label>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 col-12">
                    <div style="width: min-content">
                        <div id="cardBack">
                            <div class="mt-3 bg-white card-init">
                                <p class="mr-1" style="font-size: 10px; text-align: right">Kartu ini dibuat pada: {{ Date("d/m/yy", strtotime("now")) }}</p>
                                
                                <div class="bg-dark" style="height: 34px; margin-top: -16px;">
                                    <p style="text-align:center; text-shadow: 1px 1px #858585; padding-top: 4px;">UNIVERSITAS NEGERI GORONTALO</p>
                                </div>

                                <div class="ml-2 mt-2 pr-2" style="font-size: 10px">
                                    <p>Syarat dan Ketentuan: </p>
                                    <ol style="margin-top: -14px; margin-left: -18px">
                                        <li>Cek ketersediaan buku untuk dipinjam di {{ env("APP_URL") }}</li>
                                        <li>Jatuh tempo peminjaman adalah 7 hari</li>
                                        <li>Denda keterlambatan Rp. 1000 / hari</li>
                                    </ol>
                                </div>

                                <div class="mt-4">
                                    <div class="row justify-content-center">
                                        <div class="col-1">
                                            <img src="{{ url('/img/ung.png') }}" width="30px" height="30px" style="filter: grayscale(100%)"/>
                                        </div>

                                        <div class="col-6 ml-2" style="font-size: 9.5px; margin-top: 1.3px">
                                            <p>Fakultas Teknik</p>
                                            <p style="margin-top: -18px">Universitas Negeri Gorontalo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <label class="d-flex justify-content-center mt-1">[tampak belakang]</label>
                    </div>
                </div>
            </div>
        </main>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalPrint">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <select class="form-control" id="selectCard" required>
                            <option value="">Pilih</option>
                            <option value="front">Depan</option>
                            <option value="back">Belakang</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" onclick="printExecute()" id="btnPrint" disabled>Cetak</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $("#selectCard").change(function (){
                if($(this).val() == ""){
                    $("#btnPrint").attr("disabled", "");
                    $("#cardFront").removeAttr("class");
                    $("#cardBack").removeAttr("class");                    
                }else{
                    $("#btnPrint").removeAttr("disabled");

                    if($(this).val() == "front"){
                        $("#cardFront").attr("class", "cardToPrint");
                        $("#cardBack").removeAttr("class");
                    }else{
                        $("#cardBack").attr("class", "cardToPrint");
                        $("#cardFront").removeAttr("class");
                    }
                }
            });

            function printExecute(){
                print();
            }
        </script>
    </body>
</html>