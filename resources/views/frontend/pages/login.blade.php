@extends('frontend.layout.auth')

@section('more-css')
<link rel="stylesheet" href="frontend/login/css/style.css">

@endsection  
@section('title')
    <h2 class="header-top-title">Đăng nhập</h2>
@endsection   
@section('content')
<div class="content-banner">
    <div class="content-form">
        <form action="{{route('post.login')}}" method="post" class="form-horizontal" autocomplete="off">
            @csrf
            <h3 class="form-title">Đăng nhập</h3>
            <div class="form-banner-group">
                <input type="text" name="email" class="form-banner-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                    placeholder="Nhập Email đăng nhập">
                <div id="invalid_email" class="invalid-feedback">
                    {{$errors->first('email')}}
                </div>
            </div>
            <div class="form-banner-group mt-3">
                <input type="password" name="password" class="form-banner-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Mật khẩu">
                <div id="invalid_email" class="invalid-feedback">
                    {{$errors->first('password')}}
                </div>
            </div>
            @if(Session::has('login-error'))
            <div class="text text-danger text-center">
                {{Session::get('login-error')}}
            </div>
            @endif
            <div class="bnt-login">
                <button type="submit" class="btn-banner">Đăng nhập</button>
            </div>
        </form>
        <hr>
        <div class="content-banner-group">
            <div class="forgot_password d-flex justify-content-between ps-3 pe-3">
                <a href="#" class="link-forgot_password text-dark">Quên mật khẩu ?</a>
                <a href="{{route('register')}}" class="link-forgot_password text-dark">Đăng ký</a>
            </div>
        </div>
    </div>
</div>
@endsection   
