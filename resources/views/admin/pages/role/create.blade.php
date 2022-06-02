@extends('admin.layouts.admin')

@section('content-admin')
   <div class="container-fluid" style="height:627px; overflow-x: hidden; display: block;">
       <div class="row">
           <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create role</h5>
                    </div>
                    <form action="{{route('admin.role.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name role <span class="text-danger">*</span></label>
                                <input type="text"  class="form-control w-50 @if($errors->has('name')) is-invalid @endif" name="name" placeholder="Name role">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$errors->first('name')}}
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
   </div>
@stop
