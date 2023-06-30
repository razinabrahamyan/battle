@extends('user_dashboard.layouts.app')
@section('title', 'Battle')
@section('content')
    <div class="container-fluid ">
        <div class="mt-5 public_profile">
            <div class="row justify-content-between mx-0 px-4">
                <div class="d-flex profile_basic">

                    <div class="pl-3">
                        <img src="{{asset('storage/user/images/avatar/'.$user->avatar)}}" alt="">
                    </div>
                    <div class="public_profile_info pl-4">
                        <p class="profile_full_name">{{$user->nickname}}</p>
                        <p class="profile_address">{{$user->country->country['en']}}, {{$user->state->state['en']}}, {{$user->city->city['en']}}</p>
                        <p >{{$followers}} Followers</p>
                        <a href="{{route('battle.create').'?opponent='.$user->nickname}}" class="challenge">Challenge To Battle</a>
                    </div>
                </div>
                <div class="d-flex align-items-center public_profile_buttons">

                    @auth()
                        <button class="btn mx-2" id="follow_button" @if($followed) disabled @endif data-avatar="{{$user->avatar}}" data-user="{{$user->id}}" data-nickname="{{$user->nickname}}">Follow @if($followed) <i class="fa fa-check"></i> @endif</button>
                    @else
                        <button data-toggle="modal" data-target="#loginModal" class="btn mx-2" >Follow</button>
                    @endauth

                    <a href="{{route('chat',$user->nickname)}}" class="btn mx-2">Message</a>
                    <button class="btn ml-2 settings_part"><i class="fa fa-ellipsis-h"></i></button>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="row mx-0 user_dashboard_info">
                <div class="col-6 pl-4 pr-2 ">
                    <div class="front_main_background p-4 about">
                        <p class="p_header">About  {{$user->full_name['first_name']}}</p>
                        <div class="">
                            @if($user->additional && array_key_exists('about',$user->additional)){{$user->additional['about']}}@endif
                        </div>
                    </div>

                </div>
                <div class="col-6 pr-4 pl-2">
                    <div class="front_main_background p-4 h-100">
                        <p class="p_header">Statistics</p>
                        <div class="d-flex justify-content-around statistics">
                            <div class="text-center">
                                <p class="category">Followers</p>
                                <p class="count" id="following">{{$followers}}</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Following</p>
                                <p class="count">{{$followings}}</p>
                            </div>
                            {{--<div class="text-center">
                                <p class="category">Subscriptions</p>
                                <p class="count">437</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Your Subscriptions</p>
                                <p class="count">146</p>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="live_battles_div pt-3 pb-4">

                <div class="d-flex live_battle_headers col-12">
                    <div>
                        <p class="font-weight-bold">Upcoming Battles</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="upcoming_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="upcoming_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                <div class=" mt-3 owl-carousel custom-carousel" id="battle_upcoming_carousel">
                    <x-carousel  user="{{$user->id}}" type="upcoming"></x-carousel>
                </div>

                <div class="d-flex live_battle_headers col-12 ">
                    <div>
                        <p class="font-weight-bold">Previous Battles</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="previous_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="previous_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>

                <div class="owl-carousel mt-3  custom-carousel" id="battle_previous_carousel">
                    <x-carousel  type="previous" user="{{$user->id}}"></x-carousel>
                </div>
            </div>
        </div>

    </div>
    <script src="{{asset('users_assets/js/battle_carousel.js')}}"></script>
    <script>
        $(document).ready(function () {
            makeBattleCarousels()
            $('#follow_button').click(function () {
                let button = $(this);
                button.attr('disabled',true)
                console.log($(this).data('user'))
                $.ajax({
                    url: '{{route('battle.follow')}}',
                    type: "post",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        user:$(this).data('user')
                    },
                    success: function (response) {
                        button.append(' <i class="fa fa-check"></i>');
                        alertSuccess(response.message);
                        $('#following').html(parseInt($('#following').html()+1))
                        if($('#has_followings').val() == '0'){
                            $('.no_followings').remove();
                        }
                        $('#followers_sidebar_place').append('<a href="/profile/'+ button.data('nickname') +'" class="list-group-item-action">\n' +
                            '                        <div class="list-group-item-action  row pl-3 pr-1 py-2">\n' +
                            '                            <div class="col-10 pl-2 row offset-2 followed_channels_div animate__animated animate__fadeInLeft">\n' +
                            '                                <div><img src="/storage/user/images/avatar/'+ button.data('avatar') +'" class="navbar_profile_icon" alt="user-avatar"></div>\n' +
                            '                                <div class="channel_name">\n' +
                            '                                    <p class="mb-0 pl-2">'+ button.data('nickname') +'</p>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                    </a>')

                    },
                    error:function (response) {

                    }
                })
            })
        })

    </script>
@endsection
