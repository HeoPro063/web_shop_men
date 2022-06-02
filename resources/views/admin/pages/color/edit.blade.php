@extends('admin.layouts.admin')

@section('content-admin')
<div class="container-fluid" style="height:627px; overflow-x: hidden; display: block;">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit color</h5>
                </div>
             </div>
             @if($message = Session::get('success'))
             <div  class="text-success" style="margin-left: 20px;">
                 {{$message}}
             </div>
            @endif
       
            <form action="{{route('admin.color.update', $color->id)}}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name color <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control w-50 @if($errors->has('name')) is-invalid @endif" value="{{old('name', $color->name)}}" name="name" placeholder="Name color">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="d-flex align-content-center">Choose Color <span class="text-danger">*</span></label> 
                        <input type="color" name="favcolor" value="{{old('favcolor', $color->favcolor)}}" >
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{$errors->first('favcolor')}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" style="margin: -10px 0px 20px 20px;">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@stop
