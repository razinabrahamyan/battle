@extends('user_dashboard.layouts.app')
@section('title', 'Battle')
@section('content')
    @include('user_dashboard.includes.battle_pad')

    <div class="live_battle_main d-flex mt-3">

        <div class="opened_chat p-0" id="battles_flexible_desc">
            <div id="battle_video_div">
                <div class="battle_header mb-4 mx-2">
                    <div class="battle_sponsors">
                        <p>This Battle is Sponsored By:</p>

                        <span>
                                    <img src="{{asset('storage/user/images/sponsor_logos/red_bull_logo.png')}}" alt="">
                                </span>
                        <span>
                                    <img src="{{asset('storage/user/images/sponsor_logos/pepsi_logo.png')}}" alt="">
                                </span>
                        <span>
                                    <img
                                        src="{{asset('storage/user/images/sponsor_logos/coca_cola_logo.png')}}" alt="">
                                </span>

                    </div>
                    <div class="battle_live_price">
                        <span><img src="{{asset('storage/user/images/logo/golden_cup_1.png')}}" alt=""></span>
                        <p>Prize Pool: 5000$</p>
                    </div>
                </div>
                <div>
                    <div id="videos_place">
                        <div class="d-flex w-100 position-relative live_videos" id="live_videos">
                            <div id="videoBig" class="col-6 p-0 video_player  {{$battle->request->creator->nickname}} position-relative" >
                                <video id="videoOutput" @if($battle->current_status === 'ended') @endif autoplay muted width="100%" height="690px"
                                        poster="{{asset('users_assets/images/battle/battle_blue.png')}}">
                                    @if($battle->current_status === 'live')
                                        <source type="application/dash+xml"  src="{{$playback.$battle->request->creator->nickname.'_'.$battle->id.'.mpd'}}"  >
                                    @elseif($battle->current_status === 'ended')
                                        <source type="video/mp4"  src="{{'https://battle.zone/vod/'.$battle->request->creator->nickname.'_'.$battle->id.'.mp4'}}"  >
                                        {{--<source type="video/mp4"  src="{{asset('videos/videoplayback.mp4')}}"  >--}}
                                    @endif
                                </video>
                                <div class="live_emotions_left">
                                    <div class="hearts flying" id="flying_smiles_left">
                                    </div>
                                </div>
                                {{--<div class="video_username">
                                    {{$battle->request->creator->nickname}}
                                </div>
                                <span class="pulse_turn pulse_round_view pulse_creator" ></span>--}}
                                <div class="volume_status_handler left">
                                    <i class="fa fa-volume-mute mute"></i>
                                    <i class="fa fa-volume-up" ></i>
                                </div>
                            </div>
                            <div id="videoSmall" class="draggable col-6 p-0 video_player position-relative {{$battle->request->joiner->nickname}}">
                                <video  id="videoInput" @if($battle->current_status === 'ended') @endif autoplay muted   width="100%" height="690px"
                                       poster="{{asset('users_assets/images/battle/battle_red.png')}}">
                                    @if($battle->current_status === 'live')
                                        <source type="application/dash+xml" src="{{$playback.$battle->request->joiner->nickname.'_'.$battle->id.'.mpd'}}" >
                                    @elseif($battle->current_status === 'ended')
                                        <source type="video/mp4"  src="{{'https://battle.zone/vod/'.$battle->request->joiner->nickname.'_'.$battle->id.'.mp4'}}"  >
                                        {{--<source type="video/mp4"  src="{{asset('videos/videoplayback.mp4')}}"  >--}}
                                    @endif

                                </video>
                                <div class="volume_status_handler right muted">
                                    <i class="fa fa-volume-mute mute" ></i>
                                    <i class="fa fa-volume-up" ></i>
                                </div>

                                <div class="live_emotions">
                                    <div class="hearts flying" id="flying_smiles_right">
                                    </div>
                                </div>
                                {{--<div class="video_username">
                                    {{$battle->request->joiner->nickname}}
                                </div>
                                <span class="pulse_turn pulse_round_view pulse_joiner"></span>--}}
                            </div>
                            <div class="chat_open_handler">
                                <i class="fa fa-comment"></i>
                            </div>
                            <div class="battle_timer_desc">
                            </div>
                            @if($battle->current_status !== 'ended')
                                <div class="animation_text">
                                    <div class="animation_message_place">
                                    </div>
                                </div>
                            @endif

                                <div id="video_settings">
                                    @if($battle->current_status === 'ended' || $battle->current_status === 'live' || true)
                                        @if($battle->current_status === 'ended' || true)
                                            <div id="pause_handler">
                                                <div class="pause_part">
                                                    <svg id="player_pause" xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18">
                                                        <g  transform="translate(-21.75 -19.943)">
                                                            <g  data-name="Group 9197">
                                                                <line id="Line_468" data-name="Line 468" y2="18" transform="translate(24.25 19.943)" fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="5"/>
                                                                <line id="Line_469" data-name="Line 469" y2="18" transform="translate(35.25 19.943)" fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="5"/>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="play_part">
                                                    <svg id="player_play" viewBox="0 0 17.804 17.804" fill="#fff">
                                                        <g id="c98_play">
                                                            <path d="M2.067,0.043C2.21-0.028,2.372-0.008,2.493,0.085l13.312,8.503c0.094,0.078,0.154,0.191,0.154,0.313
                                                    c0,0.12-0.061,0.237-0.154,0.314L2.492,17.717c-0.07,0.057-0.162,0.087-0.25,0.087l-0.176-0.04
                                                    c-0.136-0.065-0.222-0.207-0.222-0.361V0.402C1.844,0.25,1.93,0.107,2.067,0.043z"/>
                                                        </g>


                                                    </svg>
                                                </div>


                                            </div>
                                        @endif

                                        {{--<div class="pr-2 d-flex ml-1" id="volume_handler">
                                            <div id="volume_icon_handler">
                                                <i class="fa fa-volume-mute volume_icon"></i>
                                            </div>
                                            <div id="volume_input_handler">
                                                <input type="range" min="0" step="1" max="100" value="0" id="volume_input" class="ml-1">
                                            </div>
                                        </div>--}}
                                        @if($battle->current_status === 'ended')
                                           {{-- <div id="track_handler">
                                                <div id="track_hover_time">

                                                </div>
                                                <input type="range" min="0" id="track" value="0" step="1">
                                            </div>
                                            <div class="pl-2" id="video_time">
                                                00:00
                                            </div>--}}

                                        @endif
                                        <div class="battle_settings_handler">
                                            <div class="div_live_battle">
                                                <span>Live</span>
                                            </div>
                                            <div class="settings_icon_handler">
                                                <svg id="video_settings_icon" width="18" height="18.005" viewBox="0 0 18 18.005">
                                                    <path id="Icon_ionic-ios-settings" data-name="Icon ionic-ios-settings" d="M21.014,13.5A2.316,2.316,0,0,1,22.5,11.339a9.181,9.181,0,0,0-1.111-2.677,2.347,2.347,0,0,1-.942.2,2.311,2.311,0,0,1-2.114-3.253A9.153,9.153,0,0,0,15.661,4.5a2.314,2.314,0,0,1-4.322,0A9.181,9.181,0,0,0,8.663,5.611,2.311,2.311,0,0,1,6.548,8.864a2.271,2.271,0,0,1-.942-.2A9.384,9.384,0,0,0,4.5,11.344a2.316,2.316,0,0,1,0,4.322,9.181,9.181,0,0,0,1.111,2.677,2.312,2.312,0,0,1,3.052,3.052A9.235,9.235,0,0,0,11.344,22.5a2.31,2.31,0,0,1,4.312,0,9.181,9.181,0,0,0,2.677-1.111,2.314,2.314,0,0,1,3.052-3.052A9.235,9.235,0,0,0,22.5,15.666,2.327,2.327,0,0,1,21.014,13.5Zm-7.472,3.745a3.75,3.75,0,1,1,3.75-3.75A3.749,3.749,0,0,1,13.542,17.245Z" transform="translate(-4.5 -4.5)" fill="#fff"/>
                                                </svg>
                                            </div>
                                            <div id="video_full">
                                                <div class="set_full_screen">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24.551 24.551">
                                                        <g id="fullscreen" transform="translate(-16.5 -16.5)">
                                                            <path id="full_ve_d" data-name="Path 7920" d="M18,22.053V19.544A1.544,1.544,0,0,1,19.544,18h2.509" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                                            <path id="full_va_d" data-name="Path 7921" d="M22.053,44.8H19.544A1.544,1.544,0,0,1,18,43.259V40.75" transform="translate(0 -5.253)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                                            <path id="full_va_a" data-name="Path 7922" d="M44.8,40.75v2.509A1.544,1.544,0,0,1,43.259,44.8H40.75" transform="translate(-5.253 -5.253)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                                            <path id="full_ve_a" data-name="Path 7923" d="M40.75,18h2.509A1.544,1.544,0,0,1,44.8,19.544v2.509" transform="translate(-5.253)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="set_no_full_screen">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24.552 24.552">
                                                        <g id="Group_9196" data-name="Group 9196" transform="translate(0 0)">
                                                            <path id="nofull_ve_d" data-name="Path 7922" d="M45.592,40.75v3a1.844,1.844,0,0,1-1.844,1.844h-3" transform="translate(-39.25 -39.461)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                                            <path id="nofull_va_d" data-name="Path 7923" d="M40.75,18h3a1.844,1.844,0,0,1,1.844,1.844v3" transform="translate(-39.25 0.211)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                                            <path id="nofull_va_a" data-name="Path 7920" d="M18,22.842v-3A1.844,1.844,0,0,1,19.844,18h3" transform="translate(0 0.211)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                                            <path id="nofull_ve_a" data-name="Path 7921" d="M22.842,45.592h-3A1.844,1.844,0,0,1,18,43.747v-3" transform="translate(0 -39.461)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>

                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>

                                        </div>


                                    @endif
                                </div>

                            @if($battle->current_status !== 'ended')
                                <div class="battle_round">
                                    @if($battle->current_status === 'live' && $battle->current_round && $battle->current_round['round'])
                                        /
                                    @endif
                                </div>

                            @endif

                            {{--@if($battle->video_options['screen_type'] === 'manual')
                                <div  id="change_screen_button">
                                    <button class="btn"> <svg fill="#FABA01"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                              viewBox="0 0 384.967 384.967"  xml:space="preserve">
                                                    <g>
                                                        <g id="Group_Arrows">
                                                            <path d="M72.18,192.479c6.641,0,12.03-5.39,12.03-12.03V84.206h199.595l-39.159,39.628c-4.728,4.752-4.728,12.439,0,17.191
                                                                c4.728,4.74,12.391,4.74,17.119,0l59.43-60.139c4.728-4.752,4.728-12.439,0-17.191l0,0l-59.43-60.139
                                                                c-4.728-4.74-12.391-4.74-17.119,0s-4.728,12.439,0,17.179l38.942,39.411H72.18c-6.641,0-12.03,5.39-12.03,12.03v108.273
                                                                C60.15,187.089,65.54,192.479,72.18,192.479z"/>
                                                            <path d="M312.786,192.395c-6.641,0-12.03,5.39-12.03,12.03v96.615H100.728l39.508-40.061c4.728-4.752,4.728-12.463,0-17.215
                                                                c-4.728-4.752-12.391-4.752-17.119,0L64,303.723c-5.041,4.764-5.077,12.969,0,17.733l59.129,59.947
                                                                c4.728,4.752,12.391,4.752,17.119,0s4.728-12.463,0-17.215l-38.533-39.074h211.072c6.641,0,12.03-5.39,12.03-12.03V204.437
                                                                C324.817,197.784,319.427,192.395,312.786,192.395z"/>
                                                        </g>

                                                    </g>

                                                </svg>
                                    </button>
                                </div>
                            @endif--}}


                        </div>

                    </div>

                </div>

                <div class="pt-3 live_battle_desc">
                    <div class="col-12 justify-content-between d-flex">
                        <div>
                            <h3>
                                {{$battle->title}}
                            </h3>
                            @if($battle->request->answer === 'accepted')
                                <p><a href="{{route('user.profile',$battle->request->creator->nickname)}}">{{$battle->request->creator->nickname}}</a> vs <a href="{{route('user.profile',$battle->request->joiner->nickname)}}">{{$battle->request->joiner->nickname}}</a></p>
                            @endif
                            <div id="timer_place_count">
                                @if($battle->current_status === 'live')
                                    <p class="orange">live for <span class="count_up" data-date="{{$battle->time}}">00:00:00</span></p>
                                @elseif($battle->current_status === 'none' || $battle->current_status === 'creator' || $battle->current_status === 'joiner')
                                    <p>start in  <span class="count_down" data-date="{{$battle->start_date}}">00:00:00</span></p>
                                @elseif($battle->current_status === 'ended')
                                    <p>lasted <span class="count_duration" data-start="{{$battle->time}}" data-end="{{$battle->end_date}}"></span></p>
                                @endif
                            </div>
                            <p class="battle_description">Description</p>
                            <p>{{$battle->description?$battle->description:'no_info'}}</p>
                        </div>



                        <div class="donations_place">
                            <div class="current_round_handler">
                                <p>Current Round: <span>01</span></p>
                            </div>
                            @if($battle->views)
                                <p class="text-right ">
                                    <span id="battle_viewers">{{$battle->views}}</span>
                                    <span><i class="fa fa-user"></i></span>
                                </p>
                            @endif

                            <p class="battle_donations mt-2">Donations Recieved:</p>
                            <h3>300$</h3>
                        </div>
                    </div>



                </div>
            </div>
            @auth()
                @if($subscribed)
                    <div class="text-right">
                        <p class="pr-3">You`re already subscribed <i class="fa fa-check"></i></p>
                    </div>
                @endif
                @if(!$subscribed && auth()->id() !== $battle->request->joiner->id && auth()->id() !== $battle->request->creator->id)
                    <div class="text-right">
                        <button id="subscribe_button" class="btn mx-2 text-center subscribe_to_battle text-right">Subscribe</button>
                    </div>
                @endif
                @if(!$uninteresting)
                    <div class="text-right">
                        <button id="not_interested" class="mt-2 btn mx-2 text-center alert_design text-right">Not interested</button>
                    </div>
                @endif
                <div class="text-right">
                    <button id="invite_to_view" type="button" data-toggle="modal" data-target="#inviteModal" class="mt-2 btn mx-2 text-center alert_design text-right">Invite To View</button>
                </div>
            @endauth
            <div class="col-12 mt-4 pt-4">

                <div class="border-div col"></div>
            </div>
        </div>

        <div class="p-0 pr-3 animate__animated animate__fadeInRight opened_chat" id="chat">
            <div class=" live_chat d-flex justify-content-between flex-column " >
                <div class="d-flex justify-content-between p-3">
                    <p class="chat_welcome_message">Welcome to Chat</p>
                    <div id="close_messages"><i class="fa fa-times"></i></div>
                </div>
                <div class="live_chat_messages p-3" id="message_desc">

                </div>
                <div class="live_chat_input_place text-center">
                    <div class="live_chat_buttons">
                        <input id="livechat_message_input"
                               @guest()
                               disabled placeholder="Please log in to write a message..."
                               @endguest
                               @auth()
                               placeholder="Send a message..."
                               @endauth type="text" >
                        <button class="btn" id="message_button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path id="Icon_material-face" data-name="Icon material-face"
                                      d="M7.8,10.275A1.125,1.125,0,1,0,8.925,11.4,1.125,1.125,0,0,0
                                      ,7.8,10.275Zm5.4,0A1.125,1.125,0,1,0,14.325,11.4,1.125,1.125,
                                      0,0,0,13.2,10.275ZM10.5,1.5a9,9,0,1,0,9,9A9,9,0,0,0,10.5,1.5Zm0,
                                      16.2a7.21,7.21,0,0,1-7.2-7.2,7.3,7.3,0,0,1,.045-.774A9.056,9.056,
                                      0,0,0,8.034,4.893,8.977,8.977,0,0,0,15.378,8.7,8.784,8.784,0,0,0,
                                      17.4,8.466,7.189,7.189,0,0,1,10.5,17.7Z" transform="translate(-1.5 -1.5)" fill="#fff"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('user_dashboard.includes.battle_modals')
    <audio controls id="zvanok" style="display: none">
        <source src="{{asset('zvanok.mp3')}}" type="audio/mpeg">
    </audio>
    <script src="{{asset('users_assets/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dashjs/3.1.3/dash.all.min.js" integrity="sha512-KbtNOWr7e/rlM9utrUc5cO9PeJZO3jFfCjWPe1mHe2sPvIike3IZIH6h4ja6wH7aXNKrecP8zh6/SYDc3t6Jog==" crossorigin="anonymous"></script>

    <script>
        let ID_COMPONENT_STATUS = "{{auth()->id()}}";
        let AVATAR_STORAGE = "{{asset('storage/user/images/avatar')}}";
        let MESSAGE_ROUTE = '{{route('battle.send.message')}}';
        let BATTLE_ID = "{{$battle->id}}" ;
        let UNINTERESTING_ROUTE = '{{route('battle.uninteresting')}}';
        let SUBSCRIBE_ROUTE = '{{route('battle.subscribe')}}';
        let VOTE_ROUTE = '{{route('battle.vote')}}';
        let INVITE_ROUTE = "{{route('battle.invite')}}";
        let GET_NICKNAME = "{{route('get.users.nickname')}}";
        let REACTION_ROUTE = '{{route('set.reaction')}}';
        let REPORT_ROUTE = '{{route('report.battle')}}';

        let SCREEN_TYPE = "{{$battle->video_options['screen_type']}}",CHANGE_TIME_STRING,CHANGE_TIME;
        let BATTLE_STATUS = "{{$battle->current_status}}";
    </script>
    <script src="{{asset('users_assets/js/battle.js')}}"></script>
    <script src="{{asset('users_assets/js/battleVideoPlayer.js')}}"></script>
    <script>
        $(document).ready(function () {
            if (BATTLE_STATUS === 'live'){
                setTimeout(function () {
                    $.ajax({
                        url: '{{route('battle.set.view')}}',
                        type: "post",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            battle:BATTLE_ID,
                        },
                        success: function (response) {
                            console.log('view set',response)
                        },
                        error:function (response) {

                        }
                    })
                },3000)
                let LAST_CHANGE = new Date("{{$battle->current_round && array_key_exists('time',$battle->current_round) ? $battle->current_round['time'] : null}}").getTime();
                let CURRENT_USER = "{{$battle->current_round && array_key_exists('turn',$battle->current_round)? $battle->current_round['turn'] : null }}";
                let CURRENT_ROUND = parseInt("{{$battle->current_round && array_key_exists('round',$battle->current_round)? $battle->current_round['round'] : null }}");
                let ROUND_TURN = "{{$battle->current_round && array_key_exists('round_turn',$battle->current_round)? $battle->current_round['round_turn'] : null }}";
                console.log('LAST_CHANGE',LAST_CHANGE,'CURRENT_USER',CURRENT_USER,'CURRENT_ROUND',CURRENT_ROUND,'ROUND_TURN',ROUND_TURN)
                let NOW_DATE = new Date().getTime();
                let Interval = NOW_DATE - LAST_CHANGE;
                console.log(Interval)
                if(Interval < 20000){
                    if(CURRENT_ROUND > 1 || CURRENT_USER === 'joiner'){
                        if(CURRENT_ROUND > 1){
                            changeRound(CURRENT_ROUND-1)
                        }else{
                            changeRound(CURRENT_ROUND)
                        }

                        switch (CURRENT_USER) {
                            case 'joiner':
                                changeVideoContainer('creator');
                                setTimeout(function () {
                                    changeVideoContainer('joiner')
                                    if(ROUND_TURN === '1') {
                                        changeRound(CURRENT_ROUND)
                                    }
                                    if(CURRENT_ROUND == "{{$battle->rounds}}" && "{{$battle->rounds}}" != 1){
                                        animateArray([
                                            {
                                                text:'round' + CURRENT_ROUND,
                                                color:'red'
                                            },
                                            {
                                                text:'final',
                                                color:'red'
                                            },
                                            {
                                                text:"{{$battle->request->joiner->nickname}}",
                                                color:'orange'
                                            }
                                        ])
                                    }else{
                                        animateArray([
                                            {
                                                text:'round' + CURRENT_ROUND,
                                                color:'red'
                                            },
                                            {
                                                text:"{{$battle->request->joiner->nickname}}",
                                                color:'orange'
                                            }
                                        ])
                                    }

                                },Interval)
                                break;
                            case 'creator':
                                changeVideoContainer('joiner');
                                setTimeout(function () {
                                    changeVideoContainer('creator')
                                    if(ROUND_TURN === '1'){
                                        changeRound(CURRENT_ROUND)
                                    }
                                    if(CURRENT_ROUND == "{{$battle->rounds}}"  && "{{$battle->rounds}}" != 1){
                                        animateArray([
                                            {
                                                text:'round' + CURRENT_ROUND,
                                                color:'red'
                                            },
                                            {
                                                text:'final',
                                                color:'red'
                                            },
                                            {
                                                text:"{{$battle->request->creator->nickname}}",
                                                color:'orange'
                                            }
                                        ])
                                    }else{
                                        animateArray([
                                            {
                                                text:'round' + CURRENT_ROUND,
                                                color:'red'
                                            },
                                            {
                                                text:"{{$battle->request->creator->nickname}}",
                                                color:'orange'
                                            }
                                        ])
                                    }

                                },Interval)
                                break;

                        }
                    }else{
                        changeRound(CURRENT_ROUND)
                        makeTimer(Math.floor((20000 - Interval)/1000),animateUserRound,'creator');
                    }

                }else{
                    changeRound(CURRENT_ROUND)
                    switch (CURRENT_USER) {
                        case 'joiner':
                            changeVideoContainer('joiner');
                            break;
                        case 'creator':
                            changeVideoContainer('creator');
                            break;

                    }
                }
            }
            function changeRound(round) {
                $('.battle_round').text('Round ' + round + '/' + "{{$battle->rounds}}")
            }
            function battleTextAnimation(message,color) {
                let text = $('<div class="animation_message animate__animated animate__bounceIn '+ color +'"> </div>');
                text.text(message);
                $('.animation_message_place').append(text);
                setTimeout(function () {
                    text.remove();
                },1500)
            }
            function changeVideoContainer(user){
                if(SCREEN_TYPE !== 'in_sync'){
                    if(user === 'joiner'){
                        VideoCreator.addClass('d-none');
                        VideoJoiner.removeClass('col-6 d-none').addClass('col-12');
                        NOW = 'joiner'
                    }else{
                        VideoJoiner.addClass('d-none');
                        VideoCreator.removeClass('col-6 d-none').addClass('col-12');
                        NOW = 'creator'
                    }
                }else{
                    if(user === 'joiner'){
                        VideoJoiner.addClass('active');
                        VideoCreator.removeClass('active');
                    }else{
                        VideoCreator.addClass('active');
                        VideoJoiner.removeClass('active');
                    }
                }
                if(user === 'joiner'){
                    $('.pulse_turn').removeClass('active');
                    $('.pulse_joiner').addClass('active')
                    NOW = 'joiner'
                }else{
                    $('.pulse_turn').removeClass('active');
                    $('.pulse_creator').addClass('active')
                    NOW = 'creator'
                }


            }
            function animateUserRound(user){
                if(user === 'creator'){
                    changeVideoContainer('creator');
                    animateArray([
                        {
                            text:'battle started',
                            color:'red'
                        },
                        {
                            text:'round 1',
                            color:'red'
                        },
                        {
                            text:"{{$battle->request->creator->nickname}}",
                            color:'orange'
                        }
                    ])
                }else{
                    changeVideoContainer('joiner');
                    animateArray([
                        {
                            text:'battle started',
                            color:'red'
                        },
                        {
                            text:'round 1',
                            color:'red'
                        },
                        {
                            text:"{{$battle->request->joiner->nickname}}",
                            color:'orange'
                        }
                    ])
                }
                let player1 = dashjs.MediaPlayer().create();
                let player2 = dashjs.MediaPlayer().create();
                setTimeout(function () {
                    player1.initialize(video1,"{{$playback.$battle->request->creator->nickname.'_'.$battle->id.'.mpd'}}",false)
                    player2.initialize(video2,"{{$playback.$battle->request->joiner->nickname.'_'.$battle->id.'.mpd'}}",false)
                    video1.play();
                    video2.play();
                },1000)

            }

            function animateArray(array){
                return animateArrayDynamic(array.length,0,array)
            }
            function animateArrayDynamic(n,i,array) {
                battleTextAnimation(array[i].text,array[i].color);
                i++
                n--
                if(!n)
                    return;
                setTimeout(function () {
                    animateArrayDynamic(n,i,array);
                },2000)
                return false
            }
            let BATTLE_CONFIG = 'config_' + BATTLE_ID;

            Echo.channel(BATTLE_CONFIG)
                .listen('.new_configuration', e => {
                    console.log(e.data,'datatype')
                    if(e.data.type === 'start'){
                        $('#timer_place_count').empty().append('<p class="orange">live for <span id="count_up_battle"></span></p>');
                        countUpFromBattle(0,$('#count_up_battle'))
                        makeTimer(20,animateUserRound,'creator');
                    }else if(e.data.type === 'end_round'){
                        let nickname;
                        if(e.data.player === 'joiner'){
                            nickname = "{{$battle->request->joiner->nickname}}"
                        }else{
                            nickname = "{{$battle->request->creator->nickname}}"
                        }
                        setTimeout(function () {
                            changeVideoContainer(e.data.player);
                            if (e.data.round_turn){
                                if(e.data.round == "{{$battle->rounds}}" && "{{$battle->rounds}}" != 1){
                                    animateArray([
                                        {
                                            text:'round '+ e.data.round,
                                            color:'red'
                                        },
                                        {
                                            text:'final',
                                            color:'red'
                                        },
                                        {
                                            text:nickname,
                                            color:'orange'
                                        }
                                    ])
                                }else{
                                    animateArray([
                                        {
                                            text:'round '+ e.data.round,
                                            color:'red'
                                        },
                                        {
                                            text:nickname,
                                            color:'orange'
                                        }
                                    ])
                                }
                                changeRound(e.data.round)
                            }else{
                                animateArray([
                                    {
                                        text:nickname,
                                        color:'orange'
                                    }
                                ])
                            }
                        },20000)
                    }else if(e.data.type === 'count'){
                        $('#battle_viewers').text(e.data.count)
                    }
                })
            function makeTimeLive(time) {
                let minutes = Math.floor(time / 60);
                time %= 60;
                let minutesText = minutes < 10 ? '0' + minutes : minutes;
                let secondsText = time < 10 ? '0' + time : time;
                return minutesText + ':' + secondsText;
            }
            function makeTimer(time,callback,user){
                let timerPlace = $('<div class="battle_timer"> </div>');
                $('.battle_timer_desc').append(timerPlace);
                let timer = setInterval(function () {
                    if(!time){
                        clearInterval(timer)
                        timerPlace.remove()
                        callback(user);
                    }
                    timerPlace.text(makeTimeLive(time--));
                }, 1000);
            }
        })

    </script>


@endsection
