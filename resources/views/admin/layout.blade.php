<html>
    <head>
        <title>@yield("title") | {{ env("APP_TITLE") }}</title>
        
        @include("includes")
        
        <style>
            .header-section {
                padding: 16px
            }

            .header-toggler{
                visibility: hidden;
                margin-right: -40px;
            }

            .main-section {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .footer-section {
                padding-top: 15px;
                padding-bottom: 35px;
                flex-shrink: 0;
            }

            .sidebar {
                background-color: #2e2e2e;
                margin-bottom: -5000px;
                padding-bottom: 5000px;
                overflow-x: hidden;
                color: white;
            }

            .sidebar a{
                color: white;
            }

            .sidebar a:hover{
                text-decoration: none;
            }

            .sidebar hr{
                background-color: #575757;
            }

            .sidebar-collapse-item-child {
                padding-top: 10px;
                margin-left: 40px;
            }

            .sidebar-title {
                font-size: 14px;
            }

            @media (min-width: 1200px) {
                .collapse.dont-collapse-xs {
                    display: block;
                    height: auto !important;
                    visibility: visible;
                }
            }

            @media (max-width: 1200px) {
                .header-toggler{
                    visibility: visible;
                    margin-right: 0;
                }

                .sidebar{
                    margin-bottom: 0;
                    padding-bottom: 20px;
                }
            }
        </style>
    </head>

    <body>
        <header class="header-section bg-primary text-white">
            <a href="#collapseSidebar" class="pr-3 header-toggler" data-toggle="collapse"><i class="fas fa-bars fa-1x text-white"></i></a>
            <a class="text-light" href="/admin"><span><strong>DASHBOARD ADMIN</strong></span></a>
            <a class="text-light" style="position:absolute; right: 16px" href="/admin/logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
        </header>

        <main class="main-section">
            <div class="row no-gutters">
                <div class="col-12 col-md-12 col-xl-2 collapse dont-collapse-xs sidebar" id="collapseSidebar">
                    <div class="container mt-4">
                        <a href="#collapseSidebarBook" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-book" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Buku</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarBook">
                            <a href="/admin/book/add">Tambah</a>
                            <br />
                            <a href="/admin/book">Daftar</a>
                            <br />
                        </div>

                        <hr />

                        <a href="#collapseSidebarEssay" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-sticky-note" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Skripsi</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarEssay">
                            <a href="/admin/essay/add">Tambah</a>
                            <br />
                            <a href="/admin/essay">Daftar</a>
                            <br />
                        </div>

                        <hr />

                        <a href="#collapseSidebarMajor" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-user-graduate" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Jurusan</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarMajor">
                            <a href="/admin/major/add">Tambah</a>
                            <br />
                            <a href="/admin/major">Daftar</a>
                            <br />
                        </div>

                        <hr />

                        <a href="#collapseSidebarProgramStudy" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-graduation-cap" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Prodi</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarProgramStudy">
                            <a href="/admin/study_program/add">Tambah</a>
                            <br />
                            <a href="/admin/study_program">Daftar</a>
                            <br />
                        </div>

                        <hr />

                        <a href="#collapseSidebarMember" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-users" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Anggota</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarMember">
                            <a href="/admin/member/add">Tambah</a>
                            <br />
                            <a href="/admin/member">Daftar</a>
                            <br />
                        </div>

                        <hr />

                        <a href="#collapseSidebarLoan" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-handshake" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Peminjaman</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarLoan">
                            <a href="/admin/loan/add">Tambah</a>
                            <br />
                            <a href="/admin/loan">Daftar</a>
                            <br />
                        </div>

                        <hr />

                        <a href="#collapseSidebarProfile" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-id-card" style="font-size: 18px"></i>
                                </div>

                                <div class="col-10">
                                    <strong class="sidebar-title">Profil</strong>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarProfile">
                            <a href="#modalChangePassword" data-toggle="modal">Ganti Password</a>
                            <br />
                        </div>

                        <hr />
                    </div>
                </div>

                <div class="col-12 col-md-12 col-xl-10">
                    <div class="container pb-4">
                        @yield("content")
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer-section bg-white">
            <div style="position:absolute; right: 16px">
                &copy; {{ now()->year }} - {{ env("APP_TITLE") }}
            </div>
        </footer>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalChangePassword">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" action="/admin/change_password?id={{ session('id') }}">
                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password" placeholder="Masukan password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Password Baru (Konfirmasi)</label>
                                <input type="password" name="password_confirmation" placeholder="Masukan password lagi" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>