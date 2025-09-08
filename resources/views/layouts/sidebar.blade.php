<nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header d-flex justify-content-center">
                <a href="#" class="b-brand text-primary">
                    <img src="{{ asset('assets/images/gpm.png') }}" alt="Logo" class="logo logo-lg" width="80">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Data Dashboard</label>
                        <i class="ti ti-apps"></i>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="pc-micon"><i class="ti ti-home"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data Master</label>
                        <i class="ti ti-apps"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('paket_internet.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-server"></i></span>
                            <span class="pc-mtext">Data Paket Internet</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('bandwidth.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-lock"></i></span>
                            <span class="pc-mtext">Data Bandwidth</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('promosi.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-archive"></i></span>
                            <span class="pc-mtext">Data Promosi</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data Transaksi</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('transaksi.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-book"></i></span>
                            <span class="pc-mtext">Transaksi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
