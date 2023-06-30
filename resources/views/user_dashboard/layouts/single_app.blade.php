@extends('user_dashboard.layouts.main_app')
@section('nav')
    <div class="container-fluid">
        <div class="main_background ">
            <div class="main_nav col-12">
                <nav class="navbar navbar-expand-lg navbar-light nav_bordered" id="main_nav">

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <p class="navbar_title">@yield('navbar_title')</p>

                        <ul class="navbar-nav ml-auto p-0">
                            <li class="nav-item">
                                <div class="main_search_div ml-3" id="main_search_div">
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
                        </ul>
                        @include('user_dashboard.includes.app_auth')
                    </div>
                </nav>
            </div>
        </div>
    </div>

@endsection

