@extends('user_dashboard.layouts.main_app')
@section('nav')
    <div class="container-fluid @if(request()->route()->uri() === '/' || request()->route()->uri() === 'home') light_container @endif">
        <div class="main_background">
            <div class="main_nav col-12">
                <nav class="navbar navbar-expand-lg navbar-light " id="main_nav">
                    <button id="sidebar_opener_button"><span class="navbar-toggler-icon"></span></button>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-tools"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto navbar_left_handler p-0">
                            <li class="nav-item ">
                                <div class="main_search_div" id="main_search_div">
                                    <svg id="magnifying-glass" xmlns="http://www.w3.org/2000/svg" width="20.043" height="20.048" viewBox="0 0 20.043 20.048">
                                        <path id="Path_32" data-name="Path 32"
                                              d="M19.92,19.025l-4.872-4.872A8.555,8.555,0,1,0,14.2,15l4.872,
                                          4.872a.6.6,0,0,0,.422.178.586.586,0,0,0,.422-.178A.6.6,0,0,0,19.92,19.025ZM1.246,8.548A7.348,
                                          7.348,0,1,1,8.594,15.9,7.356,7.356,0,0,1,1.246,8.548Z" transform="translate(-0.05)" fill="#fff"/>
                                    </svg>

                                    <input type="text" id="main_serch_input" placeholder="@lang('messages.search')...">
                                    <div class="search_result_div animate__animated" id="search_result_div"></div>
                                </div>
                            </li>
                            @auth()
                                @if($battle_coming)
                                    <li class="nav-item ">
                                        <div class="d-flex main_timer">
                                            <a class="text-white" href="{{route('battle.show',$battle_coming->id)}}">{{$battle_coming->title}}</a>
                                            <div class="count_down ml-3 orange" data-date="{{$battle_coming->start_date}}">00:00:00</div>
                                        </div>
                                    </li>

                                @endif
                            @endauth
                        </ul>

                        @if(\Request::is('battles'))
                            @include('user_dashboard.includes.filter')
                        @endif
                        @include('user_dashboard.includes.app_auth')
                    </div>
                </nav>
            </div>

            @if(request()->route()->uri() === '/' || request()->route()->uri() === 'home')
                <div class="main_page_carousel">
                    <div class="owl-carousel home_page_carousel">
                        @forelse($slider as $slide)
                            @if($slide->type === 'battle')
                                <div>
                                    <div class="owl_absolute">
                                        <div class="carousel_info pl-2">
                                            <a class="text-white" href="{{route('battle.show',$slide->slide->id)}}"><h1>{{$slide->slide->title}}</h1></a>
                                            <p>Battle between <span class="carousel_channel_name">{{$slide->slide->request->creator->nickname}}</span> and <span
                                                    class="carousel_channel_name">{{$slide->slide->request->joiner->nickname}}</span></p>
                                            @auth()
                                                <button @if(count($slide->slide->reminder))disabled @endif class="btn battle_card_reminder" data-old="1" data-battle="{{$slide->slide->id}}">Set Reminder @if(count($slide->slide->reminder))<i class="fa fa-check"></i> @endif</button>
                                            @else
                                                <button data-toggle="modal" data-target="#loginModal" class="btn battle_card_reminder_guest">Set Reminder</button>
                                            @endauth

                                        </div>
                                    </div>
                                    {{--<div class="owl_battle_time">
                                        <span>24:23</span>
                                    </div>--}}
                                    <div class="owl_battle_users">
                                        <span>{{$slide->slide->views?$slide->slide->views:0}}</span>
                                        <span><i class="fa fa-user"></i></span>
                                    </div>
                                    <img src="{{asset('users_assets/images/battle/card_background_'.rand(1,5).'.png')}}" alt="">
                                </div>

                            @elseif($slide->type === 'slide')
                                <div>
                                    <div class="owl_absolute">
                                        <div class="carousel_info pl-2">
                                            <h1>{{$slide->slide->title}}</h1>
                                            <p>{{$slide->slide->description}}</p>
                                            <button class="btn">Set Reminder </button>
                                        </div>
                                    </div>
                                    <div class="owl_battle_time">
                                        <span>24:23</span>
                                    </div>
                                    <div class="owl_battle_users">
                                        <span>299</span>
                                        <span><i class="fa fa-user"></i></span>
                                    </div>
                                    <img src="{{asset('storage/user/images/slider/'.$slide->slide->image)}}" alt="">
                                </div>
                            @endif
                        @empty
                            <div>
                                <div class="owl_absolute">
                                    <div class="carousel_info pl-2">
                                        <h1>UBattle</h1>
                                        <p>New battles coming soon</p>

                                    </div>
                                </div>
                                <div class="owl_battle_time">
                                    <span>24:23</span>
                                </div>
                                <div class="owl_battle_users">
                                    <span>299</span>
                                    <span><i class="fa fa-user"></i></span>
                                </div>
                                <img src="{{asset('users_assets/images/battle/card_background_5.png')}}" alt="">
                            </div>
                        @endforelse

                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

