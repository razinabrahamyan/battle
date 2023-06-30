@extends('user_dashboard.layouts.single_app')
@section('title', 'Battles')
@section('navbar_title', 'Discover battles on battle zone')
@section('content')
    <div class="container-fluid">
        <div class="main_background">
            <div class="tags_part">
                <div class="players_tags_menu">
                    <div class="players_tag_search">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search Hashtag" class="no_outline" id="search_battle_hashtag" autocomplete="off">
                    </div>
                    <div id="no_result_desc"></div>
                    <div class="players_owl">
                        <div class="players_page_tags_owl owl-carousel">
                            <a href="{{route('battles','all')}}" class="category_tag_choose">
                                <div class="players_tag_div @if(!$current_category) active @endif">All</div>
                            </a>
                            @foreach($categories as $category)
                                <a href="{{route('battles',strtolower($category->title['en']))}}" class="category_tag_choose" data-name="{{strtolower($category->title['en'])}}">
                                    <div class="players_tag_div @if($current_category == $category->id) active @endif">{{$category->title['en']}}</div>
                                </a>

                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="live_battles_div pt-3 pb-4 " style="display: flex;flex-wrap: wrap;">
                @foreach($battles as $battle)
                    <div class="pl-3 pt-3">
                        @include('user_dashboard.includes.battle_card')
                    </div>

                @endforeach

            </div>
            <div class="players_desc">
                {{$battles->links()}}
            </div>

        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('.players_page_tags_owl').owlCarousel({
                margin:10,
                autoWidth:true,
            })
            let owls = $('.owl-item');
            let categories = $('.category_tag_choose')
            let no_result = $('#no_result_desc');

            $('#search_battle_hashtag').keyup(function () {
                let searched = $(this).val().toLowerCase();
                if (searched){
                    owls.addClass('hidden_tag');
                    no_result.empty();
                    let has = false;
                    categories.each(function (index,item) {
                        if($(item).data('name') && $(item).data('name').startsWith(searched)){
                            $(item).parent('.owl-item').removeClass('hidden_tag');
                            has = true;
                        }
                    })
                    if(!has){
                        console.log('nooooooooooooo')
                        no_result.html('<p>no such tags</p>')
                    }
                }else{
                    owls.removeClass('hidden_tag')
                }
            })
        })

    </script>
@endsection

