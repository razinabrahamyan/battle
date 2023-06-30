<ul class="navbar-nav app_auth align-items-center" >
    <li class="nav-item d-flex">
        <div class="d-none align-items-center languages_div">
            <a class="m-1" href="{{route('set.locale',['am','user'])}}" >
                <img @if(app()->isLocale('am')) class="selected" @endif src="{{asset('storage/user/images/languages/armenia.png')}}" alt="">
            </a>
            <a class="m-1" href="{{route('set.locale',['en','user'])}}">
                <img @if(app()->isLocale('en')) class="selected" @endif src="{{asset('storage/user/images/languages/usa.png')}}" alt="">
            </a>
            <a class="m-1 mr-2" href="{{route('set.locale',['ru','user'])}}">
                <img @if(app()->isLocale('ru')) class="selected" @endif src="{{asset('storage/user/images/languages/russia.png')}}" alt="">
            </a>

        </div>
    </li>
    @auth
        <li class="nav-item messages_part_button dropdown">
            <a class="nav-link mr-2 buttoned " href="#" id="message_dropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div  id="message_notification">
                    <div class="position-relative" id="message_place">
                        <div class="notification_bell " id="message_icon">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <path d="M467,80.609H45c-24.813,0-45,20.187-45,45v260.782c0,24.813,20.187,45,45,45h422c24.813,0,45-20.187,45-45V125.609
                                            C512,100.796,491.813,80.609,467,80.609z M461.127,110.609l-6.006,5.001L273.854,266.551c-10.346,8.614-25.364,8.614-35.708,0
                                            L56.879,115.61l-6.006-5.001H461.127z M30,132.267L177.692,255.25L30,353.543V132.267z M467,401.391H45
                                            c-7.248,0-13.31-5.168-14.699-12.011l171.445-114.101l17.204,14.326c10.734,8.938,23.893,13.407,37.051,13.407
                                            c13.158,0,26.316-4.469,37.051-13.407l17.204-14.326l171.444,114.1C480.31,396.224,474.248,401.391,467,401.391z M482,353.543
                                            l-147.692-98.292L482,132.267V353.543z"/>
                                    </g>
                            </svg>
                        </div>
                        <div id="message_icon_count" class="message_icon_handler {{$unread_messages_count ? 'has':''}}">{{$unread_messages_count}}</div>
                    </div>
                </div>

            </a>
            <div class="dropdown-menu dropdown-menu-right main_message_desc battle_overflow" aria-labelledby="message_dropdown">
                <p class="notif_header">Messages</p>
                <div id="messages_desk_dropdown">

                        @foreach($chats as $chat)
                            @php
                                $chat_user = null;
                                     if ($chat->from == auth()->id()){
                                         $chat_user = $chat->toUser;
                                     }else{
                                         $chat_user = $chat->fromUser;
                                     }
                            @endphp
                            <div class="p-2 dropdown_chat" id="dropdown_chat_{{$chat->id}}" data-unread="{{$chat->lastmessage && $chat->lastmessage->sender->id !== auth()->id() && !$chat->lastmessage->read_at ? 'yes' : 'no'}}" data-info="{{$chat->id}}">
                                <a href="{{route('chat',$chat_user->nickname)}}">
                                    <div class="message_dropdown_item">
                                        <img class="main_image" src="{{asset('storage/user/images/avatar/'.$chat_user->avatar)}}" alt="">
                                        <div class="pl-2 w-100">
                                            <div class="d-flex justify-content-between">
                                                <p class="m-0 drop_user">{{$chat_user->nickname}}</p>
                                                <span class="dropdown_message_time">{{\Carbon\Carbon::parse($chat->lastmessage->created_at)->format('H:i')}}</span>
                                            </div>
                                            <div class="drop_message_body_handler {{$chat->lastmessage && $chat->lastmessage->sender->id !== auth()->id() && !$chat->lastmessage->read_at ? 'unseen' : ''}}">
                                                <div class="drop_message_body">
                                                    <div class="message_image_holder">
                                                        @if($chat->lastmessage->sender->id == auth()->id())
                                                            <img class="message_image" src="{{asset('storage/user/images/avatar/'.auth()->user()->avatar)}}" alt="">
                                                        @endif
                                                    </div>
                                                    <span class="drop_mess_body_text"> {{$chat->lastmessage ? $chat->lastmessage->message['body'] : ''}}</span>
                                                </div>
                                                <div class="not_seen_sign"></div>
                                            </div>


                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                </div>

            </div>
    @endauth


    </li>
    <li class="nav-item dropdown notif_part_button"  style="display: flex;align-items: center;">
        <a class="nav-link mr-2 buttoned" href="#" id="notif_dropdown" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="position-relative" id="notification_place">
                <div class="notification_bell @auth() @if(auth()->user()->unreadNotifications->count()) @if(!session()->has('first_entry_bell')) <?php session()->push('first_entry_bell','false') ?> notify @endif @endif @endauth" id="notif_bell">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.2" height="26.609" viewBox="0 0 19.76 21.729">
                        <g id="Icon_feather-bell" data-name="Icon feather-bell" transform="translate(1 1)">
                            <path id="Path_6714" data-name="Path 6714" d="M19.3,8.63A5.781,5.781,0,0,0,13.38,3,5.781,5.781,0,0,0,7.46,8.63c0,6.569-2.96,8.446-2.96,8.446H22.26S19.3,15.2,19.3,8.63" transform="translate(-4.5 -3)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            <path id="Path_6715" data-name="Path 6715" d="M19.32,31.5a2.263,2.263,0,0,1-3.915,0" transform="translate(-8.483 -12.898)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </g>
                    </svg>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right notification_dropdown" aria-labelledby="notif_dropdown">
            <p class="notif_header">Notifications</p>
            <div class="battle_overflow main_notification_desc p-2">
                @guest()
                    <div class="p-2">
                        <p class="p-3">You`re Not Authorized</p>
                    </div>
                @endguest
            </div>


        </div>
    </li>

    @auth()
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('storage/user/images/avatar/'.auth()->user()->avatar)}}"
                     class="navbar_profile_icon" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('front.public.profile')}}">Profile</a>
                <a class="dropdown-item" href="{{route('front.dashboard')}}">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item logout_link"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endauth
    @guest()
        <li class="nav-item">
            <button id="login_modal_button" type="button" data-toggle="modal" data-target="#loginModal" class="nav-link login_text">Log in</button>
        </li>
    @endguest

</ul>
