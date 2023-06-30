<div class="battle_card_item pl-3" >
    <div class="battle_relative">
        @if($battle->current_status === 'live')
            <div class="div_live">
                <span>Live</span>
            </div>

        @endif

        {{--<div class="battle_price">
            <div>
                @if(rand(1,2) === 1)
                    <img src="{{asset('storage/user/images/logo/golden_cup.png')}}" alt="">
                @else
                    <img src="{{asset('storage/user/images/logo/silver_cup.png')}}" alt="">
                @endif
            </div>
            <div class="vs_sign">5000$</div>
        </div>--}}
        <img class="vs_sign" src="/assets/img/brand/versus.png" alt="">

        <div class="card_main_users">
            <img src="{{asset('storage/user/images/avatar/'.$battle->request->creator->avatar)}}" alt="">
            <img src="@if($battle->request->answer === 'accepted'){{asset('storage/user/images/avatar/'.$battle->request->joiner->avatar)}}@else{{asset('storage/user/images/question_mark.png')}}@endif" alt="">
        </div>
    </div>
    <div class="pt-2 d-flex justify-content-between align-items-start">
        <div>
           <p class="battle_name">{{$battle->title}}</p>
            <p class="battle_users"><a class="carousel_channel_name " href="{{route('user.profile',$battle->request->creator->nickname)}}">{{$battle->request->creator->nickname}} </a>vs <a href="{{route('user.profile',$battle->request->joiner->nickname)}}" class="carousel_channel_name">{{$battle->request->joiner->nickname}}</a></p>
            @if($battle->current_status === 'live')
                <p class="battle_info">live for <span class="count_up" data-date="{{$battle->time}}">00:00:00</span></p>
            @elseif($battle->current_status === 'none' || $battle->current_status === 'creator' || $battle->current_status === 'joiner')
                <p class="battle_info orange">start in  <span class="count_down" data-date="{{$battle->start_date}}">00:00:00</span></p>
            @elseif($battle->current_status === 'ended')
                <p class="battle_info">lasted <span class="count_duration" data-start="{{$battle->time}}" data-end="{{$battle->end_date}}"></span></p>
            @endif


        </div>
        <div>
            @auth()
                @if(!isset($carousel_user) || !$carousel_user || $carousel_user != auth()->id() || ($carousel_user == auth()->id() && $type === 'subscribed'))
                    <button type="button"
                            @if(count($battle->reminder))class="notification_battle_icon no_outline chosen " data-toggle="tooltip" data-target="hover" data-placement="top" data-original-title="Reminder Already Set"
                            @else class="notification_battle_icon no_outline battle_card_reminder" data-battle="{{$battle->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Set Reminder"
                            @endif >
                        <i class="fa fa-bell"></i>
                    </button>
                @else

                @endif
            @else
                <button class="notification_battle_icon no_outline" data-toggle="modal" data-target="#loginModal">
                    <i class="fa fa-bell"></i>
                </button>
            @endauth


        </div>


    </div>
    <div class="d-flex justify-content-between view_battle">
        <span class="category_tag">{{$battle->category->title['en']}}</span>
        <a href="{{route('battle.show',$battle->id)}}">view battle</a>
    </div>

</div>
