@extends('layouts.app-website')
@section('content')
<style>
  .header_section {
    background: rgba(255,255,255,0.85);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    backdrop-filter: blur(1px);
    -webkit-backdrop-filter: blur(4px);
  }
  .custom_nav-container {
    padding: 0.5rem 1rem;
  }
  .navbar-nav .nav-link {
    color: #222831 !important;
    font-weight: 500;
  }
  .navbar-nav .nav-item.active .nav-link,
  .navbar-nav .nav-link.active {
    color: #ffbe33 !important;
  }
</style>
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h2>
                      Restoran Indonesia
                    </h2>
                    <p>
                      Restoran ini memiliki rasa dan kualitas makanan yang tidak tersaingi. Semua makanan disiapkan oleh chef profesional kami dengan cita rasa tinggi. Makanan Indonesia sudah dikenal kelezatannya di mata dunia. Kami menyediakan makanan Indonesia yang menggugah selera dan cocok dengan selera orang-orang Indonesia.
                    </p>
                    <div class="btn-box">
                      <a href="{{ route('website.menu') }}" class="btn1">
                        Pesan Sekarang
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h2>
                      Fast Food Restaurant
                    </h2>
                    <p>
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Order Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h2>
                      Fast Food Restaurant
                    </h2>
                    <p>
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Order Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            {{-- <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li> --}}
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- food section -->

  <section class="food_section layout_padding-bottom mt-2">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Menu Terlaris
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        @foreach(getKategori() as $kategori)
        <li data-filter=".{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</li>
        @endforeach
      </ul>

      <div class="filters-content">
        <div class="row grid">
          @foreach($topMenus as $menu)
          <div class="col-sm-6 col-lg-4 all {{$menu->kategori->nama_kategori}}">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('menu/'.$menu->foto) }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    {{ $menu->nama }}
                  </h5>
                  <p>
                    {{ $menu->deskripsi }}
                  </p>
                  <div class="options">
                    <h6>
                      @currency($menu->harga)
                    </h6>
                    <a href="{{ route('website.keranjang.add',[$menu->id]) }}">
                      <i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>
      </div>
      <div class="btn-box">
        <a href="/all-menu">
          Lihat semua menu
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->

  <!-- about section -->

  {{-- <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="https://themewagon.github.io/feane/images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                We Are Feane
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section> --}}

  <!-- end about section -->
  @endsection
