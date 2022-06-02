@extends('admin.layouts.admin')

@section('content-admin')
   <div class="container-fluid" style="height:627px; overflow-x: hidden; display: block;">
       <div class="row">
           <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create category</h5>
                    </div>
                    <form action="{{route('admin.category.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <label for="">Name category <span class="text-danger">*</span></label>
                            <input type="text"  class="form-control w-50 @if($errors->has('name')) is-invalid @endif" name="name" placeholder="Name category">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$errors->first('name')}}
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
   </div>
@stop
