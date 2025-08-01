<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
                <i class="bi bi-grid-fill"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
                <i class="bi bi-cart4"></i>
                <span>Keranjang</span>
            </a>
        </li><!-- End Keranjang Nav -->
        <?php
        if (session()->get('role') == 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
                    <i class="bi bi-receipt"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php
        }
        ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'profile') ? '' : 'collapsed' ?>" href="/profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Nav -->
        
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string()) == 'penjualan' ? '' : 'collapsed' ?>" href="penjualan">
                <i class="bi bi-card-list"></i>
                <span>Penjualan</span>
            </a>
        </li><!-- End Penjualan Nav -->

        <?php if (session()->get('role') == 'admin') : ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'laporan/pendapatan') ? '' : 'collapsed' ?>" href="laporan/pendapatan">
                <i class="bi bi-bar-chart"></i>
                <span>Laporan Pendapatan</span>
            </a>
        </li><!-- End Laporan Pendapatan Nav -->
        <?php endif; ?>
    </ul>

</aside><!-- End Sidebar-->