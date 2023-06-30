@extends('user_dashboard.layouts.user_app')
@section('title', 'Battle')
@section('content')
    <div class="container-fluid">
        <div class="mt-3">
            <div class="row mx-0 user_dashboard_info">
                <div class="col-12 col-md-6 description_creating px-4">
                    <div class="front_main_background p-4">
                        <p class="p_header">Battle Summary</p>
                        <div class="d-flex justify-content-around statistics">
                            <div class="text-center">
                                <p class="category">Total Battles</p>
                                <p class="count">1080</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Battles Won</p>
                                <p class="count">940</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Battles Lost</p>
                                <p class="count">140</p>
                            </div>
                            <div class="text-center">
                                <p class="category">Totla Views</p>
                                <p class="count">90.1k</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6  description_creating px-4">
                    <div class="front_main_background p-4 ">
                        <p class="p_header">Connections</p>
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

                {{--<div class="d-flex live_battle_headers col-12">
                    <div>
                        <p class="font-weight-bold">Your Upcoming Battles</p>
                    </div>
                    <div>
                        <button class="btn no_outline" id="sponsored_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="sponsored_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                <div class=" mt-3 pl-3 sponsored_battles owl-carousel custom-carousel" id="battle_sponsored_carousel">
                    <x-sponsored-carousel ></x-sponsored-carousel>
                </div>--}}
                <div class="d-flex live_battle_headers col-12 ">
                    <div>
                        <p class="font-weight-bold">Upcoming Battles From People You Follow</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="follow_prev"><i class="fa fa-angle-left"></i></button>
                        <button class="btn mr-3 no_outline" id="follow_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>

                <div class="owl-carousel mt-3  custom-carousel" id="battle_follow_carousel">
                    <x-carousel category="5"></x-carousel>
                </div>

                <div class="d-flex live_battle_headers col-12 ">
                    <div>
                        <p class="font-weight-bold">Previous Battles</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="previous_prev"><i class="fa fa-angle-left"></i></button>
                        <button class="btn mr-3 no_outline" id="previous_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>

                <div class="owl-carousel mt-3  custom-carousel" id="battle_previous_carousel">
                    <x-carousel category="6"></x-carousel>
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
