<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" value="{{$errors->login}}" id="login_errors">
    <input type="hidden" value="{{$errors->register}}" id="register_errors">
    <input type="hidden" value="{{$errors}}" id="match_error">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="mx-auto">
                    <img src="/assets/img/brand/logo.svg">
                </div>

            </div>
            <div class="modal-body">
                <div class="col-12">
                    <ul class="nav nav-tabs border-0">
                        <li class="active col-6 px-0 auth_modal_li pb-1"><a class="auth_modal_clickable" data-toggle="tab" href="#login">Log In</a></li>
                        <li class="col-6 px-0 text-right  auth_modal_li pb-1">
                            <a id="register_button" class="auth_modal_clickable" data-toggle="tab"  href="#register">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div id="login" class="tab-pane active">
                            <form method="POST" action="{{route('login')}}" class="form pt-3">
                                @csrf
                                <div class="form-group mb-2" id="login_part_handler">
                                    <label for="email" class="mb-1">Username or email</label>
                                    <input type="text"
                                           class="form-control {{$errors->login->has('email') || $errors->has('match') ? 'is-invalid' : ''}}"
                                           @if($errors->login->any())
                                           value="{{old('email')}}"
                                           @endif id="email" name="email">
                                    @if($errors->login->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->login->first('email') }}
                                        </div>
                                    @endif
                                    @error('match')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="password" class="mb-1">Password</label>
                                    <input type="password" class="form-control {{$errors->login->has('password') ? 'is-invalid' : ''}}" id="password" name="password" >
                                    @if($errors->login->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->login->first('password') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <a href="" class="text-white">
                                        Forgot your password?
                                    </a>
                                </div>

                                <button type="submit" class="btn btn-default">Log In</button>
                            </form>
                            <div class="modal_line">
                                <div class="modal_or_div">or</div>
                            </div>
                            <div class="mt-4">
                                <button type="button" class="btn facebook_login">Log In with facebook</button>
                            </div>
                        </div>


                        <div id="register" class="tab-pane">
                            <form method="POST" action="{{route('register')}}" class="form pt-3">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="reg_email" class="mb-1">Email</label>
                                    <input type="email" class="form-control {{$errors->register->has('email') ? 'is-invalid' : ''}}"
                                           @if($errors->register->any())
                                           value="{{old('email')}}"
                                           @endif  id="reg_email" name="email" required>
                                    @if($errors->register->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->register->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-2">
                                    <label for="register_password">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control modal_password {{$errors->register->has('password') ? 'is-invalid' : ''}}"
                                               type="password" name="password" id="register_password" required>
                                        <div class="input-group-addon {{$errors->register->has('password') ? 'is-invalid' : ''}}">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @if($errors->register->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->register->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control modal_password {{$errors->register->has('password_confirmation') ? 'is-invalid' : ''}}"
                                               type="password" name="password_confirmation" id="password_confirmation" required>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @if($errors->register->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->register->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-1"> Date of Birth</label>
                                </div>
                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="custom_arrow_down">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <select id="reg_month" type="text" name="month" class="form-control" required>
                                            <option value="" selected disabled>Month</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="custom_arrow_down">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <select id="reg_day" type="text" name="day" class="form-control" required>
                                            <option value="" selected disabled>Day</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="custom_arrow_down">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <select id="reg_year" type="text" name="year" class="form-control" required>
                                            <option value="" selected disabled>Year</option>

                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-1"> Address</label>
                                </div>
                                <div class="form-row">
                                    <div class="col-12 mb-2">
                                        <div class="custom_arrow_down">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <select id="reg_country" type="text" name="country" class="form-control" required>
                                            <option value="" selected disabled>Country</option>
                                            @guest()
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country['en']}}</option>
                                                @endforeach
                                            @endguest

                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom_arrow_down">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <select id="reg_state" type="text" name="state" class="form-control" required>
                                            <option value="" selected disabled>State</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom_arrow_down">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <select id="reg_city" type="text" name="city" class="form-control" required>
                                            <option value="" selected disabled>City</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group mt-3">
                                    <label for="reg_username" class="mb-1">Nickname</label>
                                    <input type="text" class="form-control {{$errors->register->has('username') ? 'is-invalid' : ''}}"
                                           @if($errors->register->any())
                                           value="{{old('username')}}"
                                           @endif id="reg_username" name="username" required>
                                    @if($errors->register->has('username'))
                                        <div class="invalid-feedback">
                                            {{ $errors->register->first('username') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mt-3">
                                    <label class="container_checkbox d-flex align-items-center">
                                        <input type="checkbox" required id="terms_and_conditions" name="terms" @if(old('terms')) checked @endif>
                                        <span class="checkmark"></span>
                                        <div class="agreement_text pl-1">I have read the Terms and Conditions</div>

                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="container_checkbox d-flex align-items-center">
                                        <input type="checkbox"  id="is_player" name="is_player" @if(old('is_player')) checked @endif>
                                        <span class="checkmark"></span>
                                        <div class="agreement_text pl-1">I want to become a player</div>

                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default mt-4" id="signup_button">Sign Up</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer border-0">
            </div>
        </div>
    </div>
</div>
