@extends('user_dashboard.layouts.main_app')
@section('nav')
    <div class="home_main_content_layer">
        <div class="main_nav home_main_navbar">
            <div class="container-fluid">
                <div class="main_background">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light " id="main_nav">
                            <button id="sidebar_opener_button"><span class="navbar-toggler-icon"></span></button>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-tools"></i>
                            </button>
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
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto navbar_left_handler">

                                </ul>

                                @if(\Request::is('battles'))
                                    @include('user_dashboard.includes.filter')
                                @endif
                                @include('user_dashboard.includes.app_auth')
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
        <div class="main_owl_handler">
            <div id="owl_main" class="owl-carousel owl-theme">
                @forelse($slider as $slide)
                    @if($slide->type === 'battle')
                        <div class="item">
                            <div class="main_owl_inner">
                                <div class="owl_main_info">
                                    <p class="desc">Don`t Miss Out</p>
                                    <a class="title" href="{{route('battle.show',$slide->slide->id)}}"><p class="title">{{$slide->slide->title}}</p></a>

                                    <div class="owl_main_vs">
                                        <div>
                                            <img src="{{asset('storage/user/images/avatar/'.$slide->slide->request->creator->avatar)}}" alt="">
                                        </div>
                                        <div>
                                            <p>vs</p>
                                        </div>
                                        <div>
                                            <img src="{{asset('storage/user/images/avatar/'.$slide->slide->request->joiner->avatar)}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{asset('users_assets/images/battle/owl_background.png')}}" alt="The Last of us" class="background">
                            <div class="main_owl_shadow"></div>
                        </div>
                    @elseif($slide->type === 'slide')
                        <div class="item">
                            <div class="main_owl_inner">
                                <div class="owl_main_info">
                                    <p class="desc">{{$slide->slide->description}}</p>
                                    <p class="title">{{$slide->slide->title}}</p>

                                </div>
                            </div>
                            <img src="{{asset('storage/user/images/slider/'.$slide->slide->image)}}" class="background">
                            <div class="main_owl_shadow"></div>
                        </div>
                    @endif
                @empty
                    <div class="item">
                        <div class="main_owl_inner">
                            <div class="owl_main_info">
                                <p class="desc">Don`t Miss Out</p>
                                <p class="title">New Battles Coming Soon</p>
                            </div>
                        </div>
                        <img src="{{asset('users_assets/images/battle/owl_background.png')}}" alt="The Last of us" class="background">
                        <div class="main_owl_shadow"></div>
                    </div>
                @endforelse
            </div>
            <div class="owl_left_handler">
                <button class="no_outline main_prev">
                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.99707 1L1.99707 9L9.99707 17" stroke="white" stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <div class="owl_right_handler">
                <button class="no_outline main_next">
                    <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.00293 17L9.00293 9L1.00293 1" stroke="white" stroke-width="2"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>



@endsection

