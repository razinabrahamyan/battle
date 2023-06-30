<div class="battle_page_pad">
    <div class="battle_pad_player flex-wrap">
        <div class="battle_pad_prof">
            <img src="{{asset('storage/user/images/avatar/'.$battle->request->creator->avatar)}}" alt="">
            <div class="pl-3">
                <p class="name">{{$battle->request->creator->nickname}}</p>
                <p class="address">{{$battle->request->creator->city && $battle->request->creator->country ? $battle->request->creator->city->city['en'].','.$battle->request->creator->country->country['en']:''}}</p>
            </div>
        </div>
        @auth()
            @if(auth()->id() !== $battle->request->joiner->id && auth()->id() !== $battle->request->creator->id)
                <div class="battle_pad_buttons pl-3">
                    <div class="dropdown">
                        <button class="btn " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item report_dropdown_button" data-toggle="modal" data-user="{{$battle->request->creator->id}}" data-target="#reportModal">Report</button>
                        </div>
                    </div>

                    <div class="position-relative" id="first_player_heart">
                        <button class="px-2 btn @if($reaction_first) chosen @endif " id="first_player_emoji_value">
                            @if($reaction_first)
                                &#{{$reaction_first->emoji->code}};
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="19.748" height="18" viewBox="0 0 19.748 18">
                                    <g id="Add_to_Favorite" data-name="Add to Favorite" transform="translate(-0.55 -0.5)" fill="none">
                                        <path d="M2.244,2.189a5.755,5.755,0,0,0,0,8.155l8.18,8.156,8.18-8.156a5.775,5.775,0,0,0-8.18-8.155A5.8,5.8,0,0,0,2.244,2.189Z" stroke="none"/>
                                        <path d="M 6.334162712097168 1.999992370605469 C 5.189072608947754 1.999992370605469 4.112743377685547
                            2.444381713867188 3.303432464599609 3.25133228302002 C 2.495323181152344 4.057042121887207 2.050283432006836
                             5.127962112426758 2.05029296875 6.266812324523926 C 2.05029296875 7.405652046203613 2.495332717895508 8.476542472839355
                             3.303442001342773 9.282241821289063 L 10.42398071289063 16.3818187713623 L 17.54477310180664 9.282232284545898
                             C 18.35285186767578 8.476542472839355 18.79788208007813 7.405641555786133 18.7978630065918 6.26682186126709 C
                             18.79784202575684 5.127971649169922 18.3527717590332 4.057071685791016 17.54459381103516 3.251321792602539 C
                             16.73527336120605 2.444392204284668 15.65892219543457 1.999992370605469 14.51382255554199 1.999992370605469 C
                             13.36871337890625 1.999992370605469 12.29237270355225 2.444392204284668 11.48306274414063 3.251321792602539 L
                             10.42395305633545 4.307321548461914 L 9.364852905273438 3.251312255859375 C 8.555572509765625 2.444381713867188
                             7.479252815246582 1.999992370605469 6.334162712097168 1.999992370605469 M 6.33416748046875 0.4999961853027344 C
                             7.814390182495117 0.4999961853027344 9.294608116149902 1.063032150268555 10.42396259307861 2.189102172851563 C
                             11.55335807800293 1.063032150268555 13.03359031677246 0.4999961853027344 14.51382255554199 0.4999961853027344 C
                             15.99405479431152 0.4999961853027344 17.47428703308105 1.063032150268555 18.60368347167969 2.189102172851563 C
                             20.86256217956543 4.44115161895752 20.86256217956543 8.092452049255371 18.60385322570801 10.34446239471436 L
                             10.42396259307861 18.50000190734863 L 2.244342803955078 10.34446239471436 C -0.01439666748046875 8.092452049255371
                             -0.01439666748046875 4.44115161895752 2.244342803955078 2.189102172851563 C 3.37371826171875 1.063032150268555
                             4.853945732116699 0.4999961853027344 6.33416748046875 0.4999961853027344 Z" stroke="none" fill="#fff"/>
                                    </g>
                                </svg>
                            @endif

                        </button>
                        <div class="emojis_handler animate__animated" id="first_emoji_handler">
                            <div class="d-flex emojis">
                                @foreach($emojis as $emoji)
                                    <div class="@if($reaction_first && $reaction_first->emoji->id === $emoji->id) chosen @else inactive @endif" data-id="{{$emoji->id}}" data-user="{{$battle->request->creator->id}}">
                                        &#{{$emoji->code}};
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="px-2">

                        <button data-align="left" @if($has_voted)
                        disabled
                                @if($has_voted->player_id === $battle->request->creator->id)
                                class="transparent_button vote_flag active"
                                @else
                                class="transparent_button vote_flag inactive"
                                @endif

                                @else
                                class="transparent_button vote_flag"
                                @endif id="left_vote_button" data-user="{{$battle->request->creator->id}}">
                            <i class="fa fa-flag"></i>
                        </button>

                    </div>
                </div>
            @endif

        @endauth

    </div>
    @if(true)
        <div class="battle_pad_player ">
            @auth()
                @if(auth()->id() !== $battle->request->joiner->id && auth()->id() !== $battle->request->creator->id)
                    <div class="battle_pad_buttons pr-3">
                        <div class="px-2">
                            <button data-align="right"   @if($has_voted)
                            disabled
                                    @if($has_voted->player_id === $battle->request->joiner->id)
                                    class="transparent_button vote_flag active"
                                    @else
                                    class="transparent_button vote_flag inactive"
                                    @endif

                                    @else
                                    class="transparent_button vote_flag"
                                    @endif id="right_vote_button" data-user="{{$battle->request->joiner->id}}">
                                <i class="fa fa-flag" ></i>
                            </button>
                        </div>
                        <div class="position-relative" id="second_player_heart">
                            <button class=" btn @if($reaction_second) chosen @endif "  id="second_player_emoji_value">
                                @if($reaction_second)
                                    &#{{$reaction_second->emoji->code}};
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.748" height="18" viewBox="0 0 19.748 18">
                                        <g id="Add_to_Favorite" data-name="Add to Favorite" transform="translate(-0.55 -0.5)" fill="none">
                                            <path d="M2.244,2.189a5.755,5.755,0,0,0,0,8.155l8.18,8.156,8.18-8.156a5.775,5.775,0,0,0-8.18-8.155A5.8,5.8,0,0,0,2.244,2.189Z" stroke="none"/>
                                            <path d="M 6.334162712097168 1.999992370605469 C 5.189072608947754 1.999992370605469 4.112743377685547
                            2.444381713867188 3.303432464599609 3.25133228302002 C 2.495323181152344 4.057042121887207 2.050283432006836
                             5.127962112426758 2.05029296875 6.266812324523926 C 2.05029296875 7.405652046203613 2.495332717895508 8.476542472839355
                             3.303442001342773 9.282241821289063 L 10.42398071289063 16.3818187713623 L 17.54477310180664 9.282232284545898
                             C 18.35285186767578 8.476542472839355 18.79788208007813 7.405641555786133 18.7978630065918 6.26682186126709 C
                             18.79784202575684 5.127971649169922 18.3527717590332 4.057071685791016 17.54459381103516 3.251321792602539 C
                             16.73527336120605 2.444392204284668 15.65892219543457 1.999992370605469 14.51382255554199 1.999992370605469 C
                             13.36871337890625 1.999992370605469 12.29237270355225 2.444392204284668 11.48306274414063 3.251321792602539 L
                             10.42395305633545 4.307321548461914 L 9.364852905273438 3.251312255859375 C 8.555572509765625 2.444381713867188
                             7.479252815246582 1.999992370605469 6.334162712097168 1.999992370605469 M 6.33416748046875 0.4999961853027344 C
                             7.814390182495117 0.4999961853027344 9.294608116149902 1.063032150268555 10.42396259307861 2.189102172851563 C
                             11.55335807800293 1.063032150268555 13.03359031677246 0.4999961853027344 14.51382255554199 0.4999961853027344 C
                             15.99405479431152 0.4999961853027344 17.47428703308105 1.063032150268555 18.60368347167969 2.189102172851563 C
                             20.86256217956543 4.44115161895752 20.86256217956543 8.092452049255371 18.60385322570801 10.34446239471436 L
                             10.42396259307861 18.50000190734863 L 2.244342803955078 10.34446239471436 C -0.01439666748046875 8.092452049255371
                             -0.01439666748046875 4.44115161895752 2.244342803955078 2.189102172851563 C 3.37371826171875 1.063032150268555
                             4.853945732116699 0.4999961853027344 6.33416748046875 0.4999961853027344 Z" stroke="none" fill="#fff"/>
                                        </g>
                                    </svg>
                                @endif
                            </button>
                            <div class="emojis_handler animate__animated" id="second_emoji_handler">
                                <div class="d-flex emojis">
                                    @foreach($emojis as $emoji)
                                        <div class="@if($reaction_second && $reaction_second->emoji->id === $emoji->id) chosen @endif" data-id="{{$emoji->id}}" data-user="{{$battle->request->joiner->id}}">
                                            &#{{$emoji->code}};
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>


                        <div class="dropdown">
                            <button class="btn " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item report_dropdown_button" data-toggle="modal" data-target="#reportModal" data-user="{{$battle->request->joiner->id}}">Report</button>
                            </div>
                        </div>


                    </div>
                @endif
            @endauth
            <div class="battle_pad_prof opponent_player ">
                <div class="pr-3">
                    <p class="name" id="second_player_name">{{$battle->request->answer === 'accepted' ?$battle->request->joiner->nickname:''}}</p>
                    <p class="address" id="second_player_address">{{$battle->request->answer === 'accepted' ?$battle->request->joiner->city->city['en'].','.$battle->request->joiner->country->country['en']:''}}</p>
                </div>
                @if($battle->request->answer === 'accepted')
                    <img id="second_player_image" src="{{asset('storage/user/images/avatar/'.$battle->request->joiner->avatar)}}" alt="">
                @endif

            </div>
        </div>
    @endif
</div>
