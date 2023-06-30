@extends('user_dashboard.layouts.recover_app')
@section('title', 'Battle')
@section('content')
    <div class="container-fluid ">
        <div class="col-12">
            <div class="col-12 account_security">
                <form action="#">
                    @csrf

                    <div class="form-group">
                        <div class="pt-3">
                            <p class="battle_profile_heading">Activate Account</p>
                        </div>
                    </div>
                    <div class="">
                        <a type="button" href="{{route('user.activate')}}" class= "text-center activate_user">Activate Account</a>
                        <p class="pt-1">Activate your account, you can deactivate later</p>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
