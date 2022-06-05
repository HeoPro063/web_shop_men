@extends('frontend.layout.frontend')

@section('more-css')
<link rel="stylesheet" href="./frontend/css/product.css">
@endsection

@section('content')
<category :datadefault="{{json_encode($data_default)}}" :datacategory="{{json_encode($data_category)}}"></category>
@endsection