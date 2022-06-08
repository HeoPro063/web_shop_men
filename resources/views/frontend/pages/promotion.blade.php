@extends('frontend.layout.frontend')

@section('more-css')
<link rel="stylesheet" href="./frontend/css/promotions.css">
@endsection


@section('content')
<promotion :datas="{{json_encode($datas)}}"></promotion>
@endsection

@section('more-js')

@endsection