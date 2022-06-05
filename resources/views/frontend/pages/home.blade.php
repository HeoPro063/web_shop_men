@extends('frontend.layout.frontend')

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
@endsection