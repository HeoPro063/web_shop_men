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
    

    @yield('more-css')
    <script>
        const BASE_URL = "{{ url('') }}";
	</script>
</head>
<body>
    <div id="app">
        <div class="wapper-content">
            <div class="header-content-top d-flex justify-content-between">
                <div class="header-top-photo d-flex align-items-center">
                    <a href="{{route('home')}}" class="link-home">
                        <img src="frontend/images/logo.png" class="img-top" alt="logo">
                    </a>
                    @yield('title')
                </div>
                <div class="header-top-hepl d-flex align-items-center">
                    <a href="#" class="link-help text-center text-decoration-none text-dark">Bạn cần giúp đỡ gì ?</a>
                </div>
            </div>
            {{-- <div class="content-banner"> --}}
                    @yield('content')
            {{-- </div> --}}
        </div>
    </div>
  
    <script src="{{mix('js/app.js')}}"></script>
</body>

</html>