<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>Admin - Restoran Dahari</title>
        <link rel="shortcut icon" href="{{ asset('app-assets/images/logo.png') }}" type="">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    </head>
    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
            <div class="navbar-container d-flex content">
                <ul class="nav navbar-nav align-items-center ms-auto">
                    <li class="nav-item dropdown dropdown-notification">
                        <a class="nav-link" href="#" id="dropdown-notification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell"></i>
                            <span class="badge rounded-pill bg-danger badge-up">
                              {{ \App\Models\Transaksi::where('konfirmasi', false)->count() }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <div class="dropdown-menu-header">
                                <h6 class="dropdown-header mb-0">Notifikasi</h6>
                                {{-- <span class="notification-count badge rounded-pill bg-primary float-end">3 Baru</span> --}}
                            </div>
                            <div class="scrollable-container media-list">
                                @foreach(\App\Models\Transaksi::where('konfirmasi', false)->orderBy('created_at', 'desc')->limit(5)->get() as $trx)
                                  <a class="d-flex" href="{{ route('admin.transaksi.index') }}">
                                      <div class="list-item d-flex align-items-start">
                                          <div class="me-1">
                                              <i data-feather="info" class="font-medium-5 text-primary"></i>
                                          </div>
                                          <div class="list-item-body flex-grow-1">
                                              <p class="media-heading mb-0"><span class="fw-bolder">Invoice: {{ $trx->invoice }}</span></p>
                                              <small class="notification-text">Nama: {{ $trx->nama }}</small><br>
                                              <small class="notification-text">
                                                Menu: 
                                                @php
                                                  $mn = @unserialize($trx->menu);
                                                @endphp
                                                @if(is_array($mn))
                                                  @foreach($mn as $m => $catatan)
                                                    {{ optional(getCart($m)->menu)->nama ?? '-' }}@if(!$loop->last), @endif
                                                  @endforeach
                                                @endif
                                              </small><br>
                                              <small class="notification-text">Total: @currency($trx->total)</small>
                                          </div>
                                      </div>
                                  </a>
                                @endforeach
                            </div>
                            <div class="dropdown-menu-footer">
                                <a class="btn btn-primary w-100" href="{{ route('admin.transaksi.index') }}">Lihat Semua Notifikasi</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                                <span class="user-status">{{ Auth::user()->level }}</span>
                            </div>
                            <span class="avatar">
                                <img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
                                <span class="avatar-status-online"></span>
                            </span>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="auth-login-cover.html">
                                <i class="me-50" data-feather="power"></i> Logout </a>
                        </div> --}}
                    </li>
                </ul>
            </div>
        </nav>
        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto">
                        <a class="navbar-brand" href="/">
                            {{-- <span class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                                <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span> --}}
                            <h2 class="brand-text">RESTAURANT</h2>
                        </a>
                    </li>
                    <li class="nav-item nav-toggle">
                        <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                            <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                            <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item {!!(Request::is('/')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="/">
                            <i data-feather="square"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->level == 'Admin')

                    <li class="nav-item {!!(Request::is('admin/kategori*')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.kategori.index') }}">
                            <i data-feather="file"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Manage Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item {!!(Request::is('admin/menu*')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.menu.index') }}">
                            <i data-feather="file"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Manage Menu</span>
                        </a>
                    </li>
                    <li class="nav-item {!!(Request::is('admin/meja*')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.meja.index') }}">
                            <i data-feather="file"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Manage Meja</span>
                        </a>
                    </li>
                    <li class="nav-item {!!(Request::is('admin/diskon*')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.diskon.index') }}">
                            <i data-feather="grid"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Manage Diskon</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item {!!(Request::is('admin/reservasi*')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.reservasi') }}">
                            <i data-feather="users"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Manage Reservasi</span>
                        </a>
                    </li>
                    <li class="nav-item {!!(Request::is('admin/transaksi*')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.transaksi.index') }}">
                            <i data-feather="users"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Manage Pemesanan</span>
                        </a>
                    </li>
                    @if(Auth::user()->level == 'Admin')
                    <li class="nav-item {!!(Request::is('admin/user/*') || Request::is('admin/user')) ? ' active' : '' !!}">
                        <a class="d-flex align-items-center" href="{{ route('admin.user.index') }}">
                            <i data-feather="users"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Users</span>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="log-out"></i>
                            <span class="menu-title text-truncate" data-i18n="Modal Examples">Logout</span>
                        </a>
                    </li>
                    {{-- <li class=" nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="user"></i>
                            <span class="menu-title text-truncate" data-i18n="User">Master Data</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a class="d-flex align-items-center" href="app-user-list.html">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">List</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div> @yield('content') <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        <footer class="footer footer-static footer-light">
            <p class="clearfix mb-0">
                <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{date('Y')}} Dahari Cafe Resto</</span>
            </p>
        </footer>
        <button class="btn btn-primary btn-icon scroll-top" type="button">
            <i data-feather="arrow-up"></i>
        </button>
        <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
        <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
        <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('sweetalert::alert')
        @stack('scripts')

        <script>
            $('.select2').select2({
                // theme: "bootstrap"
            });

            $(document).ready(function () {
                $('#basic-datatables').DataTable();
            });
        </script>
        <script>
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            })
        </script>
    </body>
    <!-- END: Body-->
</html>