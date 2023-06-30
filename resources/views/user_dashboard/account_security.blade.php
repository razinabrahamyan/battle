@extends('user_dashboard.layouts.user_app')
@section('title', 'Battle')
@section('content')
    <div class="container-fluid ">
        <div class="col-12">
            <div class="col-12 account_security">
                <form action="#">
                    @csrf
                    <div class="form-group">
                        <div class="pt-3">
                            <p class="battle_profile_heading">Account Info</p>
                        </div>
                        <div class="col-12 pt-3">
                            <div class="row">
                                <div class="row mx-0 form-group">
                                    <div class="align-self-center input_label input_security">
                                        Email
                                    </div>
                                    <div class="row m-0 mr-5 flex-nowrap">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="First Name" value="{{auth()->user()->email}}">
                                        <button type="button" class="account_edit_button">
                                            <i class="far fa-edit"></i>
                                        </button>

                                    </div>
                                    <div class="d-flex mx-0 username_status">
                                        <div class="align-self-center">
                                            <div class="round_success">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="align-self-center pl-2">
                                            <span>Email Verified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mx-0 mr-5  form-group ">
                                    <div class="align-self-center input_label input_security">
                                        Password
                                    </div>
                                    <div class="row m-0  flex-nowrap">
                                        <input type="password" id="name" name="name" class="form-control" placeholder="First Name" >
                                        <button class="account_edit_button" type="button">
                                            <i class="far fa-edit"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{--<div class="border-div mt-5"></div>
                    <div class="form-group">
                        <div class="pt-3">
                            <p class="battle_profile_heading">Link Social Accounts</p>
                        </div>
                    </div>
                    <div class="border-div mt-5"></div>--}}

                    {{--<div class="form-group">
                        <div class="pt-3">
                            <p class="battle_profile_heading">Account Verification</p>
                        </div>
                    </div>
                    <div class="">
                        <button type="button" class="main_design">Upload Passport</button>
                        <p class="pt-1">You need to verify yourself in order to be eligible to battle other players</p>
                    </div>--}}
                    <div class="border-div mt-5"></div>
                    <div class="form-group">
                        <div class="pt-3">
                            <p class="battle_profile_heading">Deactivate or Delete Account</p>
                        </div>
                    </div>
                    <div class="">
                        <a type="button" href="{{route('user.deactivate')}}" class= "text-center deactivate_user">Deactivate Account</a>
                        <p class="pt-1">Deactivate your account, you can reactivate on your next log in</p>
                    </div>
                    <div class="">
                        <a type="button" href="{{route('user.delete')}}" class="delete_user text-center ">Delete Account</a>
                        <p class="pt-1">Deactivate your account, you can reactivate on your next log in</p>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
