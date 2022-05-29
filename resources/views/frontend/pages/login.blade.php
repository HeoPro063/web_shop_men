<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="frontend/css/user.css">
</head>
<body>
    <div class="wapper-content">
        <div class="header-content-top d-flex justify-content-between">
            <div class="header-top-photo d-flex align-items-center">
                <a href="{{route('home')}}" class="link-home">
                    <img src="./frontend/images/logo.png" class="img-top" alt="logo">
                </a>
                <h2 class="header-top-title">Đăng nhập</h2>
            </div>
            <div class="header-top-hepl d-flex align-items-center">
                <a href="#" class="link-help text-center text-decoration-none text-dark">Bạn cần giúp đỡ gì ?</a>
            </div>
        </div>
        <div class="content-banner">
            <div class="content-form">
                <form action="{{route('user.post.login')}}" method="post" class="form-horizontal" autocomplete="off">
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
                        <a href="#" class="link-forgot_password text-dark">Đăng ký</a>
                    </div>
                    <div class="social-network d-flex justify-content-center align-items-cente">
                        <button class="btn-FB"><i class="fab fa-facebook"></i> Facebook</button>
                        <button class="btn-google d-flex ms-2"><span class="google"></span> Google</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>