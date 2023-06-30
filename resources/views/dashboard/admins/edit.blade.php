@extends('dashboard.layouts.app', ['header' => $admin->full_name['first_name']])
@section('title', 'Edit ID : ' . $admin->id)
@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Browser defaults</h3>
        </div>
        <!-- Card body -->
        <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{route('admins.update', $admin->id)}}">
        @csrf
        @method('put')
        <!-- Form -->
            <div class="form-row">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Personal  information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="form-control-label" for="first_name">First name <span class="text-danger">*</span></label>
                                <input type="text" value="{{$admin->full_name['first_name']}}" class="form-control @if($errors->has('first_name')) is-invalid @endif" id="" placeholder="First name" name="first_name">
                                <div class="invalid-feedback">
                                    @if($errors->has('first_name'))
                                        {{$errors->first('first_name')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="last_name">Last name  <span class="text-danger">*</span></label>
                                <input type="text" value="{{$admin->full_name['last_name']}}" class="form-control @if($errors->has('last_name')) is-invalid @endif" id="" placeholder="Last name" name="last_name">
                                <div class="invalid-feedback">
                                    @if($errors->has('last_name'))
                                        {{$errors->first('last_name')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="last_name">Middle name</label>
                                <input type="text" value="{{$admin->full_name['middle_name']}}" class="form-control @if($errors->has('middle_name')) is-invalid @endif" id="" placeholder="Middle name" name="middle_name">
                                <div class="invalid-feedback">
                                    @if($errors->has('middle_name'))
                                        {{$errors->first('middle_name')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$admin->email}}" class="form-control @if($errors->has('email')) is-invalid @endif" id="" placeholder="Email" name="email">
                                    <div class="invalid-feedback">
                                        @if($errors->has('email'))
                                            {{$errors->first('email')}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="first_name">Additional</label>
                                <input type="text" value="@if($admin->additional != null){{$admin->additional['en']}} @else{{old('additional')}}@endif" class="form-control @if($errors->has('additional')) is-invalid @endif" id="" placeholder="Additional" name="additional">
                                <div class="invalid-feedback">
                                    @if($errors->has('additional'))
                                        {{$errors->first('additional')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4"/>
                    <h6 class="heading-small text-muted mb-4">Avatar</h6>
                    <div class="form-group col-md-6">
                        <div class="custom-file">
                            <div class="avatar">
                                <img id="image" @if($admin->avatar) src="{{asset('storage/admin/admin_avatars/' . $admin->avatar)}}" @else src="{{asset('storage/admin/admin_avatars/avatar.png')}}" @endif class="admin_img_sm fit-contain" >
                            </div>
                            <div class="input-group">
                                <input type="file" id="img" class="form-control-file" name="avatar" onchange="previewImage()">
                                <div class="invalid-feedback" style="display: block">
                                    @if($errors->has('avatar'))
                                        {{$errors->first('avatar')}}
                                    @endif
                                </div>
                                <input type="hidden" value="@if($admin->avatar){{$admin->avatar}}@else @endif" name="old_avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Form -->
            <div class="p-3 form_btn float-right">
                <a class="btn btn-secondary p-2 " href="{{route('admins.view', $admin->role_id)}}">Cancel</a>
                <button type="submit" class="btn btn-primary p-2">Save</button>
            </div>
        </form>
        </div>
    </div>

    <script>

        function previewImage() {
            var previewImg = document.querySelector('#image');
            var fileImg    = document.querySelector('#img').files[0];
            var readerImg  = new FileReader();

            readerImg.addEventListener("load", function () {
                previewImg.src = readerImg.result;
            }, false);

            if (fileImg) {
                readerImg.readAsDataURL(fileImg);
            }
        }
    </script>
@stop
