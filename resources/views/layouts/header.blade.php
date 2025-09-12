 <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item header-mobile-collapse">
                        <a href="#" class="pc-head-link head-link-primary ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link head-link-primary ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
           <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=1C76DA&color=fff" alt="user-image" class="user-avtar">
                            <span>
                                <i class="ti ti-settings"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <h4> <span class="small text-muted"> {{ Auth::user()->name }}</span></h4>
                                <hr>
                                <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
                                    <form action="{{ route('logout') }}" method="get">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Apakah anda yakin ingin mengakhiri sesi ini?')">
                                            <i class="ti ti-logout"></i>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
