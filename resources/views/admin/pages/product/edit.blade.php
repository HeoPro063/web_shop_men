@extends('admin.layouts.admin')

@section('content-admin')
    <product-edit-admin 
    :product="{{json_encode($product)}}" 
    :images="{{json_encode($images)}}"
    :categories="{{json_encode($categories)}}"
    :sizes="{{json_encode($sizes)}}"
    :colors="{{json_encode($colors)}}"
    :promotions="{{json_encode($promotions)}}"
    ></product-edit-admin>
@stop
