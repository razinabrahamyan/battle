@extends('dashboard.layouts.app')
@section('title', 'Admin Panel')
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h5 class="h3 mb-0">Notifications</h5>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        @forelse($admin_notification as $notification)
                            @if($notification->data['type'] === 'report')
                            <li class="list-group-item px-0">
                                <div class="row align-items-center checklist-item checklist-item-danger">
                                    <div class="col-auto  ">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                                        </a>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0">
                                            <a href="#!">Report</a>
                                        </h4>

                                        <small>{{$notification->data['data']['title']}}</small>
                                    </div>
                                    <div class="col-auto">
                                        <small>{{\Carbon\Carbon::parse($notification->created_at)->format('d-M-Y  H:i')}}</small>
                                    </div>
                                </div>
                            </li>
                            @elseif($notification->data['type'] === 'battle_request')
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center checklist-item checklist-item-danger">
                                        <div class="col-auto ">
                                            <!-- Avatar -->
                                            <a href="#" class="avatar rounded-circle">
                                                <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                                            </a>
                                        </div>
                                        <div class="col ml--2">
                                            <h4 class="mb-0">
                                                <a href="#">Report</a>
                                            </h4>

                                            <small>{{$notification->data['data']['title']}}</small>
                                        </div>
                                        <div class="col-auto">

                                        </div>
                                    </div>
                                </li>
                            @endif
                        @empty
                        @endforelse


                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
