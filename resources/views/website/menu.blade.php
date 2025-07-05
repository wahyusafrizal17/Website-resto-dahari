@extends('layouts.app-website')
@section('content')
<style>
  .bg-box{
    display: none
  }
  .header_section{
    background: linear-gradient(to bottom, #f1f2f3 0px, #222831 0px)
  }
</style>


  <!-- food section -->

  <section class="food_section layout_padding-bottom mt-4">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
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
          @foreach($menus as $menu)
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
    </div>
  </section>

  <!-- end food section -->

  @endsection
