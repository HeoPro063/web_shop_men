@extends('admin.layouts.admin')

@section('content-admin')
  <product-create-admin 
  :categories="{{json_encode($categories)}}"
  :sizes="{{json_encode($sizes)}}" 
  :colors="{{json_encode($colors)}}"
  :promotions="{{json_encode($promotions)}}"
  ></product-create-admin>
@stop
