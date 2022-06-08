@extends('frontend.layout.frontend')

@section('more-css')
<link rel="stylesheet" href="./frontend/css/product.css">
<link rel="stylesheet" href="./frontend/css/detail.css">
<link rel="stylesheet" href="./frontend/css/cart.css">
@endsection

@section('content')
    <checkout :address="{{json_encode($address)}}" :datacart="{{json_encode($dataCart)}}" :datavt="{{json_encode($dataVt)}}"></checkout>
@endsection

@section('more-js')

@endsection