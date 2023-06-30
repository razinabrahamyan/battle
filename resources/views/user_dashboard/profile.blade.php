@extends('user_dashboard.layouts.user_app')
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
                        <p>{{$user->nickname}} </p>
                        <p>{{$user->country ? $user->country->country['en']:''}}, {{$user->state ? $user->state->state['en']:''}}, {{$user->city ? $user->city->city['en']:''}}</p>
                        <p>{{$followers}} Followers</p>

                    </div>
                </div>
                <div class="d-flex align-items-center public_profile_buttons">
                    <div class="dropdown py-3">
                        <button class="btn ml-2 " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('front.basic.info')}}">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="row mx-0 user_dashboard_info">
                <div class="col-12 col-md-6 pl-4 pr-2 description_creating">
                    <div class="front_main_background p-4 about">
                        <p class="p_header">About  {{$user->nickname}}</p>
                        <div class="">
                            @if($user->additional && array_key_exists('about',$user->additional)){{$user->additional['about']}}@endif
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 pr-4 pl-2 description_creating">
                    <div class="front_main_background p-4 h-100">
                        <p class="p_header">Statistics</p>
                        <div class="d-flex justify-content-around statistics">
                            <div class="text-center">
                                <p class="category">Followers</p>
                                <p class="count">{{$followers}}</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Following</p>
                                <p class="count">{{$followings}}</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Subscriptions</p>
                                <p class="count">{{$subscriptions->count()}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="live_battles_div pt-3 pb-4">

                <div class="d-flex live_battle_headers col-12">
                    <div>
                        <p class="font-weight-bold">My Battles</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="all_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="all_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                <div class=" mt-3 owl-carousel custom-carousel" id="battle_all_carousel">
                    <x-carousel user="{{$user->id}}" type="all" ></x-carousel>
                </div>


                <div class="d-flex live_battle_headers col-12">
                    <div>
                        <p class="font-weight-bold">Subscribed Battles</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="subscribed_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="subscribed_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                <div class=" mt-3 owl-carousel custom-carousel" id="battle_subscribed_carousel">
                    <x-carousel user="{{$user->id}}" type="subscribed" ></x-carousel>
                </div>


                <div class="d-flex live_battle_headers col-12">
                    <div>
                        <p class="font-weight-bold">Upcoming Battles</p>
                    </div>
                    <div>
                        <button class="btn no_outline" id="upcoming_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="upcoming_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                <div class=" mt-3 owl-carousel custom-carousel" id="battle_upcoming_carousel">
                    <x-carousel user="{{$user->id}}" type="upcoming" ></x-carousel>
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
                    <x-carousel user="{{$user->id}}" type="previous"></x-carousel>
                </div>
            </div>
        </div>


    </div>
    <script src="{{asset('users_assets/js/battle_carousel.js')}}"></script>
    <script>
        $(document).ready(function () {
            makeBattleCarousels()
        })

    </script>
@endsection
