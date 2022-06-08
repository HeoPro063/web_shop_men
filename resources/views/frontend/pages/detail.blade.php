@extends('frontend.layout.frontend')

@section('more-css')
<link rel="stylesheet" href="./frontend/css/detail.css">
@endsection

@section('content')
<detail :datadetail="{{json_encode($data_detail)}}" :productmore="{{json_encode($product_more)}}"></detail>
@endsection

@section('more-js')
<script>
    const inputWrapperList = document.getElementsByClassName('data-number');

    for (let wrapper of inputWrapperList) {
        const input = wrapper.querySelector('.form-number');
        const incrementation = +input.step || 1;

        wrapper.querySelector('.addfrom').addEventListener('click', function (e) {
            e.preventDefault();
            incInputNumber(input, incrementation);
        });

        wrapper.querySelector('.apartfrom').addEventListener('click', function (e) {
            e.preventDefault();
            incInputNumber(input, "-" + incrementation);
        });
    }

    let itemst = document.querySelectorAll('.carousel .carousel-item')

    itemst.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i = 1; i < minPerSlide; i++) {
            if (!next) {
                next = itemst[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    })

    
</script>
@endsection