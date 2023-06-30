@extends('user_dashboard.layouts.single_app')
@section('title', 'Players')
@section('navbar_title', 'Discover players on battle zone')
@section('content')

        <div class="players_desc">
            <div class="players_menu">
                <div>
                    <p class="players_page_header">popular players on battle zone</p>
                </div>
                <div class="players_menu_conf">
                    <div>
                        <span class="players_conf_sort">Sort By</span>
                    </div>
                    <div>
                        <select   class="form-control"   >
                            <option  value="" >Ascending</option>
                            <option  value="" >Descending</option>
                            <option  value="" >Most Popular</option>
                        </select>
                    </div>
                    <div class="players_button_handler">
                        <button class="btn">Apply</button>
                    </div>
                    <div>
                        <form id="players_search_place">
                            <input type="text" name="input" class="input" id="players_search_input" placeholder="search..." >
                            <button type="reset" class="players_search" id="search_player_btn"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tags_part">
            <div class="players_tags_menu">
                <div class="players_tag_search">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Hashtag" class="no_outline">
                </div>
                <div class="players_owl">
                    <div class="players_page_tags_owl owl-carousel">
                        <div class="players_tag_div active">All</div>
                        @foreach($categories as $categorie)
                            <div class="players_tag_div">{{$categorie->title['en']}}</div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <div class="players_desc">
            <div class="players_bordered"></div>
        </div>

        <div class="players_desc pt-2">
            @foreach($players as $player)
                <x-player-battles user="{{$player->id}}"></x-player-battles>
            @endforeach
        </div>
        <div class="players_desc mt-4">
            {{$players->links()}}
        </div>

        <script>
            $(document).ready(function () {
                $('.player_card_open_button').click(function () {
                    let player_card = $(this).closest('.player_main_card');
                    if (player_card.hasClass('active')) {
                        player_card.removeClass('active')
                    } else {
                        $('.player_main_card').removeClass('active')
                        player_card.addClass('active')
                        console.log(player_card.offset().top)
                        console.log($(document).scrollTop())
                        if (player_card.offset().top < $(document).scrollTop()) {
                            $('html,body').animate({scrollTop: player_card.offset().top}, 1000);
                        }
                    }

                })
                $('.players_page_tags_owl').owlCarousel({
                    margin:10,
                    autoWidth:true,
                })
                let input = $('#players_search_input');
                let searchBtn = $('#search_player_btn');
                searchBtn.click(function () {
                    searchBtn.toggleClass('close_player')
                    input.toggleClass('square_player')
                })
            })
        </script>

@endsection

