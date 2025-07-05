
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('app-assets/images/logo.png') }}" type="">

  <title> DAHARI </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('web/css/bootstrap.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('web/css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('web/css/nice-select.min.css') }}" />
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('web/css/font-awesome.min.css') }}" /> --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('web/css/responsive.css') }}" />

  <!--owl slider stylesheet -->
  <!-- nice select  -->
  <!-- font awesome style -->
  <link href="https://themewagon.github.io/feane/css/font-awesome.min.css" rel="stylesheet" />


</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('app-assets/images/banner.webp') }}" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/">
            {{-- <span>
              Restaurant
            </span> --}}
            <span>
              {{-- Restaurant --}}
            <img src="{{ asset('app-assets/images/logo.png') }}" alt="" width="15%">
          </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item {!!(Request::is('/*')) ? ' active' : '' !!}">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item {!!(Request::is('all-menu*')) ? ' active' : '' !!}">
                <a class="nav-link" href="/all-menu">Menu</a>
              </li>
              <li class="nav-item {!!(Request::is('pesanan*')) ? ' active' : '' !!}">
                <a class="nav-link" href="/pesanan">Pesanan</a>
              </li>
              <li class="nav-item {!!(Request::is('reservasi*')) ? ' active' : '' !!}">
                <a class="nav-link" href="/reservasi">Reservasi</a>
              </li>
            </ul>
            <div class="user_option">
              @if(!empty(\Session::get('auth_nama')))
              <a href="/keranjang" class="user_link">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="btn-cart">{{ getCountCart() }}</span>
              </a>
              <a href="javascript:void(0)" class="user_link">
                {{ \Session::get('auth_nama') }}
              </a>
              <a href="/new-logout" class="order_online">
                Logout
              </a>
              @else
              
              <a href="/auth-login" class="order_online">
                Login
              </a>
              @endif
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

@yield('content') 


  <!-- footer section -->
  <footer class="footer_section mt-3">
    <div class="container">
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('web/js/popper.min.js') }}"></script>
  <script src="{{ asset('web/js/bootstrap.js') }}"></script>
  <script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('web/js/isotope.pkgd.min.js') }}"></script>
  {{-- <script src="{{ asset('web/js/jquery.nice-select.min.js') }}"></script> --}}
  <script src="{{ asset('web/js/custom.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @include('sweetalert::alert')
  @stack('scripts')
</body>

</html>