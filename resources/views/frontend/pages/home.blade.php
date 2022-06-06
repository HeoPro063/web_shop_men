@extends('frontend.layout.frontend')

@section('more-css')
{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="frontend/css/mockup.css">
@endsection


@section('more-banner')
<div class="container-fluid">
    <div class="row">
        <div class="banner p-0">
            <img src="./frontend/images/banner-thoi-trang-nam.jpg" class="img-banner" alt="">
        </div>
    </div>
    <div class="back-to-top position-relative">
        <button class="back position-fixed" id="back-to-top"><i class="fa fa-angle-up"></i></button>
    </div>
</div>
@endsection

@section('content')
    <home></home>
@endsection

@section('more-js')
<script>

    let backToTop = document.querySelector(".back-to-top");
    backToTop.addEventListener("click", scrollToTop);
    window.onscroll = () => {
        toggleTopButton();
    }
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function toggleTopButton() {
        if (document.body.scrollTop > 900 || document.documentElement.scrollTop > 900) {
            document.querySelector('.back').classList.remove('d-none');
        } else {
            document.querySelector('.back').classList.add('d-none');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
@endsection