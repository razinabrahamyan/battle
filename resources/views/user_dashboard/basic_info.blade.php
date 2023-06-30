@extends('user_dashboard.layouts.user_app')
@section('title', 'Battle')
@section('content')
    <div class="container-fluid ">
        <input type="hidden" value="{{session('success')}}" id="success_info">
            <div class="col-12 profile_basic">
                <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data" id="profile_edit_form">
                @csrf
                    <div class="form-group">
                        <div class="pt-3">
                            <p class="battle_profile_heading">Profile Picture</p>
                            <div class="d-flex align-items-center flex-wrap">
                                <input type="file" style="display: none" name="image" id="image">
                                <div id="profile_image_div" class="pr-3">
                                    <img id="profile_image" src="{{asset('storage/user/images/avatar/'.$user->avatar)}}">
                                </div>
                                <div class="py-2">
                                    <button type="button" id="image_upload_button">Upload Profile Picture</button>
                                    <p class="pt-1 mb-0">Must be JPEG, PNG, or GIF and cannot exceed 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="border-div mt-5"></div>

                    <div class="pt-3" >
                        <p class="battle_profile_heading">Personal Info</p>
                        <div  class="col-12">
                            <div class="row">
                            <div class="col-12 col-md-4 col-sm-6">
                                <label for="nickname" class="input_label">Nickname Name</label>
                                <input type="text" id="nickname" name="nickname" class="form-control smar" value="{{$user->nickname}}">
                                <div class="d-flex mx-0 username_status" id="username_availability">

                                </div>
                            </div>
                                <div class="col-12 col-md-4 col-sm-6">
                                    <label for="first_name" class="input_label">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control smar" placeholder="First Name" value="{{$user->full_name && $user->full_name['first_name'] ? $user->full_name['first_name']:''}}">
                                </div>

                                <div class="col-12 col-md-4 col-sm-6">
                                    <label for="last_name" class="input_label">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control smar" placeholder="Last Name" value="{{$user->full_name && $user->full_name['last_name'] ? $user->full_name['last_name']:''}}">
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-12 col-md-4 col-sm-6">
                                <label for="country" class="input_label">Country</label>
                                <select name="country" id="country" class="form-control">
                                    @foreach($countries as $country)
                                        <option @if($country->id === $user->country_id) selected  @endif value="{{$country->id}}">{{$country->country['en']}}</option>
                                    @endforeach
                                    @if(!$user->country_id)
                                            <option value="" selected disabled>select country</option>
                                        @endif
                                </select>
                            </div>

                            <div class="col-12 col-md-4 col-sm-6">
                                <label for="state" class="input_label">State</label>
                                <select name="state" id="state" class="form-control">
                                    @if($user->country_id)
                                        @foreach($states as $state)
                                            <option @if($state->id === $user->state_id) selected  @endif value="{{$state->id}}">{{$state->state['en']}}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled>select state</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-4 col-sm-6">
                                <label for="city" class="input_label">City</label>
                                <select name="city" id="city" class="form-control">
                                    @if($user->state_id)
                                        @foreach($cities as $city)
                                            <option @if($city->id === $user->city_id) selected  @endif value="{{$city->id}}">{{$city->city['en']}}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled>select city</option>
                                    @endif
                                </select>
                            </div>

                            </div>



                        </div>
                    </div>

                    <div class="border-div mt-5"></div>
                    <div class="pt-3 col-12 col-lg-6 col-md-8" >
                        <p class="battle_profile_heading">Bio</p>
                        <textarea class="w-100" name="about" id="about" >@if($user->additional && array_key_exists('about',$user->additional)){{$user->additional['about']}}@endif</textarea>
                    </div>
                    <div class="pt-5" id="submit_button">
                        <button type="button">Save Changes</button>
                    </div>

                </form>


        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#image_upload_button').click(function () {
                $('#image').trigger('click');
            });
            let success_info = $('#success_info').val();
            if(success_info){
                alertSuccess(success_info)
            }
            let valid = true;
            function checkNickname(nickname) {
                if(nickname){
                    $.ajax({
                        url: '{{route('user.check.nickname')}}',
                        type: "get",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            nickname:nickname
                        },
                        success: function (response) {
                            console.log(response.availability)
                            if(response.availability){
                                valid = true;
                                $('#username_availability').empty();
                                $('#username_availability').append('<div class="align-self-center">\n' +
                                    '                                        <div class="round_success">\n' +
                                    '                                            <i class="fa fa-check"></i>\n' +
                                    '                                        </div>\n' +
                                    '                                    </div>\n' +
                                    '                                    <div class="align-self-center pl-2">\n' +
                                    '                                       <span>Username Available</span>\n' +
                                    '                                    </div>');
                            }else{
                                valid = false;
                                $('#username_availability').empty();
                                $('#username_availability').append('<div class="align-self-center">\n' +
                                    '                                        <div class="round_error animate__animated">\n' +
                                    '                                            <i class="fa fa-times"></i>\n' +
                                    '                                        </div>\n' +
                                    '                                    </div>\n' +
                                    '                                    <div class="align-self-center pl-2">\n' +
                                    '                                       <span>Username Unavailable</span>\n' +
                                    '                                    </div>');

                            }

                        },
                        error:function (response) {
                        }
                    })
                }else{
                    $('#username_availability').empty();
                }

            }
            function updateCities(state_id){
                $.ajax({
                    url: '{{route('user.get.cities')}}',
                    type: "get",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        state_id:state_id
                    },
                    success: function (response) {
                        console.log(response.cities)
                        let cities = response.cities;
                        $('#city').empty();
                        for(let i = 0; i < cities.length; i++){
                            $('#city').append('<option value="'+ cities[i].id +' ">'+ cities[i].city["en"] +'</option>');
                        }
                    },
                    error:function (response) {
                    }
                })
            }
            function updateStates(country_id) {
                $.ajax({
                    url: '{{route('user.get.states')}}',
                    type: "get",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        country_id:country_id
                    },
                    success: function (response) {
                        let states = response.states;
                        $('#state').empty();
                        for(let i = 0; i < states.length; i++){
                            $('#state').append('<option value="'+ states[i].id +' ">'+ states[i].state["en"] +'</option>');
                        }
                        updateCities(states[0].id);
                    },
                    error:function (response) {
                    }
                })
            }
            function previewFile() {
                let preview = document.getElementById('profile_image');
                let file    = document.querySelector('input[type=file]').files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    preview.src = reader.result;
                }, false);
                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            $('#image').change(function () {
                previewFile();
            });
            $('#country').change(function () {
                updateStates($(this).val())
            })

            $('#state').change(function () {
                updateCities($(this).val())
            })
            $('#nickname').keyup(function () {
                valid = false;
                checkNickname($(this).val());
            })
            $('#submit_button').click(function () {
                if(valid){
                    $('#profile_edit_form').submit()
                }else{
                    $('.round_error').removeClass('animate__bounce')
                    $('.round_error').addClass('animate__bounce')
                }

            })
        })

    </script>
@endsection
