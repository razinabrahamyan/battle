@extends('user_dashboard.layouts.app')
@section('title', 'Battle')
@section('content')
    @include('user_dashboard.includes.battle_pad')

    <div class="live_battle_main d-flex mt-3">

        <div class=" p-0 opened_chat" id="battles_flexible_desc">
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
                <div class="position-relative" id="battles_live_center">
                    <div class="d-flex w-100 position-relative live_videos" id="live_videos">
                        <div id="videoBig" class="col-6 p-0 video_player position-relative" >
                            <video @if($battle->request->creator->id == auth()->id() && $battle->current_status === 'live')id="videoInput" @else id="videoOutput" @endif @if($battle->request->creator->id == auth()->id()) muted @endif  autoplay  width="100%"
                                   poster="{{asset('users_assets/images/battle/battle_blue.png')}}">
                                @if($battle->current_status === 'ended')
                                    <source type="video/mp4"  src="{{'https://battle.zone/vod/'.$battle->request->creator->nickname.'_'.$battle->id.'.mp4'}}"  >
                                    {{--<source type="video/mp4"  src="{{asset('videos/videoplayback.mp4')}}"--}}
                                @endif
                            </video>
                            <div class="live_emotions_left">
                                <div class="hearts flying" id="flying_smiles_left">
                                </div>
                            </div>
                            <div class="video_username">
                                {{$battle->request->creator->nickname}}
                            </div>

                        </div>
                        <div id="videoSmall" class="draggable col-6 p-0 video_player">
                            <video @if($battle->request->creator->id == auth()->id() && $battle->current_status === 'live') id="videoOutput" @else id="videoInput" @endif  @if($battle->request->joiner->id == auth()->id()) muted @endif   autoplay   width="100%"
                                   poster="{{asset('users_assets/images/battle/battle_red.png')}}">
                                @if($battle->current_status === 'ended')
                                    <source type="video/mp4"  src="{{'https://battle.zone/vod/'.$battle->request->joiner->nickname.'_'.$battle->id.'.mp4'}}"  >
                                    {{--<source type="video/mp4"  src="{{asset('videos/videoplayback.mp4')}}"--}}
                                @endif
                            </video>
                            <div class="live_emotions">
                                <div class="hearts flying" id="flying_smiles_right">
                                </div>
                            </div>
                            <div class="video_username">
                                {{$battle->request->joiner->nickname}}
                            </div>
                        </div>
                        <span class="pulse_turn pulse_round_battle" data-toggle="tooltip" data-placement="top" ></span>
                        <div class="chat_open_handler">
                            <i class="fa fa-comment"></i>
                        </div>
                        <div class="battle_timer_desc">
                        </div>
                        <div class="animation_text">
                            <div class="animation_message_place">
                            </div>
                        </div>
                        <div id="video_settings">
                            @if($battle->current_status === 'ended' || $battle->current_status === 'live')
                                @if($battle->current_status === 'ended')
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

                                <div class="pr-2 d-flex ml-1" id="volume_handler">
                                    <div id="volume_icon_handler">
                                        <i class="fa fa-volume-mute volume_icon"></i>
                                    </div>
                                    <div id="volume_input_handler">
                                        <input type="range" min="0" step="1" max="100" value="0" id="volume_input" class="ml-1">
                                    </div>
                                </div>
                                @if($battle->current_status === 'ended')
                                    <div id="track_handler">
                                        <div id="track_hover_time">

                                        </div>
                                        <input type="range" min="0" id="track" value="0" step="1">
                                    </div>
                                    <div class="pl-2" id="video_time">
                                        00:00
                                    </div>
                                    <div class="pl-2">
                                        <svg id="video_settings_icon" width="18" height="18.005" viewBox="0 0 18 18.005">
                                            <path id="Icon_ionic-ios-settings" data-name="Icon ionic-ios-settings" d="M21.014,13.5A2.316,2.316,0,0,1,22.5,11.339a9.181,9.181,0,0,0-1.111-2.677,2.347,2.347,0,0,1-.942.2,2.311,2.311,0,0,1-2.114-3.253A9.153,9.153,0,0,0,15.661,4.5a2.314,2.314,0,0,1-4.322,0A9.181,9.181,0,0,0,8.663,5.611,2.311,2.311,0,0,1,6.548,8.864a2.271,2.271,0,0,1-.942-.2A9.384,9.384,0,0,0,4.5,11.344a2.316,2.316,0,0,1,0,4.322,9.181,9.181,0,0,0,1.111,2.677,2.312,2.312,0,0,1,3.052,3.052A9.235,9.235,0,0,0,11.344,22.5a2.31,2.31,0,0,1,4.312,0,9.181,9.181,0,0,0,2.677-1.111,2.314,2.314,0,0,1,3.052-3.052A9.235,9.235,0,0,0,22.5,15.666,2.327,2.327,0,0,1,21.014,13.5Zm-7.472,3.745a3.75,3.75,0,1,1,3.75-3.75A3.749,3.749,0,0,1,13.542,17.245Z" transform="translate(-4.5 -4.5)" fill="#fff"/>
                                        </svg>

                                    </div>
                                @endif

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
                            @endif
                        </div>
                        <div class="battle_round">
                            @if($battle->current_status === 'live' && $battle->current_round && $battle->current_round['round'])
                               {{'Round '.$battle->current_round['round'].'/'.$battle->rounds}}
                            @endif
                        </div>
                    </div>
                    @if($battle->request->creator_id == auth()->id())
                        @if($battle->current_status === 'live' && $battle->current_round && $battle->current_round['turn'] === 'creator' && $battle->video_options['screen_type'] !== 'auto')
                            <div class="finish_round_div">
                                <div class="finish_round_button_place">
                                    <button class="btn" id="finish_round">Finish Round </button>
                                </div>
                            </div>
                        @endif
                    @elseif($battle->request->assignee_id == auth()->id())
                        @if($battle->current_status === 'live' && $battle->current_round && $battle->current_round['turn'] === 'joiner' && $battle->video_options['screen_type'] !== 'auto')
                            <div class="finish_round_div">
                                <div class="finish_round_button_place">
                                    <button class="btn" id="finish_round">Finish Round </button>
                                </div>
                            </div>
                        @endif
                    @endif


                    @auth()
                        @if($battle->request->answer === 'accepted')
                            @if($battle->request->creator_id == auth()->id())
                                <div class="start_button_div @if($battle->current_status === 'none' || $battle->current_status === 'joiner') battle_flex @else battle_none @endif" id="ready_button_div">
                                    <div>
                                        <button class="btn" id="ready" data-role="creator">I`m Ready </button>
                                        <p class="text-center" id="ready_p">@if($battle->current_status === 'joiner')Your opponent is ready @endif</p>
                                    </div>
                                </div>

                            @elseif($battle->request->assignee_id == auth()->id())
                                @if($battle->current_status === 'none' || $battle->current_status === 'creator')
                                    <div class="start_button_div battle_flex" id="ready_button_div">
                                        <div>
                                            <button class="btn" id="ready" data-role="joiner">I`m Ready </button>
                                            <p class="text-center" id="ready_p"> @if($battle->current_status === 'creator')Your opponent is ready @endif</p>
                                        </div>

                                    </div>
                                @endif

                            @endif
                        @endif

                    @endauth


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
                            <p>{{$battle->description?$battle->description:'no info'}}</p>
                            @if($battle->request->joiner && $battle->request->joiner->id === auth()->id() && !$battle->request->answer)

                            @endif



                        </div>
                        <div>
                            <p class="battle_donations">Donations Recieved</p>
                            <h3>300$</h3>
                            @auth()
                                <div class="text-right">
                                    <button id="invite_to_view" type="button" data-toggle="modal" data-target="#inviteModal" class="mt-2 btn mx-2 text-center alert_design text-right">Invite To View</button>
                                </div>
                            @endauth

                        </div>
                    </div>
                    @auth()

                        <div>
                            @if($battle->request->joiner && $battle->request->joiner->id === auth()->id() && !$battle->request->answer)
                                <div class="col-12 animate__animated" id="battle_answer_desc">
                                    <h5>{{$battle->request->creator->nickname}} invited you to this battle</h5>
                                    <p class="battle_description">Message</p>
                                    <p>{{$battle->request->correction && array_key_exists('message',$battle->request->correction) && $battle->request->correction['message']?$battle->request->correction['message']:'no message'}}</p>
                                    <div class="d-flex mt-3">
                                        <div>
                                            <button type="button" class="main_design answer_battle_request" data-attempt="first" data-answer="accept"> <i class="fa fa-check pr-1"></i> Accept</button>

                                        </div>
                                        <div class="pl-2">
                                            <button type="button" class="alert_design"   data-toggle="modal" data-target="#rejectModal"><i class="fa fa-times pr-1"></i> Reject</button>
                                        </div>
                                        <div class="pl-2">
                                            <button type="button" class="danger_design"  data-toggle="modal" data-target="#changeModal"><i class="fa fa-times pr-1"></i> Change</button>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @endauth
                            @auth()
                                @if($battle->request->creator && $battle->request->creator_id === auth()->id() && $battle->request->answer === 'correction')
                                    <div class="col-12 animate__animated" id="battle_answer_desc">
                                        <h5>{{$battle->request->joiner->nickname}} made some corrections to this battle</h5>
                                        <div class="d-flex  mt-3">
                                            <div class="d-flex align-items-center">
                                                <input disabled type="text" class="form-control main_input_design " value="{{\Carbon\Carbon::create($battle->start_date)->format('Y-m-d')}}">
                                                <div class="pl-2">
                                                    Start Date
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex  mt-3">
                                            <div class="d-flex align-items-center">
                                                <input disabled type="text" class="form-control main_input_design " value="{{\Carbon\Carbon::create($battle->start_date)->format('H:i')}}">
                                                <div class="pl-2">
                                                    Time
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex mt-3">
                                            <div>
                                                <button type="button" class="main_design answer_battle_request" data-attempt="final" data-answer="accept"> <i class="fa fa-check pr-1"></i> Accept</button>

                                            </div>
                                            <div class="pl-2">
                                                <button type="button" class="alert_design"  data-toggle="modal" data-target="#rejectModalFinal"><i class="fa fa-times pr-1"></i> Reject</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth


                        </div>
                        <div class="col-12 mt-4 pt-4">

                            <div class="border-div col"></div>
                        </div>
                </div>
            </div>

        </div>

        <div class=" p-0 pr-3 animate__animated animate__fadeInRight opened_chat" id="chat">
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
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <div>
                                        <div>
                                            <div>
                                                <input type="hidden" id="is_on_battles_page" value="yes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('user_dashboard.includes.battle_modals')
    <audio controls id="zvanok" class="d-none">
        <source src="{{asset('zvanok.mp3')}}" type="audio/mpeg">
    </audio>



    <script src="{{asset('users_assets/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
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
        let MARK_READY_NOTIFICATION = '{{route('battle.mark.ready')}}';
    </script>
    <script src="{{asset('users_assets/js/battle.js')}}"></script>
    <script>
        $(document).ready(function () {
            if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
                // Firefox 38+ seems having support of enumerateDevicesx
                navigator.enumerateDevices = function(callback) {
                    navigator.mediaDevices.enumerateDevices().then(callback);
                };
            }
            var MediaDevices = [];
            var isHTTPs = location.protocol === 'https:';
            var canEnumerate = false;

            if (typeof MediaStreamTrack !== 'undefined' && 'getSources' in MediaStreamTrack) {
                canEnumerate = true;
            } else if (navigator.mediaDevices && !!navigator.mediaDevices.enumerateDevices) {
                canEnumerate = true;
            }

            var hasMicrophone = false;
            var hasSpeakers = false;
            var hasWebcam = false;

            var isMicrophoneAlreadyCaptured = false;
            var isWebcamAlreadyCaptured = false;
            function enumerate(callback){
                navigator.enumerateDevices(function(devices) {
                    devices.forEach(function(_device) {
                        var device = {};
                        for (var d in _device) {
                            device[d] = _device[d];
                        }

                        if (device.kind === 'audio') {
                            device.kind = 'audioinput';
                        }

                        if (device.kind === 'video') {
                            device.kind = 'videoinput';
                        }

                        var skip;
                        MediaDevices.forEach(function(d) {
                            if (d.id === device.id && d.kind === device.kind) {
                                skip = true;
                            }
                        });

                        if (skip) {
                            return;
                        }

                        if (!device.deviceId) {
                            device.deviceId = device.id;
                        }

                        if (!device.id) {
                            device.id = device.deviceId;
                        }

                        if (!device.label) {
                            device.label = 'Please invoke getUserMedia once.';
                            if (!isHTTPs) {
                                device.label = 'HTTPs is required to get label of this ' + device.kind + ' device.';
                            }
                        } else {
                            if (device.kind === 'videoinput' && !isWebcamAlreadyCaptured) {
                                isWebcamAlreadyCaptured = true;
                            }

                            if (device.kind === 'audioinput' && !isMicrophoneAlreadyCaptured) {
                                isMicrophoneAlreadyCaptured = true;
                            }
                        }

                        if (device.kind === 'audioinput') {
                            hasMicrophone = true;
                        }

                        if (device.kind === 'audiooutput') {
                            hasSpeakers = true;
                        }

                        if (device.kind === 'videoinput') {
                            hasWebcam = true;
                        }

                        // there is no 'videoouput' in the spec.

                        MediaDevices.push(device);
                    });

                    if (callback) {
                        callback();
                    }
                });
            }
            function checkDeviceSupport(callback) {
                if (!canEnumerate) {
                    return;
                }

                if (!navigator.enumerateDevices && window.MediaStreamTrack && window.MediaStreamTrack.getSources) {
                    navigator.enumerateDevices = window.MediaStreamTrack.getSources.bind(window.MediaStreamTrack);
                }

                if (!navigator.enumerateDevices && navigator.enumerateDevices) {
                    navigator.enumerateDevices = navigator.enumerateDevices.bind(navigator);
                }

                if (!navigator.enumerateDevices) {
                    if (callback) {
                        callback();
                    }
                    return;
                }

                MediaDevices = [];

                enumerate(callback);

            }
            checkDeviceSupport(function() {
                if(!hasWebcam || !hasMicrophone){
                    if(!hasWebcam && !hasMicrophone){
                        alert('webcam and microphone not connected , please connect devices');
                    }else if(!hasWebcam){
                        alert('webcam not connected , please connect device');
                    }else if(!hasMicrophone){
                        alert('microphone not connected , please connect device');
                    }
                    let camInterval = setInterval(function () {
                        enumerate();
                        if (hasWebcam && hasMicrophone){
                            clearInterval(camInterval)
                            navigator.mediaDevices.getUserMedia({ video: true,audio:true }).then(function(stream) {
                            });
                        }else{
                        }

                    },2000)
                }else{
                    navigator.mediaDevices.getUserMedia({ video: true,audio:true }).then(function(stream) {
                    });
                }
            });
            $('#reject_button').click(function () {
                console.log()
            })
            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD',
                ignoreReadonly:true,
                allowInputToggle:true
            });
            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD',
                ignoreReadonly:true,
                allowInputToggle:true
            });
            $('#time').datetimepicker({
                format: 'LT',
                ignoreReadonly:true,
                allowInputToggle:true
            });
            @auth()
            $('.answer_battle_request').click(function () {
                if($(this).data('answer') === 'accept' || $(this).data('answer') === 'reject' || $(this).data('answer') === 'change'){
                    let data = '';
                    if($(this).data('answer') === 'accept'){
                        if($(this).data('attempt') === 'first'){
                            data = {
                                attempt:'first',
                                answer:$(this).data('answer'),
                                battle:BATTLE_ID
                            };
                        }else if($(this).data('attempt') === 'final'){
                            data = {
                                attempt:'final',
                                answer:$(this).data('answer'),
                                battle:BATTLE_ID
                            };
                        }

                    }else if($(this).data('answer') === 'reject'){
                        if($(this).data('attempt') === 'first'){
                            data = {
                                attempt:'first',
                                answer:$(this).data('answer'),
                                battle:BATTLE_ID,
                                reason:$('#reject_reason').val(),
                                additional:$('#reject_textarea').val()
                            };
                        }else if($(this).data('attempt') === 'final'){
                            data = {
                                attempt:'final',
                                answer:$(this).data('answer'),
                                battle:BATTLE_ID,
                            };
                        }

                    }else {
                        data = {
                            attempt:'first',
                            answer:$(this).data('answer'),
                            battle:BATTLE_ID,
                            start_date:$('#start_date_input').val(),

                            time:$('#time_input').val(),
                        };
                    }
                    console.log(data)
                    $.ajax({
                        url: '{{route('answer.battle.request')}}',
                        type: "post",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: data,
                        success: function (response) {
                            console.log(response)
                            if (response.success === 'success'){
                                if(response.answer === 'reject'){
                                    setTimeout(function () {
                                        window.location.replace("{{route('user.home')}}")
                                    },2000)

                                }
                                if(response.answer === 'accept'){
                                    console.log(response)
                                    let image = $('<img id="second_player_image" src="/storage/user/images/avatar/'+response.user.avatar +'" alt="">')
                                    $('.battle_pad_prof.opponent_player').append(image)
                                    $("#second_player_name").text(response.user.nickname);
                                    $("#second_player_address").text(response.user.city.city['en']+','+response.user.country.country['en']);
                                    $('.battle_pad_prof.opponent_player').addClass('animate__animated animate__flash')
                                }
                                $('#battle_answer_desc').addClass('animate__bounceOutLeft');
                                setTimeout(function () {
                                    location.reload();
                                },2000)
                                alertSuccess(response.message);
                            }
                        },
                        error:function (response) {

                        }
                    })
                }

            })
            @endauth
        })
    </script>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/web-socket-js/1.0.0/web_socket.min.js"></script>
        <script src="{{asset('von_tobel/adapter.js')}}"></script>
        <script src="{{asset('von_tobel/kurento-utils.js')}}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
        <script src="{{asset('users_assets/js/battleVideoPlayer.js')}}"></script>
        <script >
            let name = '';
            let SELF = "{{auth()->id()}}" == "{{$battle->request->creator->id}}" ? 'creator' : 'joiner';
            @auth()
                name = "{{auth()->user()->nickname."_".$battle->id }}"
                @endauth
            let opponent = '<?php echo $opponent."_".$battle->id ?>';
            console.log('name',name)
            let audio = $('#zvanok')[0];
            let recUri = "{{$receiver}}";
            console.log('recUri',recUri)
            var wsVideo = new WebSocket("wss://"+recUri+"/magicmirror");
            //var ws = new WebSocket('wss://' + location.host + '/magicmirror');
            var videoInput;
            var videoOutput;
            var webRtcPeer;
            var registerName = null;
            const NOT_REGISTERED = 0;
            const REGISTERING = 1;
            const REGISTERED = 2;
            var registerState = null;
            const NO_CALL = 0;
            const PROCESSING_CALL = 1;
            const IN_CALL = 2;
            var callState = null;
            let STATUS = false;
            let STATE = "{{$battle->current_status}}";
            let SCREEN_TYPE = "{{$battle->video_options['screen_type']}}"
            let CHANGE_TIME = "{{$battle->video_options && array_key_exists('auto_change',$battle->video_options)? $battle->video_options['auto_change'] : null }}"
            let CURRENT_USER = "{{$battle->current_round && array_key_exists('turn',$battle->current_round)? $battle->current_round['turn'] : null }}";
            let LAST_CHANGE = new Date("{{$battle->current_round && array_key_exists('time',$battle->current_round) ? $battle->current_round['time'] : null}}").getTime();
            let NOW_DATE = new Date().getTime();
            let Interval = NOW_DATE - LAST_CHANGE;
            function showBattleState(){
                console.log('STATE',STATE,',SELF-',SELF, ',SCREEN_TYPE-',SCREEN_TYPE, ',CHANGE_TIME-', CHANGE_TIME ,',CURRENT_USER-', CURRENT_USER)
            }
            if(STATE === 'live' ){
                if(CURRENT_USER === SELF){
                    if(SCREEN_TYPE === 'auto'){
                        if(Interval <= 1000*parseInt(CHANGE_TIME)){
                            let INTER = 1000*parseInt(CHANGE_TIME) - Interval;
                            setRoundChangeTimeout(Math.floor(INTER/1000))
                        }else{
                            finishRoundDynamicly();
                        }
                    }
                    startTurn()
                }else{
                    endTurn()
                }

            }
            showBattleState();
            function startTurn() {
                $('.pulse_turn').addClass('active').attr('data-original-title','your turn');
            }

            function endTurn() {
                $('.pulse_turn').removeClass('active').attr('data-original-title','not your turn');
            }
            if(SCREEN_TYPE === 'auto'){
                $('#finish_round').remove()
            }
            function finishRoundDynamicly(finish_button){
                $.ajax({
                    url: '{{route('battle.round.finish')}}',
                    type: "post",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        battle:BATTLE_ID,
                    },
                    success: function (response) {
                        if(response.success === 'success'){
                            console.log(response,'888888888888888888888888888888888');
                            endTurn();
                            if(response.status && response.status === 'ended'){
                                animateArray([
                                    {
                                        text:'Battle ended ',
                                        color:'red'
                                    }

                                ])
                                stop()
                            }
                            else if (response.round_turn){
                                $('.battle_round').text('Round ' + response.round + '/' + "{{$battle->rounds}}")
                                if(response.round == "{{$battle->rounds}}" && "{{$battle->rounds}}" != 1){
                                    animateArray([
                                        {
                                            text:'Round '+ response.round,
                                            color:'red'
                                        },
                                        {
                                            text:'final',
                                            color:'red'
                                        }

                                    ])
                                }else{
                                    battleTextAnimation('Round '+ response.round,'red')
                                }

                            }
                            if(SCREEN_TYPE !== 'auto'){
                                $('.finish_round_div').remove()
                            }


                        }

                    },
                    error:function (response) {

                    }
                })
            }
            console.log('self',SELF);
            wsVideo.onopen = function () {
                register();
                if(STATE === 'live' || STATE === 'both'){
                    call();
                }
            }
            function checkStatus(role){
                $.ajax({
                    url: '{{route('battle.check.status')}}',
                    type: "get",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        battle:BATTLE_ID
                    },
                    success: function (response) {
                        console.log(response)
                        if(response.success === 'success'){
                            $('#ready_button_div').remove();
                            if(role === 'creator'){
                                $('#start_button_div').css('display','flex');
                            }
                            STATUS =  true;
                        }else STATUS = false;

                    },
                    error:function (response) {

                    }
                })
            }
            $('#ready').click(function () {
                console.log($(this).data('role'))
                let role = $(this).data('role');
                let button = $(this);

                button.attr('disabled',true);
                $.ajax({
                    url: '{{route('battle.change.status')}}',
                    type: "post",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        battle:BATTLE_ID,
                        state:'ready'
                    },
                    success: function (response) {
                        console.log(response)
                        if(response.success === 'success'){
                            if(response.status === 'ready'){
                                if(role === 'creator'){
                                    $('#ready_button_div').remove();
                                }else{
                                    $('#ready_button_div').remove();
                                }
                                call();
                            }else if(response.status === 'not_ready'){
                                if(role === 'creator'){
                                    $('#ready_button_div').empty();
                                    $('#ready_button_div').append('<p>Waiting for opponent</p>');
                                    let statusInterval = setInterval(function () {
                                        if(STATUS)
                                            clearInterval(statusInterval);
                                        checkStatus(role)
                                    },3000)

                                }else{
                                    $('#ready_button_div').empty();
                                    $('#ready_button_div').append('<p>Waiting for opponent</p>');
                                    let statusInterval = setInterval(function () {
                                        if(STATUS)
                                            clearInterval(statusInterval);
                                        checkStatus(role)
                                    },3000)
                                }
                            }
                        }

                    },
                    error:function (response) {

                    }
                })

            })
            $(document).on('click','#finish_round',function () {
                let finish_button = $(this);
                finish_button.attr('disabled',true);
                finishRoundDynamicly(finish_button);
            })
            function setRoundChangeTimeout(time){
                makeRoundTimer(time,finishRoundDynamicly);
            }
            function setRegisterState(nextState) {
                switch (nextState) {
                    case NOT_REGISTERED:
                        $('#call').attr('disabled', true);
                        $('#terminate').attr('disabled', true);
                        break;

                    case REGISTERED:
                        setCallState(NO_CALL);
                        break;

                    default:
                        return;
                }
                registerState = nextState;
            }

            function setCallState(nextState) {
                switch (nextState) {
                    case NO_CALL:
                        $('#call').attr('disabled', false);
                        $('#terminate').attr('disabled', true);
                        break;

                    case PROCESSING_CALL:
                        $('#call').attr('disabled', true);
                        $('#terminate').attr('disabled', true);
                        break;
                    case IN_CALL:
                        $('#call').attr('disabled', true);
                        $('#terminate').attr('disabled', false);
                        break;
                    default:
                        return;
                }
                callState = nextState;
            }

            window.onload = function() {
                setRegisterState(NOT_REGISTERED);

                videoInput = document.getElementById('videoInput');
                videoOutput = document.getElementById('videoOutput');

                $('#call').on('click', function() {
                    call();
                });
                $('#terminate').on('click', function() {
                    $.ajax({
                        url: '{{route('battle.change.status')}}',
                        type: "post",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            battle:BATTLE_ID,
                            state:'end'
                        },
                        success: function (response) {

                        },
                        error:function (response) {

                        }
                    })
                    stop();
                });
            }

            window.onbeforeunload = function() {
                wsVideo.close();
            }

            wsVideo.onmessage = function(message) {
                var parsedMessage = JSON.parse(message.data);
                switch (parsedMessage.id) {
                    case 'registerResponse':
                        resgisterResponse(parsedMessage);
                        break;
                    case 'callResponse':
                        callResponse(parsedMessage);
                        break;
                    case 'incomingCall':
                        incomingCall(parsedMessage);
                        break;
                    case 'startCommunication':
                        startCommunication(parsedMessage);
                        break;
                    case 'stopCommunication':
                        console.info("Communication ended by remote peer");
                        break;
                    case 'iceCandidate':
                        webRtcPeer.addIceCandidate(parsedMessage.candidate)
                        break;
                    case 'ffmpeg':
                        console.log('From ffmpeg:', parsedMessage.data);
                        break;
                    case "rtmp":
                        console.log('Recv rtmp request:', parsedMessage.data);
                        break;
                    default:
                        console.error('Unrecognized message', parsedMessage);
                }
            }
            function resgisterResponse(message) {
                if (message.response == 'accepted') {
                    setRegisterState(REGISTERED);
                } else {
                    setRegisterState(NOT_REGISTERED);
                    var errorMessage = message.message ? message.message
                        : 'Unknown reason for register rejection.';
                    console.log(errorMessage);
                    alert('Error registering user. See console for further information.');
                }
            }
            function makeTimeLive(time) {
                let minutes = Math.floor(time / 60);
                time %= 60;
                let minutesText = minutes < 10 ? '0' + minutes : minutes;
                let secondsText = time < 10 ? '0' + time : time;
                return minutesText + ':' + secondsText;
            }
            function makeRoundTimer(time,callback){
                let timerPlace = $('<div class="battle_timer"> </div>');
                $('.battle_timer_desc').append(timerPlace);
                let timer = setInterval(function () {
                    if(!time){
                        clearInterval(timer)
                        timerPlace.remove()
                        callback()
                    }
                    timerPlace.text(makeTimeLive(time--));
                }, 1000);
            }
            function makeTimeFromBattle(time) {
                let days = Math.floor(time / 86400);
                let daysText = '';
                if(days){
                    daysText = days < 10 ? '0' + days + ' d ' : days + ' d ';
                }
                time %= 86400;
                let hours = Math.floor(time / 3600);
                time %= 3600;
                let hoursText = hours < 10 ? '0' + hours : hours ;
                let minutes = Math.floor(time / 60);
                time %= 60;
                let minutesText = minutes < 10 ? '0' + minutes : minutes;
                let secondsText = time < 10 ? '0' + time : time;
                return daysText + hoursText + ':' + minutesText + ':' + secondsText;
            }

            function countUpFromBattle(time,timerPlace){
                let timer = setInterval(function () {
                    timerPlace.text(makeTimeFromBattle(time++));
                }, 1000);
            }
            function callResponse(message) {
                console.log('callllllllllll response')
                if (message.response != 'accepted') {
                    console.info('Call not accepted by peer. Closing call');
                    var errorMessage = message.message ? message.message
                        : 'Unknown reason for call rejection.';
                    console.log(message);
                    stop(true);
                } else {
                    setCallState(IN_CALL);
                    if(SELF === 'creator' && STATE !== 'live'){
                        if(SCREEN_TYPE !== 'auto'){
                            $('#battles_live_center').append('<div class="finish_round_div">\n' +
                                '                        <div class="finish_round_button_place">\n' +
                                '                              <button class="btn" id="finish_round">Finish Round </button>\n' +
                                '                        </div>\n' +
                                '                    </div>');
                        }

                        animateArray([
                            {
                                text:'round 1',
                                color:'red'
                            },
                            {
                                text:'your turn!',
                                color:'orange'
                            }
                        ])
                        startTurn();
                        if(SCREEN_TYPE === 'auto'){
                            setRoundChangeTimeout(parseInt(CHANGE_TIME));
                        }

                        $('.battle_round').text('Round 1/'+ "{{$battle->rounds}}")
                        $('#timer_place_count').empty().append('<p class="orange">live for <span id="count_up_battle"></span></p>');
                        countUpFromBattle(0,$('#count_up_battle'))
                    }
                    else if(STATE !== 'live'){
                        $('.battle_round').text('Round 1/'+ "{{$battle->rounds}}")
                        animateArray([
                            {
                                text:'round 1',
                                color:'red'
                            }
                        ])
                    }

                    STATE = 'live';
                    webRtcPeer.processAnswer(message.sdpAnswer);
                }
            }
            let PLAYER_CONFIG = 'player_config_' + BATTLE_ID;
            Echo.channel(PLAYER_CONFIG)
                .listen('.player_configuration', e => {
                    if(e.data.player === SELF){
                        if(e.data.type === 'end_round'){
                            if (e.data.round_turn){
                                $('.battle_round').text('Round ' + e.data.round + "{{'/'.$battle->rounds}}")
                            }
                            if(e.data.round == "{{$battle->rounds}}" && "{{$battle->rounds}}" != 1){
                                animateArray([
                                    {
                                        text:'round ' + e.data.round,
                                        color:'red'
                                    },
                                    {
                                        text:'final ',
                                        color:'red'
                                    },
                                    {
                                        text:'your turn!',
                                        color:'orange'
                                    }
                                ])
                            }else{
                                animateArray([
                                    {
                                        text:'round ' + e.data.round,
                                        color:'red'
                                    },
                                    {
                                        text:'your turn!',
                                        color:'orange'
                                    }
                                ])
                            }
                            startTurn();
                            if(SCREEN_TYPE === 'auto'){
                                setRoundChangeTimeout(parseInt(CHANGE_TIME));
                            }
                            if(SCREEN_TYPE !== 'auto'){
                                if(e.data.round == "{{$battle->rounds}}" && SELF === 'joiner'){
                                    $('#battles_live_center').append('<div class="finish_round_div">\n' +
                                        '                        <div class="finish_round_button_place">\n' +
                                        '                              <button class="btn" id="finish_round">Finish battle </button>\n' +
                                        '                        </div>\n' +
                                        '                    </div>');
                                }else{
                                    $('#battles_live_center').append('<div class="finish_round_div">\n' +
                                        '                        <div class="finish_round_button_place">\n' +
                                        '                              <button class="btn" id="finish_round">Finish Round </button>\n' +
                                        '                        </div>\n' +
                                        '                    </div>');
                                }
                            }


                        }else if(e.data.type === 'end_battle'){
                            battleTextAnimation('battle ended','red');
                            endTurn();
                            stop();
                        }
                    }

                })
            function startCommunication(message) {
                console.log('calllllllllllllll startcomm')
                if(STATE !== 'live'){
                    $.ajax({
                        url: '{{route('battle.change.status')}}',
                        type: "post",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            battle:BATTLE_ID,
                            state:'start'
                        },
                        success: function (response) {

                            if(SELF === 'creator'){
                                if(SCREEN_TYPE !== 'auto'){
                                    $('#battles_live_center').append('<div class="finish_round_div">\n' +
                                        '                        <div class="finish_round_button_place">\n' +
                                        '                             <button class="btn" id="finish_round">Finish Round </button>\n' +
                                        '                        </div>\n' +
                                        '                    </div>');
                                }
                                animateArray([
                                    {
                                        text:'round 1',
                                        color:'red'
                                    },
                                    {
                                        text:'your turn!',
                                        color:'orange'
                                    }
                                ])
                                startTurn()
                                if(SCREEN_TYPE === 'auto'){
                                    setRoundChangeTimeout(parseInt(CHANGE_TIME));
                                }
                            }
                            $('.battle_round').text('Round 1/' + "{{$battle->rounds}}")
                            $('#timer_place_count').empty().append('<p class="orange">live for <span id="count_up_battle"></span></p>');
                            countUpFromBattle(0,$('#count_up_battle'))

                        },
                        error:function (response) {

                        }
                    })
                }
                setCallState(IN_CALL);
                STATE = 'live';

                $('#start_button_div').css('display','none')
                $('#end_button_div').css('display','flex')
                webRtcPeer.processAnswer(message.sdpAnswer);
            }
            function battleTextAnimation(message,color){
                let text = $('<div class="animation_message animate__animated animate__bounceIn '+ color +'"> </div>');
                text.text(message);
                $('.animation_message_place').append(text);
                setTimeout(function () {
                    text.remove();
                },1500)
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
            function incomingCall(message) {
                console.log('callllllllllllllllllllllllllllll    incoming ')
                // If bussy just reject without disturbing user
                /*if (callState != NO_CALL) {
                    var response = {
                        id : 'incomingCallResponse',
                        from : message.from,
                        callResponse : 'reject',
                        message : 'bussy'

                    };
                    return sendMessage(response);
                }*/
                setCallState(IN_CALL);
                var options = {
                    localVideo : videoInput,
                    remoteVideo : videoOutput,
                    onicecandidate : onIceCandidate
                }

                webRtcPeer = kurentoUtils.WebRtcPeer.WebRtcPeerSendrecv(options,
                    function(error) {
                        if (error) {
                            console.error(error);
                            setCallState(NO_CALL);
                        }

                        this.generateOffer(function(error, offerSdp) {
                            if (error) {
                                console.error(error);
                                setCallState(NO_CALL);
                            }
                            var response = {
                                id : 'incomingCallResponse',
                                from : message.from,
                                callResponse : 'accept',
                                sdpOffer : offerSdp
                            };
                            sendMessage(response);
                        });
                    });
            }
            function onOffer(error, offerSdp) {
                if (error) return onError(error);

                console.info('Invoking SDP offer callback function ' + location.host);
                var message = {
                    id: 'start',
                    sdpOffer: offerSdp
                }
                sendMessage(message);
            }
            function onError(error) {
                console.error(error);
            }
            function register() {


                setRegisterState(REGISTERING);

                var message = {
                    id : 'register',
                    name : name,
                    battle:BATTLE_ID
                };
                sendMessage(message);
            }

            function call() {

                setCallState(PROCESSING_CALL);



                var options = {
                    localVideo : videoInput,
                    remoteVideo : videoOutput,
                    onicecandidate : onIceCandidate
                }

                webRtcPeer = kurentoUtils.WebRtcPeer.WebRtcPeerSendrecv(options, function(
                    error) {
                    if (error) {
                        console.error(error);
                        setCallState(NO_CALL);
                    }

                    this.generateOffer(function(error, offerSdp) {
                        if (error) {
                            console.error(error);
                            setCallState(NO_CALL);
                        }
                        var message = {
                            id : 'call',
                            from : name,
                            to : opponent,
                            sdpOffer : offerSdp
                        };
                        sendMessage(message);
                    });
                });

            }

            function stop(message) {
                setCallState(NO_CALL);
                if (webRtcPeer) {
                    webRtcPeer.dispose();
                    webRtcPeer = null;

                    if (!message) {
                        var message = {
                            id : 'stop'
                        }
                        sendMessage(message);
                    }
                }
            }

            function sendMessage(message) {
                var jsonMessage = JSON.stringify(message);
                console.log('Sending message: ' + jsonMessage);
                wsVideo.send(jsonMessage);
            }

            function onIceCandidate(candidate) {
                console.log('Local candidate' + JSON.stringify(candidate));

                var message = {
                    id : 'onIceCandidate',
                    candidate : candidate
                }
                sendMessage(message);
            }




        </script>

    @endpush
@endsection
