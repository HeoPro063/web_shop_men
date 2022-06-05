@extends('frontend.layout.auth')

@section('more-css')
    <link rel="stylesheet" href="frontend/register/css/register.css">
    <link rel="stylesheet" href="frontend/register/css/style.css">
@endsection  

@section('title')
    <div class="header-confirm-left-title">Xác nhận email</div>
@endsection 

@section('content')
   <confirm :email="{{json_encode($email)}}"></confirm>
@endsection   
 