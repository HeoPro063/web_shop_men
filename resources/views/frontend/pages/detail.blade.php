@extends('frontend.layout.frontend')

@section('more-css')
<link rel="stylesheet" href="./frontend/css/detail.css">
@endsection

@section('content')
<detail :datadetail="{{json_encode($data_detail)}}"></detail>
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
</script>
@endsection