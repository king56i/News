
@extends('layouts.app')
@section('content')
@push('styles')
<style>
  footer{
    position: absolute;
    bottom: 0px;
    width:100%;
    margin-top: 10px;
  }
</style>
@endpush
<form class="col-12" method="POST" action="{{route('user.dn')}}">
    @csrf
    @if(session()->has('success'))
      <div class="alert alert-success">Đăng ký thành công! Bạn có thể đăng nhập ngay!!</div>
    @endif
    <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Đăng nhập</h1>

    <div class="form-floating">
      <input type="text" class="form-control my-2" name="TenTK" id="floatingInput" placeholder="Nhập tên tài khoản...">
      <label for="floatingInput">Tài khoản:</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control my-2" name="MatKhau" id="floatingPassword" placeholder="Nhập mật khẩu...">
      <label for="floatingPassword">Mật khẩu:</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Nhớ tài khoản
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Đăng nhập</button>
    <p class="mt-5 mb-3 text-body-secondary">© 2024-2025</p>
  </form>
@endsection