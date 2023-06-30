@extends('user_dashboard.layouts.app')
@section('title', 'Categories')
@section('content')
    <div class="container-fluid">
        <div class="main_background">
            {{---------------------------------------------------------  Topics you might like -----------------------------------------------------------}}
            <div class="live_battles_div pt-4 pb-4">
                <div class="d-flex live_battle_headers col-12 ">
                    <div class="category_head">
                        <p class="font-weight-bold">Categories</p>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="d-flex flex-wrap category_page mt-3 mb-5">
                    @foreach($categories as $category)
                        <a href="{{route('battles',strtolower($category->title['en']))}}">
                            <div style="{{$category->style}}" class="cat_card ml-3">
                                <div class="text-center ">
                                    {!!$category->svg!!}
                                </div>
                                <p class="card_category_name">{{$category->title['en']}}</p>
                            </div>
                        </a>

                    @endforeach
                </div>
            </div>
            <div class="col-12">
                <div class="border-div"></div>
            </div>
        </div>
    </div>
@endsection
