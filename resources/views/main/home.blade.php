@extends("main.layout")
@section("title", "Beranda")
@section("content")
    <style>
        .subtitle {
            color: #9e6700;
        }
    </style>

    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h3>Selamat Datang</h3>
                    <p>Lorem ipsum dolor sit amet, lit.turus.</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3>Visi Misi</h3>
                
                    <strong class="subtitle">Visi Strategis</strong>
                    <p>Perpustakaan yang inovatif dan unggul dalam informasi dan edukasi.</p>
                    
                    <strong class="subtitle">Visi 2035</strong>
                    <p>Perpustakaan terdepan dalam informasi dan edukasi berbasis kebudayaan di kawasan Asia Tenggara.</p>
                    
                    <strong class="subtitle">Misi</strong>
                    <p>Misi pusat perpustakaan UNG mengacu pada empat pilar UNG yaitu: 
                        <i>Quality Assurance</i>, 
                        <i>Soft Skill</i>, 
                        <i>Enterpreneurship Parnership</i>, 
                        <i>Innovation</i> dan 
                        <i>Environment for the Green Campus.</i></p>
                    
                        <ol>
                            <li>Menyelenggarakan pelayanan yang berkualitas sebagai sarana informasi dan edukasi bagi civitas akademika UNG dalam melakukan Tri Dharma perguruan tinggi dan bagi masyarakat.</li>

                            <li>Menyiapkan SDM yang berbudaya, beretos kerja, dan memiliki <i>soft skill</i>.</li>

                            <li>Mengembangkan <i>partnership</i> dengan pihak internal dan eksternal universitas.</li>

                            <li>Menciptakan suasana lingkungan perpustakaan yang representatif.</li>
                        </ol>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h3>Statistik</h3>
                    <strong class="subtitle">5 Buku/Skripsi paling sering dipinjam</strong>
                    <div style="margin-top: 10px;">
                        <span>Buku 1</span>
                        <hr />
                        <span>Buku 2</span>
                        <hr />
                        <span>Buku 3</span>
                        <hr />
                        <span>Buku 4</span>
                        <hr />
                        <span>Buku 5</span>
                        <hr />
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3>Daftar Website</h3>
                    <a href="https://ung.ac.id">Universitas Negeri Gorontalo</a>
                    <br />
                    <a href="http://ft.ung.ac.id">Fakultas Teknik</a>
                    <br />
                    <a href="http://mahasiswa.ac.id">Blog Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>
@endsection
