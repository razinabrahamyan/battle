@extends('dashboard.layouts.app', ['header' => $battle->title])
@section('title' )
@section('content')
    <div class="row">
        <div class="col-12 center">
            <div class="card card-profile">
                <img src="../../assets/img/theme/img-1-1000x600.jpg" height="300px" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="row mt-3">
                        <div class="col">
                            <div class=" card-profile-stats p-0 d-flex justify-content-between col-12 col-md-5">
                                <div>
                                    <h3 class="">{{$battle->id}}</h3>
                                    <span class="description">ID</span>

                                </div>
                                <div>

                                    <h3 class="">{{$battle->gap}}</h3>
                                    <span class="description">gap</span>
                                </div>
                                <div>
                                    <h3 class="">{{$battle->status}}</h3>
                                    <span class="description">status</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-between col-12 col-md-5">
                                <div>
                                    <span class="heading">{{$battle->start_date}}</span>
                                    <span class="description">Start Date</span>
                                </div>
                                <div>
                                    <span class="heading">{{$battle->end_date}}</span>
                                    <span class="description">End Date</span>
                                </div>
                                <div>
                                    <span class="heading">{{$battle->rounds}}</span>
                                    <span class="description">Rounds</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div>
                            <span class="description">Title</span>
                            <h3 class="">{{$battle->title}}</h3>
                        </div>
                    </div>

                    <div class="mt-2 ">
                        <div>
                            <span class="description">Description</span>
                            <h3 class="">{{$battle->description}}</h3>
                        </div>
                    </div>

                    <div class="mt-2 ">
                        <div>
                            <span class="description">Verification</span>
                            @if($battle->verified === '0')
                                <h3 class="text-warning">Not verified</h3>
                            @else
                                <h3 class="text-success">Verified</h3>
                            @endif

                        </div>
                    </div>

                    <div class="mt-2 ">
                        <div>
                            <span class="description">Users</span>
                            <div class="d-flex mt-1">
                                <div>
                                    <a class="battle_show_user_image mx-auto" href="{{route('users.show', $battle->request->creator->id)}}" data-toggle="tooltip" data-original-title="{{$battle->request->creator->nickname}}">
                                        <img src="{{asset('storage/user/images/avatar/'.$battle->request->creator->avatar)}}" alt="">
                                    </a>
                                    <span class="description">creator</span>
                                </div>
                                <div class="ml-3">
                                    <a class="battle_show_user_image mx-auto" href="{{route('users.show', $battle->request->joiner->id)}}" data-toggle="tooltip" data-original-title="{{$battle->request->joiner->nickname}}">
                                        <img src="{{asset('storage/user/images/avatar/'.$battle->request->joiner->avatar)}}" alt="">
                                    </a>
                                    <span class="description">assignee</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class=" card-profile-stats">

                        </div>
                    </div>


                    <div class="text-center">
                        <div class="p-3 form_btn float-right">
                            <a class="btn btn-primary btn-info" href="{{route('battles.edit', $battle->id)}}">Edit</a>
                            <a class="btn btn-secondary" href="{{URL::previous()}}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
