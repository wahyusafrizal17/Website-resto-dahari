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
      <div class="heading_container heading_center alert {{ $transaksi->status_pembayaran == 'pending' ? 'alert-danger' : 'alert-info' }}">
        <h2>
          Pembayaran {{$transaksi->status_pembayaran == 'pending' ? 'Gagal' : 'Berhasil'}}
        </h2>
      </div>
    </div>
  </section>

  <div class="container" style="min-height: 610px;">
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
                          $mn = unserialize($transaksi->menu);

                          ?>
                        @foreach($mn as $m => $list)
                
                        <div class="box ">
                            <div class="img-box">
                              <img src="{{ asset('menu/'. getCart($m)->menu->foto) }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <span>{{ getCart($m)->menu->nama }}</span>
                                  </h6>
                              <h5>
                                @currency(getCart($m)->menu->harga) x {{getCart($m)->jumlah}}
                              </h5>
                              
                            </div>
                          </div>
                          <textarea class="form-control" rows="2" placeholder="Catatan menu" readonly>{{ $list }}</textarea>

                          <?php
                          $total += getCart($m)->menu->harga * getCart($m)->jumlah;
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
                    Detail Pesanan
                  </h2>

                  <div class="form-group">
                    <label for="">No Meja</label>
                    <p>{{ $transaksi->meja->no }}</p>
                  </div>

                  {{-- <div class="form-group">
                    <label for="">Catatan</label>
                    <p>{{ $transaksi->catatan }}</p>
                  </div> --}}

                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">{{ count($mn) }} Items</div>
                            <div class="col-md-6 text-right">@currency($total)</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Diskon</div>
                            <div class="col-md-6 text-right">@currency($transaksi->diskon)</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Tax (11%)</div>
                            <div class="col-md-6 text-right">@currency($total*0.11)</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6"><b>Total</b></div>
                            <div class="col-md-6 text-right"><b>@currency(($total + ($total*0.11))-$transaksi->diskon)</b></div>
                        </div>
                    </div>
                  </div>
                  @if($transaksi->status_pembayaran == 'success')
                  <div class="mt-3">
                    <button class="btn btn-warning btn-payment" data-toggle="modal" data-target="#exampleModal">Cetak Struk</button>
                  </div>
                  @endif
            </div>
        </div>
      </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cetak Struk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body">
        <div class="print-page">
          <center>
            <img src="{{ asset('app-assets/images/logo.png') }}" alt="" width="30%">
          </center>
          <hr style="border-style: dashed;margin-top: -15px;">

          <h3>Pesanan</h3>
          <hr style="border-style: dashed;margin-top: 0px;">
          <?php
            $cmn = unserialize($transaksi->menu);
            ?>
          @foreach($cmn as $cm => $clist)
          <div class="row">
            <div class="col-md-7 col-7">{{ getCart($cm)->jumlah }} x {{ getCart($cm)->menu->nama }}</div>
            <div class="col-md-5 col-5 text-right">@currency(getCart($cm)->menu->harga)</div>
          </div>
          @endforeach
          <hr style="border-style: dashed;">
          <div class="row">
            <div class="col-md-7 col-7">{{ count($mn) }} Items</div>
            <div class="col-md-5 col-5 text-right">@currency($total)</div>
          </div>
          <div class="row">
            <div class="col-md-7 col-7">Diskon :</div>
            <div class="col-md-5 col-5 text-right">@currency($transaksi->diskon)</div>
          </div>
          <div class="row">
            <div class="col-md-7 col-7">Tax(11%) :</div>
            <div class="col-md-5 col-5 text-right">@currency($total*0.11)</div>
          </div>
          <hr style="border-style: dashed;">
          <div class="row">
            <div class="col-md-7 col-7">Total :</div>
            <div class="col-md-5 col-5 text-right"><b>@currency(($total + ($total*0.11))-$transaksi->diskon)</b></div>
          </div>
          <hr style="border-style: dashed;">
          <center>
            <b>Terima Kasih</b>
          </center>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="print" class="btn btn-primary">Cetak</button>
      </div>
    </div>
  </div>
</div>

  
  <!-- end food section -->

  @endsection

  @push('scripts')
<script>
        $("#print").click(function () {
            console.log("hallo");
            var contents = $(".print-page").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({ "position": "absolute", "top": "-1000000px" });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write('<link href="/web/css/bootstrap.css" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.write('<style type="text/css" > #print{display:none} .filter-modal{display:none} .btn-excel{display:none} </style>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
   
        $(".wrapper").addClass("sidebar_minimize");
    </script>
@endpush