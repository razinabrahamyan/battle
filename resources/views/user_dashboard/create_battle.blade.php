@extends('user_dashboard.layouts.single_app')
@section('title', 'Create Battle')
@section('navbar_title', 'Create Battle')
@section('content')
    <div class="container-fluid">
        <div class="profile_basic">
            <form action="{{route('battle.store')}}"  method="post">
                @csrf
                <div class="pt-2" >
                    <div class="row mx-0 mt-5 form-group">

                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="title" class="input_label">Battle title <span >*</span></label>
                            <input value="{{old('title')}}" type="text" id="title" name="title" class="smar form-control @if($errors->has('title')) is-invalid @endif()" placeholder="Enter Title" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="start_date" class="input_label">Start date <span >*</span></label>
                            <input
                                required name="start_date"
                                id="start_date" type="text"
                                class="readonly @if($errors->has('start_date')) is-invalid @endif() datetimepicker-input smar"
                                placeholder="dd/mm/yy"
                                value="{{old('start_date')}}"
                                data-target="#start_date"
                                >
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="time" class="input_label">Time <span >*</span></label>
                            <input  required type="text" id="time"  name="time" class=" readonly @if($errors->has('time')) is-invalid @endif() datetimepicker-input smar"
                                    placeholder="Set Time" value="{{old('time')}}" data-target="#time">
                            @if($errors->has('time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 col-md-4 mt-3 col-sm-6">
                            <label for="category" class="input_label">Category <span >*</span></label>
                            <select  name="category" id="category" class="form-control @if($errors->has('category')) is-invalid @endif()"  required >
                                <option disabled value="" selected hidden>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if (old('category') == $category->id) selected @endif>{{$category->title["en"]}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4 mt-3 col-sm-6">
                            <label for="rounds" class="input_label">Set Rounds</label>
                            {{--<input type="range">--}}
                            <select required name="rounds" id="rounds" class="@if($errors->has('rounds')) is-invalid @endif() form-control" >
                                <option value="Canada" disabled>Set Rounds</option>
                                @for($i = $rounds['rounds_min'] ; $i <= $rounds['rounds_max'];$i++ )
                                    <option value="{{$i}}" @if (old('rounds') == $i) selected="selected" @endif >{{$i}}</option>
                                @endfor
                            </select>
                            @if($errors->has('rounds'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rounds') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 col-md-4 mt-3 col-sm-6">
                            <label for="gap" class="input_label">Gap Between Rounds</label>
                            <select  required name="gap" id="gap" class="@if($errors->has('gap')) is-invalid @endif() form-control" >
                                <option value="0" @if (old('gap') == '0') selected="selected" @endif selected>0 min</option>
                                <option value="5" @if (old('gap') == '5') selected="selected" @endif>5 min</option>
                                <option value="10" @if (old('gap') == '10') selected="selected" @endif>10 min</option>
                                <option value="15" @if (old('gap') == '15') selected="selected" @endif>15 min</option>
                            </select>
                            @if($errors->has('gap'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gap') }}
                                </div>
                            @endif
                        </div>

                    </div>



                    <div class="row mx-0 mt-5 form-group">



                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="screen_type" class="input_label">Screen Type</label>
                            <select  required name="screen_type" id="screen_type" class="@if($errors->has('screen_type')) is-invalid @endif() form-control" >
                                <option value="Canada" disabled>Screen Type</option>
                                <option value="auto" selected>Auto</option>
                                <option value="in_sync">In sync</option>
                                <option value="manual">Manual</option>
                            </select>
                            @if($errors->has('screen_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('screen_type') }}
                                </div>
                            @endif
                            @if($errors->has('auto_change'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('auto_change') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="auto_change" class="input_label">Round Change</label>
                            <input type="checkbox" class="switch d-block" name="round_change" id="round_change" value="1" @if(old('round_change')) checked @endif>
                        </div>

                        <div class="col-12 col-md-4 col-sm-6 user_opponent">
                            <label for="user_opponent" class="input_label"> User Opponent  <span >*</span></label>
                            <div class="position-relative" id="users_search">
                                <input type="text"  class="smar opponent_user_id form-control" placeholder="Enter users nickname" @if($opponent) value="{{$opponent->nickname}}" @endif>
                                <input type="text" id="user_id" name="opponent_id" @if($opponent) value="{{$opponent->id}}" @endif class="form-control input_hidden" placeholder="Enter users nickname" required>
                                <div class="position-absolute front_main_background opponent_users_desk p-1 animate__animated">
                                </div>
                            </div>
                            @if($errors->has('opponent_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('opponent_id') }}
                                </div>
                            @endif
                            <div id="opponent_user_added" class="mt-2">
                                @if($opponent)
                                    <div class="d-flex align-items-center battle_create_opponent p-1">
                                        <img src="{{asset('storage/user/images/avatar/'.$opponent->avatar)}}" alt="" >
                                        <div class="pl-2">
                                            <p class="m-0">{{$opponent->nickname}}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="auto_change" class="input_label">Auto Change Screen</label>
                            <div class="create_range_handler">
                                <input name="auto_change" id="auto_change" type="range" min="0" max="19" step="1" value="0" class="@if($errors->has('auto_change')) is-invalid @endif()">
                                <div class="value pl-2">5 sec</div>
                            </div>

                            {{--<select   name="auto_change" id="auto_change" class="@if($errors->has('auto_change')) is-invalid @endif() form-control" >
                                <option value="0.5" selected>30 sec</option>
                                <option value="1">1 min</option>
                                <option value="0">don`t change</option>
                            </select>--}}
                            @if($errors->has('auto_change'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('auto_change') }}
                                </div>
                            @endif
                        </div>



                        <div class="col-12 col-md-4 col-sm-6">
                            <label for="auto_change" class="input_label">Mute Inactive Profile</label>
                            <input type="checkbox" class="switch d-block" id="mute" name="mute" value="1" @if(old('mute')) checked @endif>
                        </div>


                    </div>


                </div>


                <div class="border-div mt-5"></div>
                <div class="mt-5">
                    <div class="row  user_dashboard_info">
                        <div class="col-12 col-md-6 pr-2 description_creating">
                            <div class="front_main_background p-4">
                                <p class="p_header">Description</p>
                                <textarea name="description" id="description"  rows="5" class="w-100 border-0">{{old('description')}}</textarea>
                            </div>

                        </div>
                        <div class="col-12 col-md-6 pr-4 pl-2 description_creating">
                            <div class="front_main_background p-4 ">
                                <p class="p_header">Private Message</p>
                                <textarea name="private_message" id="private_message"  rows="5" class="w-100 border-0">{{old('private_message')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-5">
                    <button type="submit">Send Request</button>
                </div>

            </form>

        </div>
    </div>


    <script>
        $(document).ready(function(){
            setTimeout(function () {
                $('.create_battle_fixed').addClass('animate__animated animate__fadeOut')
            },1000)
            $("#screen_type").change(function(){
                let screen = $(this).children("option:selected").val();
                if (screen == 'auto'){
                    $("#auto_change").attr('disabled',false)
                    $('.value').css('color','#fff');
                }else {
                    $("#auto_change").attr('disabled',true)
                    $('.value').css('color','grey');
                }
            });

            $(".readonly").keydown(function(e){
                e.preventDefault();
            });
        });
        let auto_changes = ['5 sec','10 sec',' 15 sec','20 sec','25sec','30 sec','35 sec','40 sec','45 sec','50 sec','55 sec','1 min', '1.5 min','2 min', '2.5 min' , '3 min', '5 min' , '10 min', '30 min', '1 hour']
        console.log(auto_changes.length,'length')
        $('#auto_change').on('input',function () {
            $('.value').text(auto_changes[parseInt($(this).val())])
            console.log(auto_changes[parseInt($(this).val())],$(this).val())
        })

        $(function () {
            let users_desk =  $('.opponent_users_desk');
            $(document).on('click', function (event) {
                if (!$(event.target).closest('#users_search').length) {
                    users_desk.addClass('animate__fadeOut');
                }
            });
            $('.opponent_user_id').keyup(function () {
                let nickname = $(this).val();
                users_desk.addClass('animate__fadeIn');
                users_desk.removeClass('animate__fadeOut');
                if (nickname){
                    $.ajax({
                        type: "GET",
                        dataType : "json",
                        url: "{{route('get.users.nickname')}}",
                        data: {'nickname': nickname},
                        success: function(data){
                            let users = data.users;
                            users_desk.css('display','block').empty();
                            if(users.length){
                                for(let i = 0 ; i < users.length ; i++){
                                    let user_item = $('<div class="d-flex align-items-center battle_create_opponent p-1">\n' +
                                        '                                                <img src="/storage/user/images/avatar/'+ users[i].avatar +'" alt="" >\n' +
                                        '                                                <div class="pl-2">\n' +
                                        '                                                    <p class="m-0">'+ users[i].nickname +'</p>\n' +
                                        '                                                </div>\n' +
                                        '                                            </div>')
                                    user_item.click(function () {
                                        $('#user_id').val(users[i].id);
                                        $('.opponent_user_id').val(users[i].nickname);
                                        $('#opponent_user_added').empty()
                                        $('#opponent_user_added').append($('<div class="front_main_background px-2 d-flex align-items-center h-100"></div>').append(user_item))
                                        users_desk.hide(500);
                                    })
                                    users_desk.append(user_item)
                                }
                            }else{
                                users_desk.append('<div >\n' +
                                    '                                                <p class="p-2 ">No users found !</p>\n' +
                                    '                                            </div>')

                            }

                        }
                    });
                }else{
                    users_desk.removeClass('animate__fadeIn');
                    users_desk.addClass('animate__fadeOut');
                }

            })
            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD',
                ignoreReadonly:true,
                allowInputToggle:true
            });
            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD',
                ignoreReadonly:true,
                allowInputToggle:true
            });
            $('#time').datetimepicker({
                format: 'LT',
                ignoreReadonly:true,
                allowInputToggle:true
            });

        })
        $(document).ready(function () {

        })
    </script>
@endsection
