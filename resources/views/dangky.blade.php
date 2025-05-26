

@extends('layouts.app')
@push('styles')
<style>
  .error-message{
    color:red;
  }
  footer{
    position: absolute;
    bottom: 0px;
    width:100%;
  }
</style>
@endpush
@section('content')
<form class="col-12" method="POST" action="{{route('user.dk')}}">
  @csrf
  {{$errors}}
    <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Đăng ký</h1>
    <div class="form-floating">
      <input type="email" class="form-control my-2" name="Email" id="floatingInput" placeholder="Nhập email...">
      <label for="floatingInput">Email:</label>
    </div>
    @error('Email')
      <p class="error-message">{{$message}}</p>
    @enderror
    <div class="form-floating">
      <input type="text" class="form-control my-2" name="TenTK" id="floatingInput" placeholder="Nhập tên tài khoản...">
      <label for="floatingInput">Tên Tài Khoản:</label>
    </div>
    @error('TenTK')
      <p class="error-message">{{$message}}</p>
    @enderror
    <div class="form-floating">
      <input type="password" class="form-control my-2" name="MatKhau" id="floatingPassword" placeholder="Nhập mật khẩu...">
      <label for="floatingPassword">Mật khẩu</label>
    </div>
    @error('MatKhau')
      <p class="error-message">{{$message}}</p>
    @enderror
    <div class="form-floating">
      <input type="password" class="form-control my-2" name="MatKhau_confirmation" id="floatingPassword" placeholder="Nhập lại mật khẩu...">
      <label for="floatingPassword">Xác nhận Mật khẩu</label>
    </div>
    @error('MatKhau_confirmation')
      <p class="error-message">{{$message}}</p>
    @enderror
    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Nhớ tài khoản
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Đăng ký</button>
    <p class="mt-5 mb-3 text-body-secondary">© 2024-2025</p>
  </form>
@endsection