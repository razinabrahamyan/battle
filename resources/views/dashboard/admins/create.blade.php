@extends('dashboard.layouts.app', ['header' => 'Add ' . ucfirst($role->name)])
@section('title','Add ' . ucfirst($role->name))
@section('content')
    <div class="container-fluid mt--6">
        <div class="card-wrapper">
                    <!-- Custom form validation -->
                    <div class="card">
                        <div class="card-body">
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text">{{ucfirst($role->name)}} {{session('success')}}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="needs-validation" method="POST" action="{{route('admins.store')}}" enctype="multipart/form-data">
                            @csrf
                            <!-- Form -->
                                <input type="hidden" name="role_id" value="{{$role->id}}">
                                <div class="form-row">
                                    <div class="card-body">
                                        <h6 class="heading-small text-muted mb-4">Personal information</h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="form-control-label" for="first_name">First name <span class="text-danger">*</span></label>
                                                    <input type="text" value="{{old('first_name')}}" class="form-control @if($errors->has('first_name')) is-invalid @endif" id="first_name" placeholder="First name" name="first_name">
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('first_name'))
                                                            {{$errors->first('first_name')}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-control-label" for="last_name">Last name  <span class="text-danger">*</span></label>
                                                    <input type="text" value="{{old('last_name')}}" class="form-control @if($errors->has('last_name')) is-invalid @endif" id="last_name" placeholder="Last name" name="last_name">
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('last_name'))
                                                            {{$errors->first('last_name')}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-control-label" for="last_name">Middle name</label>
                                                    <input type="text" value="{{old('middle_name')}}" class="form-control @if($errors->has('middle_name')) is-invalid @endif" id="last_name" placeholder="Middle name" name="middle_name">
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('middle_name'))
                                                            {{$errors->first('middle_name')}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="email">Email <span class="text-danger">*</span></label>
                                                        <input type="text" value="{{old('email')}}" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="Email" name="email">
                                                        <div class="invalid-feedback">
                                                            @if($errors->has('email'))
                                                                {{$errors->first('email')}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-control-label" for="first_name">Additional</label>
                                                    <input type="text" value="{{old('additional')}}" class="form-control @if($errors->has('additional')) is-invalid @endif" id="additional" placeholder="Additional" name="additional">
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('additional'))
                                                            {{$errors->first('additional')}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4"/>
                                            <div class="form-group">
                                                <h6 class="heading-small text-muted mb-4">Avatar</h6>
                                                <div class="avatar">
                                                    <img id="image" src="{{asset('storage/admin/admin_avatars/avatar.png')}}" class="admin_img_sm fit-contain" >
                                                </div>
                                                <input type="file" name="avatar" class="form-control-file" id="img" onchange="previewImage()">
                                                <div class="invalid-feedback" style="display: block">
                                                    @if($errors->has('avatar'))
                                                        {{$errors->first('avatar')}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4"/>
                                        <!-- Address -->
                                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="country">Country  <span class="text-danger">*</span></label>
                                                        <select id="country" name="country" class="form-control @if($errors->has('country')) is-invalid @endif" data-toggle="select" title="Simple select"
                                                                data-live-search="true" data-live-search-placeholder="Search ...">
                                                            <option selected value="" >Choose the Country</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}" {{old('country') == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @if($errors->has('countries'))
                                                                {{$errors->first('countries')}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="state">State  <span class="text-danger">*</span></label>
                                                        <select id="state" name="state" class="form-control @if($errors->has('state')) is-invalid @endif" data-toggle="select" title="Simple select"
                                                                data-live-search="true" data-live-search-placeholder="Search ...">
                                                            <option selected value="" >Choose the State</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @if($errors->has('state'))
                                                                {{$errors->first('state')}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="city">City  <span class="text-danger">*</span></label>
                                                        <select id="city" name="city" class="form-control @if($errors->has('city')) is-invalid @endif" data-toggle="select" title="Simple select"
                                                                data-live-search="true" data-live-search-placeholder="Search ...">
                                                            <option selected value="" >Choose the City</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @if($errors->has('city'))
                                                                {{$errors->first('city')}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4"/>
                                    </div>
                                </div>
                                <!--End Form -->
                                <div class="p-3 form_btn float-right">
                                    <a class="btn btn-secondary p-2 " href="{{route('admins.view', $role->id)}}">Cancel</a>
                                    <button type="submit" class="btn btn-primary p-2">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#country').on('change', function () {
            let id = $(this).children(":checked").attr("value");
            getStates(id)
        });

        $('#state').on('change', function () {
            let id = $(this).children(":checked").attr("value");
            getCities(id)
        });

        function getStates(id)
        {
            $.ajax({
                type: 'POST',
                url: '{{route('get.states')}}',
                data: {id:id},
                success: function (response) {
                    $('#state').empty();
                    response.map(function (value) {
                        $("#state").val($("#state option:first").attr('selected',true));
                        $('#state').append('<option value='+value.id+'>'+value.name+'</option>')
                    });
                    getCities($("#state").children(":checked").attr("value"))
                },
                error: function (error) {
                    console.log(error);
                    $('#state').empty();
                    $('#state').append('<option selected value="0" >Choose the State</option>');
                    $('#city').empty();
                    $('#city').append('<option selected value="0" >Choose the City</option>')
                }
            });
        }

        function getCities(id)
        {
            $.ajax({
                type: 'POST',
                url: '{{route('get.cities')}}',
                data: {id:id},
                success: function (response) {
                    $('#city').empty();
                    response.map(function (value) {
                        $("#city").val($("#state option:first").attr('selected',true));
                        $('#city').append('<option value='+value.id+'>'+value.name+'</option>')
                    });
                },
                error: function (error) {
                    $('#city').empty();
                    $('#city').append('<option selected value="0" >Choose the State</option>')
                }
            });
        }

        //------------State old value call oldValues()
        if("{{old('state')}}" !== '')
        {
            oldValues("{{old('state')}}", "{{route('get.state')}}", 'state');
        }

        //-----------City old value call oldValues()
        if("{{old('city')}}" !== '')
        {
            oldValues("{{old('city')}}", "{{route('get.city')}}", 'city');
        }

        //----------State, City old values
        function oldValues(id, route, type) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {id:id},
                success: function (response) {
                    if(type === 'city'){
                        $('#city').empty();
                        $('#city').append('<option value='+response.id+'>'+response.name+'</option>')
                    } else if (type === 'state'){
                        $('#state').empty();
                        $('#state').append('<option value='+response.id+'>'+response.name+'</option>')
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

    </script>
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
