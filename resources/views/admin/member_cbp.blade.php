@extends("admin.layout")
@section("title", "Admin Dashboard Kartu Anggota")
@section("content")
    <style>
        .printAreaCBP {
            visibility: hidden;
            width: 65%;
        }

        @media print {
            html, body {
                background-color: #FFF;
                visibility: hidden;
                margin-top: -170px;
            }

            .printAreaCBP {
                visibility: visible;
                width: 100% !important;
            }
        }
    </style>

    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item"><a href="/admin/member">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cek Bebas Perpustakaan</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Cek Bebas Perpustakaan</strong>
            </div>

            <div class="card-body">
                @if(count($loanIsNotPaid) > 0)
                    <div class="alert alert-danger">
                        Masih terdapat beberapa peminjaman yang belum dikembalikan atau mempunyai denda/hilang dan belum diganti/dibayarkan
                        <br />
                        <a href="/admin/loan">Cek Data Peminjaman</a>
                    </div>
                @else
                    <div class="alert alert-success">
                        Semua peminjaman tidak ada masalah
                    </div>

                    <button class="btn btn-success mt-2" onclick="printExecute()">Cetak Bebas Perpustakaan</button>
                @endif
            </div>
        </div>

        <div class="printAreaCBP mx-auto text-justify" style="width: 65%;">
            <div class="d-flex" style="font-family: 'Times New Roman'">
                <img class="mr-2" src="{{ url('/img/ung.png') }}" alt="" height="120" width="120" />

                <div class="text-center">
                    <div class="h5">
                        <strong>
                            KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN
                            <br />
                            UNIVERSITAS NEGERI GORONTALO
                            <br />
                            FAKULTAS TEKNIK
                        </strong>
                    </div>

                    <div>
                        Jl. B.J Habibie Desa Moutong Kecamatan Tilong Kabila Kab. Bone Bolango
                        <br />
                        Telepon: (0435) 821183 Fax (0435) 821752
                        <br />
                        Laman: http://www.ft.ung.ac.id
                    </div>
                </div>
            </div>
            

            <div style="width: 100%; height: 4px; background-color: #000"></div>

            <div class="mt-4 text-center w-100">
                <p class="h5"><ins>SURAT KETERANGAN BEBAS PERPUSTAKAAN</ins></p>
                <p style="margin-top: -10px">Nomor: B/89/UN47 TA.01.02/PERPUS-FT/LL/2020</p>
            </div>

            <p>Kepala Perpustakaan Fakultas Teknik Universitas Negeri Gorontalo Menerangkan Bahwa:</p>

            <table>
                <thead>
                    <tr>
                        <td style="width: 20%"></td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $member->full_name }}</td>
                    </tr>

                    <tr>
                        <td>NIM</td>
                        <td>: {{ $member->nim }}</td>
                    </tr>

                    <tr>
                        <td>No. KTA</td>
                        <td>: -</td>
                    </tr>

                    <tr>
                        <td>Jurusan</td>
                        <td>: {{ $member->major->name }}</td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $member->address }}</td>
                    </tr>
                </tbody>
            </table>

            <p style="margin-top: 10px">Mahasisiwa yang namanya tersebut diatas dinyatakan telah melunasi kewajibannya berupa:</p>
            
            <div style="margin-top: -10px">
                <span>1. Mengembalikan buku pinjaman</span>
                <br />
                <span>2. Memberikan partisipasi uang tunai sebagai pengganti sumbangan buku senilai Rp. 50.000,- (Lima Puluh Ribu Rupiah).</span>
            </div>

            <p style="margin-top: 10px;">Untuk itu kepada yang bersangkutan dinyatakan telah bebas dari segala kewajiban perpustakaan Fakultas Teknik Universitas Negeri Gorontalo dan berhak mendapatkan surat keterangan ini</p>

            <p style="margin-top: 10px;">Demikian surat keterangan ini dibuat, untuk dapat dipergunakan seperlunya dan atas kerja sama yang baik diucapkan terima kasih.</p>
        
            <div class="d-flex" style="margin-top: 40px;">
                <div class="ml-auto" style="margin-right: 40px">
                    @php 
                        function monthToId($index) {
                            if($index == "01") return "Januari";
                            if($index == "02") return "Februari";
                            if($index == "03") return "Maret";
                            if($index == "04") return "April";
                            if($index == "05") return "Mei";
                            if($index == "06") return "Juni";
                            if($index == "07") return "Juli";
                            if($index == "08") return "Agustus";
                            if($index == "09") return "September";
                            if($index == "10") return "Oktober";
                            if($index == "11") return "November";
                            return "Desember";
                        }
                    @endphp

                    <p>Gorontalo, {{ date("d") . " " . monthToId(date("m")) . " " . date("Y") }}</p>
                    <p style="margin-top: -16px">Kepala Perpustakaan</p>
                    <p style="margin-top: 100px;">Indhitya R. Padiku, S.Kom, M.Kom</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printExecute() {
            print();
        }
    </script>
@endsection