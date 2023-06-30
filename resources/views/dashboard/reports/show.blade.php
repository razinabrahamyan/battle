@extends('dashboard.layouts.app', ['header' => 'Report : ID - '.  $report->id])
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
                                    <h3 class="">{{$report->id}}</h3>
                                    <span class="description">ID</span>

                                </div>
                                <div>

                                    <h3 class="">{{$report->created_at}}</h3>
                                    <span class="description">date</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div>
                            <span class="description">Reporter</span>
                            <div class="mt-1">
                                <div>
                                    <a class="battle_show_user_image" href="{{route('users.show', $report->reporter->id)}}" data-toggle="tooltip" data-original-title="{{$report->reporter->nickname}}">
                                        <img src="{{asset('storage/user/images/avatar/'.$report->reporter->avatar)}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 ">
                        <div>
                            <span class="description">Reason</span>
                            <h3 class="">{{$report->reason->reason}}</h3>
                        </div>
                    </div>

                    <div class="mt-2 ">
                        <div>
                            <span class="description">Additional</span>
                            <h3 class="">{{$report->data['additional']}}</h3>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div>
                            <span class="description">Report on</span>
                            <div class="mt-1">
                                <div>
                                    <a class="battle_show_user_image " href="{{route('users.show', $report->reportable->id)}}" data-toggle="tooltip" data-original-title="{{$report->reportable->nickname}}">
                                        <img src="{{asset('storage/user/images/avatar/'.$report->reportable->avatar)}}" alt="">
                                    </a>
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

                            <a class="btn btn-secondary" href="{{URL::previous()}}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
