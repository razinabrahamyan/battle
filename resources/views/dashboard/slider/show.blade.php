@extends('dashboard.layouts.app', ['header' => $slider->title ])
@section('title')
@section('content')
    <div class="row">
        <div class="col-6 center">
            <div class="card card-profile">
                <img src="{{asset('storage/user/images/slider/' . $slider->image)}}" height="300px" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="text-center">
                        <h5 class="h3">
                            Title : {{$slider->title}}
                        </h5>
                        <h5 class="h3">
                           Country : {{$country}}
                        </h5>
                        <hr class="my-4">
                        <div class="h5 font-weight-300">
                            {{$slider->description}}
                        </div>
                    </div>
                </div>
                    <div class="text-center">
                        <div class="p-3 form_btn float-right">
                            <a class="btn btn-primary btn-info" href="{{route('slider.edit', $slider->id)}}">Edit</a>
                            <a class="btn btn-secondary" href="{{URL::previous()}}">Cancel</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop
