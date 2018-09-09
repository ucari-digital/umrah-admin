 HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="images/icon/logo.png" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
                </button>
            </div>
        </div>
    </div>
{{--     <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-tachometer-alt"></i>Tanggal Berangkat</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="index.html">Input</a>
                        </li>
                        <li>
                            <a href="index2.html">Data</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="chart.html">
                    <i class="fas fa-chart-bar"></i>Charts</a>
                </li>
                <li>
                    <a href="table.html">
                    <i class="fas fa-table"></i>Tables</a>
                </li>
                <li>
                    <a href="form.html">
                    <i class="far fa-check-square"></i>Forms</a>
                </li>
                <li>
                    <a href="#">
                    <i class="fas fa-calendar-alt"></i>Calendar</a>
                </li>
                <li>
                    <a href="map.html">
                    <i class="fas fa-map-marker-alt"></i>Maps</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-copy"></i>Pages</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="register.html">Register</a>
                        </li>
                        <li>
                            <a href="forget-pass.html">Forget Password</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-desktop"></i>UI Elements</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="button.html">Button</a>
                        </li>
                        <li>
                            <a href="badge.html">Badges</a>
                        </li>
                        <li>
                            <a href="tab.html">Tabs</a>
                        </li>
                        <li>
                            <a href="card.html">Cards</a>
                        </li>
                        <li>
                            <a href="alert.html">Alerts</a>
                        </li>
                        <li>
                            <a href="progress-bar.html">Progress Bars</a>
                        </li>
                        <li>
                            <a href="modal.html">Modals</a>
                        </li>
                        <li>
                            <a href="switch.html">Switchs</a>
                        </li>
                        <li>
                            <a href="grid.html">Grids</a>
                        </li>
                        <li>
                            <a href="fontawesome.html">Fontawesome Icon</a>
                        </li>
                        <li>
                            <a href="typo.html">Typography</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav> --}}
</header>
<!-- END HEADER MOBILE-->
<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <h5>{{App\Helper\AuthManager::users()->nama}}</h5>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @if(Auth::user()->level == 'superadmin')
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-users"></i>Users</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('users')}}">Input</a>
                        </li>
                        <li>
                            <a href="{{url('users-data')}}">Data</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-university"></i>Bank</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('bank')}}">Input</a>
                        </li>
                        <li>
                            <a href="{{url('bank-data')}}">Data</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-suitcase"></i>Travel</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('travel')}}">Input</a>
                        </li>
                        <li>
                            <a href="{{url('travel-data')}}">Data</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fa fa-building"></i>Perusahaan</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('perusahaan')}}">Input</a>
                        </li>
                        <li>
                            <a href="{{url('perusahaan-data')}}">Data</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fa fa-calendar"></i>Tanggal Berangkat</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('tanggal-berangkat')}}">Input</a>
                        </li>
                        <li>
                            <a href="{{url('tanggal-berangkat-data')}}">Data</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fa fa-location-arrow"></i>Embarkasi</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('embarkasi')}}">Input</a>
                        </li>
                        <li>
                            <a href="{{url('embarkasi-data')}}">Data</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fa fa-user"></i>Peserta</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('peserta')}}">Verifikasi</a>
                        </li>
                        <li>
                            <a href="{{url('informasi-peserta')}}">Informasi Peserta</a>
                        </li>
                        <li>
                            <a href="{{url('hotel-peserta')}}">Hotel Peserta</a>
                        </li>
                        {{-- <li>
                            <a href="{{url('pendataan-kepulangan-peserta')}}">Pendataan Kepulangan Peserta</a>
                        </li> --}}
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="{{url('dokumen')}}">
                    <i class="fa fa-file-text"></i>Dokumen</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="{{url('pembayaran')}}">
                    <i class="fas fa-credit-card"></i>Pembayaran</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fas fa-plus-square"></i>Reserved</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('book/seat')}}">Seat</a>
                        </li>
                        <li>
                            <a href="{{url('book/hotel')}}">Hotel</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                    <i class="fa fa-list-alt"></i>Laporan</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('perusahaan-pendaftar')}}">Perusahaan Pendaftar</a>
                        </li>
                        <li>
                            <a href="{{url('keberangkatan-peserta')}}">Keberangkatan Peserta</a>
                        </li>
                        <li>
                            <a href="{{url('kelengkapan-dokumen')}}">Kelengkapan Dokumen</a>
                        </li>
                        <li>
                            <a href="{{url('manifest-pesawat')}}">Manifest Pesawat</a>
                        </li>
                        <li>
                            <a href="{{url('laporan-pembayaran')}}">Pembayaran</a>
                        </li>
                        <li>
                            <a href="{{url('data-jamaah')}}">Data Jamaah</a>
                        </li>
                        <li>
                            <a href="{{url('data-jamaah-hotel')}}">Data Jamaah Hotel</a>
                        </li>
                        <li>
                            <a href="{{url('kepulangan-peserta')}}">Data Kepulangan Jamaah</a>
                        </li>
                        <li>
                            <hr class="my-1">
                        </li>
                        <li>
                            <a href="{{url('data-bank')}}">Data Bank</a>
                        </li>
                        <li>
                            <a href="{{url('data-travel')}}">Data Travel</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR