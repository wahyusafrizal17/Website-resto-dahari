@extends('layouts.app-website')
@section('content')

<style>
  .bg-box{
    display: none
  }
  .header_section{
    background: linear-gradient(to bottom, #f1f2f3 0px, #222831 0px)
  }
  .offer_section .box{
    margin-top: 10px !important;
    padding: 10px 10px !important;
  }
  .offer_section .box .img-box{
    width: 100px !important;
    min-width: 100px !important;
    height: 100px !important;
  }
  .offer_section {
    padding-top: 5px !important;
  }
  .offer_section .box .detail-box h6 span{
    font-size: 30px;
  }
  .offer_section .box .detail-box h5{
    font-size: 20px;
  }
  .btn-payment{
    width: 100%;
    color: white;
    background: #ffbe33;
  }
</style>
 
  <!-- food section -->

  <section class="food_section mt-4">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Checkout
        </h2>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="">
                <section class="offer_section layout_padding-bottom">
                    <div class="offer_container">
                      <div class="container ">
                        <h2>
                            List Pesanan
                          </h2>

                          <?php
                          $total = 0;
                          ?>
                        @foreach($cart as $list)
                        <div class="box">
                            <div class="img-box">
                              <img src="{{ asset('menu/'.$list->menu->foto) }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <span>{{ $list->menu->nama }}</span>
                                  </h6>
                              <h5>
                                @currency($list->menu->harga) x{{ $list->jumlah }}
                              </h5>
                              
                            </div>
                          </div>
                          <textarea name="listcatatan[<?= $list->menu->id ?>]" class="form-control listcatatan" rows="2" placeholder="Catatan menu"></textarea>

                          <?php
                          $total += $list->menu->harga * $list->jumlah;
                          ?>
                        @endforeach
                      </div>
                    </div>
                  </section>
            </div>
        </div>
        <div class="col-md-4">
            <div class="container ">
                <h2>
                    Pembayaran
                  </h2>

                  <div class="form-group">
                    <label for="">Pilih No Meja</label>
                    {{ Form::select('meja_id', $meja, null, ['class' => 'form-control meja_id']) }}
                  </div>

                  {{-- <div class="form-group">
                    <label for="">Catatan</label>
                    {{ Form::textarea('catatan', null, ['class' => 'form-control catatan', 'rows' => 5, 'placeholder' => 'Catatan : Misal Pedas/Manis']) }}
                  </div> --}}
                  
                  <input type="hidden" name="catatan" value="-">

                  <div class="form-group">
                    <label for="">Diskon</label>
                    {{ Form::text('diskon', null, ['class' => 'form-control diskon', 'placeholder' => 'Pilih diskon', 'readonly', 'style' => 'cursor: pointer;']) }}
                  </div>

                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">{{ count($cart) }} Items</div>
                            <div class="col-md-6 text-right">@currency($total)</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Diskon</div>
                            <div class="col-md-6 text-right"><span class="value_discount"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Tax (11%)</div>
                            <div class="col-md-6 text-right">@currency($total*0.11)</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6"><b>Total</b></div>
                            <div class="col-md-6 text-right"><b><span class="value_total"></span></b></div>
                            <input type="hidden" class="total" value="{{ $total + ($total*0.11) }}">
                        </div>
                    </div>
                  </div>

                  <div class="mt-3">
                    <button class="btn btn-warning btn-payment">Bayar</button>
                    {{-- <button class="btn btn-warning" id="pay-button">Bayar</button> --}}
                  </div>
            </div>
        </div>
      </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List diskon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body">
        <section class="offer_section">
          <div class="offer_container">
            <div class="container ">
              @foreach($diskons as $diskon)
              <div class="box" onclick="pilihdiskon('{{ $diskon->value }}')" style="cursor: pointer;">
                  <div class="img-box">
                    <img src="https://e7.pngegg.com/pngimages/524/289/png-clipart-red-and-white-special-discount-icon-special-discount-sign-miscellaneous-discount-signs-thumbnail.png" alt="">
                  </div>
                  <div class="detail-box">
                      <h6>
                          <span>{{ $diskon->nama_diskon }}</span>
                        </h6>
                    <h5>
                      @currency($diskon->value)
                    </h5>
                    
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>

  
  <!-- end food section -->

  @endsection

  @push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
$(document).ready(function() {

   $('.btn-payment').click(function(e) {
      swal({
         title: 'Apakah kamu yakin ?',
         text: "Untuk melakukan pembayaran !",
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
          const valcatatan = document.querySelectorAll('[name^="listcatatan"]');
          const listcatatan = Array.from(valcatatan).map(element => element.value);
          $.ajax({
               url: '{{ route('website.pembayaran') }}',
               method: 'post',
               cache: false,
               data: {
                  "_token": "{{ csrf_token() }}",
                  catatan: $('.catatan').val(),
                  meja_id: $('.meja_id').val(),
                  total: $('.total').val(),
                  diskon: $('.diskon').val(),
                  listcatatan: listcatatan
               },
               success: function(data){
              
                  snap.pay(data.data.snap_token, {
                    // Optional
                    onSuccess: function(result){
                      swal("Berhasil", "Silahkan melakukan pembayaran", {
                        icon : "success",
                        buttons: {        			
                            confirm: {
                              className : 'btn btn-success'
                            }
                        },
                      });
                      window.location.href = '/pembayaran/'+data.data.id+'/success';
                      /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onPending: function(result){
                      /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result){
                      /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                  });

               }
            });
         } else {
            swal.close();
         }
      });
   });

   $('.diskon').click(function(e) {
    $('#modal').modal('show');
   });

});

function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

    $('.value_discount').text(formatRupiah('0', 'Rp. '));
    $('.value_total').text(formatRupiah('{{$total + ($total*0.11)}}', 'Rp. '));

function pilihdiskon(value){
  var total = '{{$total + ($total*0.11)}}';
  var subtotal = parseInt(total)-parseInt(value);
  // console.log(subtotal);
  // return false;
  $('#modal').modal('hide');
  $('.diskon').val(formatRupiah(value, 'Rp. '));
  $('.value_discount').text(formatRupiah(value, 'Rp. '));
  $('.value_total').text(formatRupiah(subtotal.toString(), 'Rp. '));
   }

</script>
@endpush
