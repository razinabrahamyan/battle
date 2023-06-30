@extends('layouts.app')

@section('content')
    <body class="bg-default">
    <div class="d-flex position-fixed admin_login_header justify-content-end">
        <div class="col-lg-1">
            <div class="dropdown">
                <a href="#" class="btn btn-default dropdown-toggle login_header_link" data-toggle="dropdown" id="navbarDropdownMenuLink2">
                         <span class="avatar avatar-sm rounded-circle">
                            <img alt="" src="{{asset('static/flags/'.app()->getLocale().'.png')}}">
                          </span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                    @foreach(config('app.languages') as $lang)
                        @if($lang !== app()->getLocale())
                            <li>
                                <a href="{{route('set.locale', $lang)}}" class="dropdown-item">
                                    <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img alt="" src="{{asset("static/flags/$lang.png")}}">
                                            </span>
                                        <div class="media-body ml-2 d-none d-block">
                                                <span class="mb-0 text-sm  font-weight-bold">
                                                    @if($lang == 'en')
                                                        English
                                                    @elseif($lang == 'ru')
                                                        Русский
                                                    @elseif($lang == 'am')
                                                        Հայերեն
                                                    @endif
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Welcome Ubattle!</h1>
                            <p class="text-lead text-white"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                     xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

        <!-- Page content -->

        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                            <div class="btn-wrapper text-center">
                                <a href="#" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src=""></span>
                                    <span class="btn-inner--text">Github</span>
                                </a>
                                <a href="#" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src=""></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Or sign in with credentials</small>
                            </div>
                            <form role="form" method="POST" action="{{ route('admin.login.post') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83" aria-hidden="true"></i></span>
                                        </div>
                                        <input class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email') }}" name="email"  placeholder="Email" type="email">

                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="Password" type="password">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for=" customCheckLogin">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="#" class="text-light"><small>Forgot password?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#" class="text-light"><small>Create new account</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
