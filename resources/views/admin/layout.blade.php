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
                            <a href="/admin/book/add">Tambah Buku</a>
                            <br />
                            <a href="/admin/book">Daftar Buku</a>
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
                            <a href="/admin/essay/add">Tambah Skripsi</a>
                            <br />
                            <a href="/admin/essay">Daftar Skripsi</a>
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
                            <a href="/admin/member/add">Tambah Anggota</a>
                            <br />
                            <a href="/admin/member">Daftar Anggota</a>
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
                            <a href="/admin/loans/active">Peminjaman Aktif</a>
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
                            <a href="/admin/profile/change_password">Ganti Password</a>
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
    </body>
</html>