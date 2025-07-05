@extends('layouts.app-website') 
@section('content') 
<style>
    .bg-box {
      display: none
    }
  
    .header_section {
      background: linear-gradient(to bottom, #f1f2f3 0px, #222831 0px)
    }
</style>

  <!-- book section -->
  <section class="book_section layout_padding-bottom mt-4">
    <div class="container">
      <div class="heading_container" style="align-items: center;">
        <h2> Login </h2>
      </div>
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="form_container">
            <form method="POST" action="{{ route('new-login') }}">
                @csrf
              <div>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
              </div>
              <div>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="No Hp" name="phone" required>
              </div>
              <div class="btn_box">
                <button type="submit"> Login </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section --> 
  @endsection