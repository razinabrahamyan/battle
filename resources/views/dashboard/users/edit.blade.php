@extends('dashboard.layouts.app')
@section('title', 'full_name')
@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Edit User`s Info</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <form class=" p-3" method="POST" action="{{route('users.update',$user->id)}}">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-control-label" for="first_name">First name</label>
                            <input type="text" class="form-control @if($errors->has('first_name')) is-invalid @endif " id="validationDefault01" name="first_name" @if(old('first_name')) value="{{old('first_name')}}" @else value="{{$user->full_name["first_name"]}}"  @endif required="">
                            <div class="invalid-feedback">
                                {{$errors->first('first_name')}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Last name</label>
                            <input type="text" class="form-control @if($errors->has('last_name')) is-invalid @endif " id="validationDefault02" name="last_name" @if(old('last_name')) value="{{old('last_name')}}" @else value="{{$user->full_name["last_name"]}}"  @endif  required="">
                            <div class="invalid-feedback">
                                {{$errors->first('last_name')}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-control-label" for="additional">Additional</label>
                            <input type="text" class="form-control" id="additional" placeholder="Additional info" name="additional" @if(old('additional')) value="{{old('additional')}}" @else @if($user->additional)value="{{$user->additional["info"]}}" @endif  @endif  >
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <p>Active</p>
                            <label class="custom-toggle ">
                                <input type="checkbox" @if($user->status == 1)  checked="checked" @endif name="status">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <p>Verified</p>
                            <label class="custom-toggle ">
                                <input type="checkbox" @if($user->verified == 1)  checked="checked" @endif name="verified">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                        </div>
                    </div>


                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>

    </div>
@stop
