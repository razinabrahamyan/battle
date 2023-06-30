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
                        <ul class="navbar-nav mt-2 mt-lg-0 user_dashboard_links pl-0 mr-auto">
                            <li class="nav-item pr-3 @if($page === 'public_profile') active @endif">
                                <a class="nav-link " href="{{route('front.public.profile')}}">@lang('messages.profile')</a>
                            </li>
                            <li class="nav-item pr-3 @if($page === 'dashboard') active @endif">
                                <a class="nav-link " href="{{route('front.dashboard')}}">Dashboard</a>
                            </li>

                            <li class="nav-item @if($page === 'basic') active @endif px-3">
                                <a class="nav-link" href="{{route('front.basic.info')}}">@lang('messages.basic_info')</a>
                            </li>

                            <li class="nav-item @if($page === 'security') active @endif px-3">
                                <a class="nav-link" href="{{route('front.account.security')}}">@lang('messages.security')</a>
                            </li>



                        </ul>
                        @include('user_dashboard.includes.app_auth')
                    </div>
                </nav>
            </div>
        </div>
    </div>

@endsection

