@extends('dashboard.layouts.app', ['header' => ucfirst($admin->role->name) . ' - ' .  $admin->full_name['first_name']])
@section('title' , $admin->full_name['first_name'])
@section('content')
    <div class="row">
        <div class="col-12 center">
            <div class="card card-profile">
                <img src="../../assets/img/theme/img-1-1000x600.jpg" height="300px" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{asset('storage/admin/admin_avatars/' . $admin->avatar)}}" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                        <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading">22</span>
                                    <span class="description">Friends</span>
                                </div>
                                <div>
                                    <span class="heading">10</span>
                                    <span class="description">Photos</span>
                                </div>
                                <div>
                                    <span class="heading">89</span>
                                    <span class="description">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h4>
                            Role: {{ucfirst($admin->role->name)}}
                        </h4>
                        <h5 class="h3">
                            {{$admin->full_name['first_name']}} {{$admin->full_name['last_name']}} {{$admin->full_name['middle_name']}}
                        </h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{$admin->country->country['en']}}, {{$admin->state->state['en']}},  {{$admin->city->city['en']}}
                        </div>
                        <div>
                            Email: {{$admin->email}}
                        </div>
                        <div class=" mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>@if($admin->additional){{$admin->additional['en']}}@endif
                        </div>
                        <div class="p-3 form_btn float-right">
                            <a class="btn btn-primary btn-info" href="{{route('admins.edit', $admin->id)}}">Edit</a>
                            <a class="btn btn-secondary" href="{{URL::previous()}}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
