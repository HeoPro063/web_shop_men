@extends('admin.layouts.admin')

@section('content-admin')
    <promotion-edit-admin :promotion="{{json_encode($promotion)}}"></promotion-edit-admin>
@stop
