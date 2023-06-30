<div class="player_main_card">
    <div class="player_card_header">
        <div class="player_card_player">
            <div>
                <img src="{{asset('storage/user/images/avatar/'.$user->avatar)}}" alt="" >
            </div>
            <div class="personal">
                <p class="name">{{$user->nickname}}</p>
                <p class="address">{{$user->city->city['en'].','.$user->country->country['en']}}</p>
                <div>
                    @foreach($categories as $category)
                        <span class="category_tag">{{$category->title['en']}}</span>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="player_card_stat">
            <div>
                <p>level</p>
                <p>10</p>
            </div>
            <div>
                <p>total battles</p>
                <p>{{$user->allBattlesCount}}</p>
            </div>
            <div>
                <p>battles won</p>
                <p>{{$user->wonBattlesCount}}</p>
            </div>
            <div>
                <p>battles lost</p>
                <p>{{$user->lostBattlesCount}}</p>
            </div>

        </div>

        <div>
            <div class="player_card_opener">
                <button class="btn player_card_open_button">
                    <i class="fa fa-angle-down"></i>
                </button>

            </div>
        </div>
    </div>


    <div class="player_card_footer">
        <div class="player_footer_buttons">
            <a class="btn deactivate_user" href="{{route('user.profile',$user->nickname)}}">Go To Profile</a>
            @if($user->id !== auth()->id())
                <a class="btn deactivate_user" href="{{route('battle.create').'?opponent='.$user->nickname}}">Challenge To Battle</a>
            @endif

        </div>
        <div class="player_card_recent">
            <p class="recent">Recent Battles</p>
            <div class="row pt-2">
                @if(count($battles))
                    @foreach($battles as $battle)
                        @include('user_dashboard.includes.battle_card')
                    @endforeach
                    <div class="view_all ml-3">
                        <a href="#" >View All Battles <i class="fa fa-arrow-right pl-2"></i> </a>
                    </div>
                @else
                    <div class="view_all ml-3">
                        <p>No Battles Yet</p>
                    </div>
                @endif


            </div>

        </div>
    </div>
</div>
