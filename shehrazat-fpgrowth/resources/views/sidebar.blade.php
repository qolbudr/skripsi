<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme align-items-center">
    <div class="app-brand demo text-center" style="width: unset!important">
        <a href="index.html" class="app-brand-link align-items-center">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo-white.png') }}" style="width: 80px" alt="logo">
                <span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ strpos(Request::url(), 'dashboard') ? 'active' : '' }}">
            <a href="{{ URL::to('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Master</span>
        </li>

        <li class="menu-item {{ strpos(Request::url(), 'products') ? 'active' : '' }}">
            <a href="{{ URL::to('products') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Kelola Barang">Kelola Barang</div>
            </a>
        </li>

        <li class="menu-item {{ strpos(Request::url(), 'transaction') ? 'active' : '' }}">
            <a href="{{ URL::to('transaction') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-transfer"></i>
                <div data-i18n="Kelola Transaksi">Kelola Transaksi</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Analisa</span>
        </li>

        <li class="menu-item {{ strpos(Request::url(), 'analyze') ? 'active' : '' }}">
            <a href="{{ URL::to('analyze') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chart"></i>
                <div data-i18n="Analisa Pembelian">Analisa Pembelian</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Lainnya</span>
        </li>

        <li class="menu-item">
            <a href="{{ URL::to('logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Analytics">Keluar</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->