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
                margin-left: 60px;
            }

            @media (min-width: 991.98px) {
                .collapse.dont-collapse-xs {
                    display: block;
                    height: auto !important;
                    visibility: visible;
                }
            }

            @media (max-width: 575.98px){
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
            <div class="row">
                <div class="col-12 col-md-3 collapse dont-collapse-xs sidebar" id="collapseSidebar">
                    <div class="container mt-4">
                        <a href="#collapseSidebarBook" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-book" style="font-size: 24px"></i>
                                </div>

                                <div class="col-8 ml-3">
                                    <strong>Buku</strong>
                                </div>

                                <div class="col-2">
                                    <i class="fas fa-sort-down" style="font-size: 24px; margin-top: -4px" id="iconCollapseSidebarBook"></i>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarBook">
                            <li><a href="/admin/book/add">Tambah Buku</a></li>
                            <li><a href="/admin/book">Daftar Buku</a></li>
                        </div>

                        <hr />

                        <a href="#collapseSidebarEssay" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-sticky-note" style="font-size: 24px"></i>
                                </div>

                                <div class="col-8" style="margin-left: 15px">
                                    <strong>Skripsi</strong>
                                </div>

                                <div class="col-2">
                                    <i class="fas fa-sort-down" style="font-size: 24px; margin-top: -4px" id="iconCollapseSidebarEssay"></i>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarEssay">
                            <li><a href="/admin/essay/add">Tambah Skripsi</a></li>
                            <li><a href="/admin/essay">Daftar Skripsi</a></li>
                        </div>

                        <hr />

                        <a href="#collapseSidebarMember" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-users" style="font-size: 24px"></i>
                                </div>

                                <div class="col-8" style="margin-left: 5px">
                                    <strong>Anggota</strong>
                                </div>

                                <div class="col-2">
                                    <i class="fas fa-sort-down" style="font-size: 24px; margin-top: -4px" id="iconCollapseSidebarMember"></i>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarMember">
                            <li><a href="/admin/member/add">Tambah Anggota</a></li>
                            <li><a href="/admin/member">Daftar Anggota</a></li>
                        </div>

                        <hr />

                        <a href="#collapseSidebarLoan" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-handshake" style="font-size: 24px"></i>
                                </div>

                                <div class="col-8" style="margin-left: 5px">
                                    <strong>Peminjaman</strong>
                                </div>

                                <div class="col-2">
                                    <i class="fas fa-sort-down" style="font-size: 24px; margin-top: -4px" id="iconCollapseSidebarLoan"></i>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarLoan">
                            <li><a href="/admin/loans/active">Peminjaman Aktif</a></li>
                        </div>

                        <hr />

                        <a href="#collapseSidebarProfile" data-toggle="collapse">
                            <div class="row ml-2">
                                <div clas="col-2 align-self-right">
                                    <i class="fas fa-id-card" style="font-size: 24px"></i>
                                </div>

                                <div class="col-8" style="margin-left: 7px">
                                    <strong>Profil</strong>
                                </div>

                                <div class="col-2">
                                    <i class="fas fa-sort-down" style="font-size: 24px; margin-top: -4px" id="iconCollapseSidebarProfile"></i>
                                </div>
                            </div>
                        </a>

                        <div class="collapse sidebar-collapse-item-child" id="collapseSidebarProfile">
                            <li><a href="/admin/profile/change_password">Ganti Password</a></li>
                        </div>

                        <hr />
                    </div>
                </div>

                <div class="col-12 col-md-9">
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

        <script>
            $("#collapseSidebarBook").on("shown.bs.collapse", function() {
                $("#iconCollapseSidebarBook").attr("class", "fas fa-sort-up");
                $("#iconCollapseSidebarBook").attr("style", "font-size: 24px; margin-top: 4px");
            });

            $("#collapseSidebarBook").on("hidden.bs.collapse", function() {
                $("#iconCollapseSidebarBook").attr("class", "fas fa-sort-down");
                $("#iconCollapseSidebarBook").attr("style", "font-size: 24px; margin-top: -4px");
            });

            $("#collapseSidebarEssay").on("shown.bs.collapse", function() {
                $("#iconCollapseSidebarEssay").attr("class", "fas fa-sort-up");
                $("#iconCollapseSidebarEssay").attr("style", "font-size: 24px; margin-top: 4px");
            });

            $("#collapseSidebarEssay").on("hidden.bs.collapse", function() {
                $("#iconCollapseSidebarEssay").attr("class", "fas fa-sort-down");
                $("#iconCollapseSidebarEssay").attr("style", "font-size: 24px; margin-top: -4px");
            });

            $("#collapseSidebarMember").on("shown.bs.collapse", function() {
                $("#iconCollapseSidebarMember").attr("class", "fas fa-sort-up");
                $("#iconCollapseSidebarMember").attr("style", "font-size: 24px; margin-top: 4px");
            });

            $("#collapseSidebarMember").on("hidden.bs.collapse", function() {
                $("#iconCollapseSidebarMember").attr("class", "fas fa-sort-down");
                $("#iconCollapseSidebarMember").attr("style", "font-size: 24px; margin-top: -4px");
            });

            $("#collapseSidebarLoan").on("shown.bs.collapse", function() {
                $("#iconCollapseSidebarLoan").attr("class", "fas fa-sort-up");
                $("#iconCollapseSidebarLoan").attr("style", "font-size: 24px; margin-top: 4px");
            });

            $("#collapseSidebarLoan").on("hidden.bs.collapse", function() {
                $("#iconCollapseSidebarLoan").attr("class", "fas fa-sort-down");
                $("#iconCollapseSidebarLoan").attr("style", "font-size: 24px; margin-top: -4px");
            });

            $("#collapseSidebarProfile").on("shown.bs.collapse", function() {
                $("#iconCollapseSidebarProfile").attr("class", "fas fa-sort-up");
                $("#iconCollapseSidebarProfile").attr("style", "font-size: 24px; margin-top: 4px");
            });

            $("#collapseSidebarProfile").on("hidden.bs.collapse", function() {
                $("#iconCollapseSidebarProfile").attr("class", "fas fa-sort-down");
                $("#iconCollapseSidebarProfile").attr("style", "font-size: 24px; margin-top: -4px");
            });
        </script>
    </body>
</html>