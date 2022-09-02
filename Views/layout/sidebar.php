<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">TRANSAKSI</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Penjualan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/jual">Transaksi</a>
                            <a class="nav-link" href="/jual/laporan">Laporan</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Pembelian
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/beli">Transaksi</a>
                            <a class="nav-link" href="/beli/laporan">Laporan</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">MASTER</div>
                    <?php if (has_permission('data-buku')) : ?>
                        <a class="nav-link" href="/book">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Buku
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-customer')) : ?>
                        <a class="nav-link" href="/customer">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Data Customer
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-distributor')) : ?>
                        <a class="nav-link" href="/distributorcrud">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Data Distributor Grocery
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-kategori-buku')) : ?>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-bookmark"></i></div>
                            Data Kategori Buku
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-penulis')) : ?>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Data Penulis Buku
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('tugas-container')) : ?>
                        <a class="nav-link" href="/tugas1">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Tugas Container
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('profil')) : ?>
                        <a class="nav-link" href="/tugas1">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Tugas Container
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('tugas-majalah')) : ?>
                        <a class="nav-link" href="/majalah">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Majalah
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-supplier')) : ?>
                        <a class="nav-link" href="/supplier">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Supplier
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-users')) : ?>
                        <a class="nav-link" href="/users">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data User
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-distributor')) : ?>
                        <a class="nav-link" href="/distributor">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Distributor
                        </a>
                    <?php endif; ?>
                    <?php if (has_permission('data-karyawan')) : ?>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Karyawan
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Dionesius Diegratia Febrian
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">