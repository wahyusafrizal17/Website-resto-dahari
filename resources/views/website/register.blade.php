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
        <h2> Daftar </h2>
      </div>
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="form_container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
              <div>
                <input id="name" type="text" placeholder="Nama" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                <input id="username" type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
              <div class="btn_box">
                <button type="submit"> Daftar </button> | Sudah punya akun? <a href="/auth-login">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section --> 
  @endsection