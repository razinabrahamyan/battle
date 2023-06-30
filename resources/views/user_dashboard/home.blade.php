@extends('user_dashboard.layouts.home_app')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            <div class="border m-2 p-2 current_apy">asd</div>
            <div class="border m-2 p-2 circulating_tdot">asd</div>
            <div class="border m-2 p-2 current_tvl">asd</div>
            <div class="border m-2 p-2 tdot_volume">asd</div>

        </div>
        <div class="main_background">
            <div class="live_battles_div pt-3 pb-4">

                {{--<div class="d-flex live_battle_headers col-12 ">
                    <div>
                        <p class="font-weight-bold">Sponsored Battles </p>
                    </div>
                    <div>
                        <button class="btn no_outline" id="sponsored_prev"><i class="fa fa-angle-left"></i></button><button class="btn mr-3 no_outline" id="sponsored_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>

                <div class=" mt-3 pl-3 sponsored_battles owl-carousel custom-carousel" id="battle_sponsored_carousel">
                    <x-sponsored-carousel></x-sponsored-carousel>
                </div>--}}
                @auth()
                    <div class="d-flex live_battle_headers col-12 ">
                        <div>
                            <p class="font-weight-bold">Trending Battles Based On Your Followings</p>
                        </div>
                        <div class="carousel_arrows_handler">
                            <button class="btn no_outline" id="trending_prev"><i class="fa fa-angle-left"></i></button>
                            <button class="btn mr-3 no_outline" id="trending_next"> <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>

                    <div class="owl-carousel mt-3  custom-carousel" id="battle_trending_carousel">
                        <x-carousel trending="1"></x-carousel>
                    </div>

                @endauth

                @foreach($trending_categories as $category)
                    <div class="d-flex live_battle_headers col-12 ">
                        <div>
                            <p class="font-weight-bold">Trending Battles In {{$category['name']}}</p>
                        </div>
                        <div class="carousel_arrows_handler">
                            <button class="btn no_outline" id="{{$category['name']}}_prev"><i class="fa fa-angle-left"></i></button>
                            <button class="btn mr-3 no_outline" id="{{$category['name']}}_next"> <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                    <div class="owl-carousel mt-3 custom-carousel" id="battle_{{$category['name']}}_carousel">
                        <x-carousel category="{{$category['id']}}"></x-carousel>
                    </div>
                @endforeach


                <div class="d-flex live_battle_headers col-12 ">
                    <div>
                        <p class="font-weight-bold">Categories To Explore</p>
                    </div>
                    <div class="carousel_arrows_handler">
                        <button class="btn no_outline" id="category_prev"><i class="fa fa-angle-left"></i></button>
                        <button class="btn mr-3 no_outline" id="category_next"> <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                <div class="owl-carousel mt-3 custom-carousel"  id="battle_category_carousel">
                    @foreach($categories as $category)
                        <a href="{{route('battles',strtolower($category->title['en']))}}">
                            <div style="{{$category->style}}" class="cat_card ml-3">
                                <div class="text-center category_page ">
                                    {!!$category->svg!!}
                                </div>
                                <p class="card_category_name">{{$category->title['en']}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="border-div "></div>
            </div>
        </div>
    </div>

    <script src="{{asset('users_assets/js/battle_carousel.js')}}"></script>
    <script>
        $(document).ready(function() {
            let count = parseInt("{{count($slider)}}");
            let loop = count > 1;
            makeBattleCarousels();
            let main_owl = $("#owl_main")
            main_owl.owlCarousel({
                autoplay:true,
                slideSpeed : 1000,
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                autoplaySpeed : 1000,
                dotsSpeed : 1000,
                smartSpeed:5000,
                fluidSpeed:1000,
                navSpeed:1000,
                dragEndSpeed: 1000,
                dots:true,
                loop:loop,
                items : 1,
                itemsDesktop : false,
                itemsDesktopSmall : false,
                itemsTablet: false,
                itemsMobile : false

            });
            $('.main_prev').click(function () {
                main_owl.trigger('prev.owl.carousel',[1000]);
            });
            $('.main_next').click(function () {
                main_owl.trigger('next.owl.carousel',[1000]);
            });
        });
    </script>
    <script>

        const urls = {
            tdot: "https://api.taigaprotocol.io/rewards/apr?network=acala&pool=0",
            "3usd":
                "https://api.taigaprotocol.io/rewards/apr?network=karura&pool=1",
            taiksm:
                "https://api.taigaprotocol.io/rewards/apr?network=karura&pool=0",
        };

        const getResult = async (urls) => {
            let result = {
                tdot: 0,
                "3usd": 0,
                taiksm: 0,
            };

            try {
                for (ukey in urls) {
                    await fetch(urls[ukey])
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {

                            for (dkey in data) {
                                result[ukey] += Number((data[dkey] * 100));
                            }
                            return result;
                        })
                        .then((result) => {
                            let element = document.querySelector(`.calc_${ukey}`);
                            if(element){
                                element.innerText = `${result[ukey].toFixed(2)} %`;
                            }

                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            } catch (error) {
                console.error(error);
            }
            console.log(result, 'result')
            return result;
        };
        const TDOT_URL = 'https://api.taigaprotocol.io/protocol/tapio/stats';
        const connect_keys = {
            current_apy: {
                link: 'apr',
                type: 'percent'
            },
            circulating_tdot: {
                link: 'supply',
                type: 'number'
            },
            current_tvl: {
                link: 'tvl',
                type: 'money'
            },
            tdot_volume: {
                link: 'rewardsUsd',
                type: 'money'
            }
        };
        const setValues = async () =>{
            try {
                await fetch(TDOT_URL)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        Object.entries(connect_keys).forEach(([index,value])=> {
                            let obj = data[value.link];
                            let result;
                            if(obj){
                                result = 0
                                if(typeof obj === 'object'){
                                    for (obj_key in obj) {
                                        result += Number((obj[obj_key] * 100));
                                    }
                                }else if(typeof obj === 'number'){
                                    result = obj;
                                }
                                let element = document.querySelector(`.${index}`);
                                if(element){
                                    switch (value.type){
                                        case 'money':
                                            result = makeNumber(result.toFixed(0),true);
                                            break;
                                        case 'number':
                                            result = makeNumber(result.toFixed(0),false);
                                            break;
                                        case 'percent':
                                            result = result.toFixed(2) + '%';
                                            break;
                                    }
                                    element.innerText = result;
                                }

                            }
                            console.log(value,index,data[value.link], typeof data[value.link])
                        })
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            } catch (error) {
                console.error(error);
            }
        }
        setValues()
        function makeNumber(value, with_sign = false) {
            value += ''
            value = value.replace(/\D/g, '')
            if (value[0] === '0') {
                value = value.substr(1, value.length);
            }
            let result = '';
            let check = true;
            while (check) {
                if (value.length > 3) {
                    result = ',' + value.substr(value.length - 3, 3) + result;
                    value = value.substr(0, value.length - 3)
                } else {
                    result = value + result;
                    check = false;
                }
            }
            if(with_sign){
                if(result.length){
                    result =  '$' + result
                }else{
                    result = '$0'
                }
            }
            return result;
        }
        console.log(makeNumber(659875, true),'makemake')
        getResult(urls);
    </script>
@endsection
