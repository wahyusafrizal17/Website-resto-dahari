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
          Keranjang
        </h2>
      </div>
      <hr>
      
      <div class="row">
         <div class="col-md-7">
            <h2>
               List Menu
             </h2>

             <div class="filters-content">
               <div class="row grid">
                 @foreach($menus as $menu)
                 <div class="col-sm-6 col-lg-6 all">
                   <div class="box">
                     <div>
                       <div class="img-box">
                         <img src="{{ asset('menu/'.$menu->foto) }}" alt="">
                       </div>
                       <div class="detail-box">
                         <h5>
                           {{ $menu->nama }}
                         </h5>
                         {{-- <p>
                           {{ $menu->deskripsi }}
                         </p> --}}
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
         <div class="col-md-5">
            <h2>
               List Keranjang
             </h2>
            <div class="table-responsive mt-4">
               <table id="basic-datatables" class="display table table-hover">
                  <thead>
                     <tr>
                        {{-- <th style="width: 5%">No</th> --}}
                        <th>Nama Menu</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                   @if(count($model) > 0)
                   @foreach($model as $row)
                     <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $row->menu->nama }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>
                           <a href="{{ route('website.keranjang.delete',[$row->id]) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-sm text-white" data-original-title="Edit">
                               Hapus
                            </a>
                        </td>
                     </tr>
                     @endforeach
                   @else
                   <tr>
                     <td colspan="5" align="center"><small>(Data keranjang kosong)</small></td>
                   </tr>
                   @endif
                      
                  </tbody>
               </table>
            </div>

            @if(count($model) > 0)
            <hr>
            <div class="text-right">
               <button class="btn btn-warning checkout text-white" style="background: #ffbe33 !important">Checkout</button>
            </div>
             @endif
         </div>
      </div>

    </div>
  </section>

  <div class="mt-5"></div>
  <div class="mt-5"></div>
  <!-- end food section -->

  @endsection

  @push('scripts')
<script>
$(document).ready(function() {

   $('.checkout').click(function(e) {
      swal({
         title: 'Apakah kamu yakin ?',
         text: "Untuk melanjutkan pembayaran !",
         type: 'warning',
         icon: 'info',
         buttons:{
            confirm: {
               text : 'Ya, saya yakin!',
               className : 'btn btn-success'
            },
            cancel: {
               visible: true,
               className: 'btn btn-danger'
            }
         }
      }).then((Delete) => {
         if (Delete) {
            window.location.href = '{{ route('website.checkout') }}';
         } else {
            swal.close();
         }
      });
   });

});

</script>
@endpush
