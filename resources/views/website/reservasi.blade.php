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

  <!-- book section -->
  <section class="book_section layout_padding-bottom mt-4">
    <div class="container">
      <div class="heading_container" style="align-items: center;">
        <h2>
        Reservasi
        </h2>
      </div>
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
              {{ Form::open(['url'=>route('reservasi.store'),'class'=>'form-horizontal','files'=>true])}}
          
              <div class="form-group">
                  <label>Nama</label>
                  {{ Form::text('nama',null,['class'=>'form-control'])}}
                  @if ($errors->has('nama')) <span class="help-block" style="color:red">{{ $errors->first('nama') }}</span> @endif
              </div>

              <div class="form-group">
                  <label>No Hp</label>
                  {{ Form::text('no_hp',null,['class'=>'form-control'])}}
                  @if ($errors->has('no_hp')) <span class="help-block" style="color:red">{{ $errors->first('no_hp') }}</span> @endif
              </div>

                <div class="form-group">
                  <label>Tanggal</label>
                  {{ Form::date('tanggal',null,['class'=>'form-control'])}}
                  @if ($errors->has('tanggal')) <span class="help-block" style="color:red">{{ $errors->first('tanggal') }}</span> @endif
              </div>
              
                <div class="form-group">
                  <label>Jam</label>
                  {{ Form::time('jam',null,['class'=>'form-control'])}}
                  @if ($errors->has('jam')) <span class="help-block" style="color:red">{{ $errors->first('jam') }}</span> @endif
              </div>
              
                <div class="form-group">
                  <label>No Meja</label>
                  {{ Form::select('meja_id', $meja, null, ['class' => 'form-control select2']) }}
                  @if ($errors->has('jam')) <span class="help-block" style="color:red">{{ $errors->first('jam') }}</span> @endif
              </div>
              
                <div class="form-group">
                  <label>Jumlah Orang</label>
                  {{ Form::number('jumlah_orang',null,['class'=>'form-control'])}}
                  @if ($errors->has('jumlah_orang')) <span class="help-block" style="color:red">{{ $errors->first('jumlah_orang') }}</span> @endif
              </div>
              
                <div class="form-group">
                  <label>Catatan</label>
                  {{ Form::textarea('catatan',null,['class'=>'form-control', 'rows' => 3])}}
                  @if ($errors->has('catatan')) <span class="help-block" style="color:red">{{ $errors->first('catatan') }}</span> @endif
              </div>
              <div class="btn_box">
                <button>
                  Book Now
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card text-center">
            <div class="card-body">
              @if(!empty($qrcodeData))
                <h3 class="card-title">Reservasi Berhasil</h3>
                <p class="card-text">Terima kasih, {{ $nama }}!</p>
                <p>Berikut adalah QR Code reservasi Anda:</p>

                <div class="my-4">
                    {!! QrCode::size(200)->generate($qrcodeData) !!}
                </div>

                <p><strong>Nama:</strong> {{ $nama ?? '-' }}</p>
                <p><strong>No HP:</strong> {{ $no_hp ?? '-' }}</p>

                <div class="alert alert-primary">
                  Noted: Silahkan tunjukkan QR Code ini kepada petugas kami saat tiba di restoran.
                </div>
              @else
                <h3 class="card-title text-danger">QR Code Tidak Tersedia</h3>
                <p class="card-text">Silahkan melakukan reservasi untuk mendapatkan qrcode</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->
  @endsection
