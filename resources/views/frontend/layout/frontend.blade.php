
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="{{asset('')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./frontend/models/css/bootstrap.min.css">
    <link rel="stylesheet" href="./frontend/css/style.css">
    @yield('more-css')
</head>

<body>
    <div id="app">
        <div class="wapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="p-0">
                        @include('frontend.include.header')
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @include('frontend.include.banner')
            </div>
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    @include('frontend.include.footer')
                </div>
            </div>
        </div>
    </div>
    <script src="./frontend/models/js/admin.min.js"></script>
    <script src="{{mix('js/app.js')}}"></script>
    @yield('more-js')
</body>

</html>