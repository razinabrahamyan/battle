@extends('user_dashboard.layouts.single_app')
@section('title', 'Chat')
@section('navbar_title', 'Messages')
@section('content')
    <div class="chat_main_body">
       <div class="d-flex mt-3">
           <div class="col-8 chat_part">
               <div class="chat_header_user">
                   <img src="{{asset('storage/user/images/avatar/'.$opponent->avatar)}}" alt="">
                   <div class="pl-2">
                       <p class="nickname">{{$opponent->nickname}}</p>
                   {{--    <p class="status"><i class="fa fa-circle mr-1"></i>offline</p>--}}
                   </div>
               </div>
               <div class="chat_right_padded">
                   <div class="chat_bordered mt-3"></div>
               </div>


               <div class="chat_messages_desk chat_overflow" id="chat_desk">
                   @foreach($messages as $message)
                       @if($message->from == auth()->id())
                           <div class="own_message">
                               <div class="own_message_info">
                                   <div class="own_message_body">
                                       <p class="message">{{$message->message['body']}}</p>
                                   </div>
                                   <p class="message_time">{{\Carbon\Carbon::parse($message->created_at)->format('H:i')}}</p>
                               </div>

                               <img class="avatar_image" src="{{asset('storage/user/images/avatar/'.$message->sender->avatar)}}" alt="">
                           </div>
                       @else
                           <div class="opponent_message">
                               <img class="avatar_image" src="{{asset('storage/user/images/avatar/'.$message->sender->avatar)}}" alt="">
                               <div class="opponent_message_info">
                                   <div class="opponent_message_body">
                                       <p class="message">{{$message->message['body']}}</p>
                                   </div>
                                   <p class="message_time">{{\Carbon\Carbon::parse($message->created_at)->format('H:i')}}</p>
                               </div>

                           </div>
                       @endif

                   @endforeach

               </div>


               <div class="chat_input_handler">
                   <div class="chat_input_desk">
                       <input type="text" id="chat_input">
                       <button class="btn chat_send_button" id="send_button">send</button>
                   </div>
               </div>


           </div>
           <div class="col-4 all_chats_part">
               <input type="hidden" id="first_of_chats" value="{{$chats->first()?$chats->first()->id:0}}">
               <h3>chats</h3>
               <div id="last_chats">
                   @forelse($chats as $chat)
                       @php
                           $chat_user = null;
                                if ($chat->from == auth()->id()){
                                    $chat_user = $chat->toUser;
                                }else{
                                    $chat_user = $chat->fromUser;
                                }
                       @endphp
                       <a href="{{route('chat',$chat_user->nickname)}}" id="chat_{{$chat->id}}">
                           <div class="chat_last_message @if($chat->id == $current_chat) active @endif" >
                               <div>
                                   <img class="main_image" src="{{asset('storage/user/images/avatar/'.$chat_user->avatar)}}" alt="">
                               </div>
                               <div class="chat_last_body">
                                   <div class="last_body_header">
                                       <p class="nickname">{{$chat_user->nickname}}</p>
                                       <p class="time">{{\Carbon\Carbon::parse($chat->lastmessage->created_at)->format('H:i')}}</p>
                                   </div>
                                   <div class="message_text_holder">
                                       <div class="last_message_holder {{$chat->lastmessage && $chat->lastmessage->sender->id !== auth()->id() && !$chat->lastmessage->read_at ? 'unseen' : ''}}">
                                           <div class="last_message_body_handler">
                                               <div class="message_image_holder">
                                                   @if($chat->lastmessage->sender->id == auth()->id())
                                                       <img  src="{{asset('storage/user/images/avatar/'.auth()->user()->avatar)}}" alt="">
                                                   @endif
                                               </div>
                                               <p class="last_message_body">{{$chat->lastmessage ? $chat->lastmessage->message['body'] : ''}}</p>
                                           </div>
                                           <div class="not_seen_sign"></div>
                                       </div>
                                       <div class="user_typing_part">
                                           <div class="user_is_typing">
                                               <div>

                                               </div>
                                               <div class="typing_wrapper">
                                                   <div class="circle" id="circle1"></div>
                                                   <div class="circle" id="circle2"></div>
                                                   <div class="circle" id="circle3"></div>
                                               </div>
                                           </div>
                                       </div>

                                   </div>

                               </div>
                           </div>
                       </a>
                   @empty
                   @endforelse

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
                                            <input type="hidden" id="is_on_chat_page" value="yes">
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


    <script>
        let desk = $('#chat_desk');
        desk.scrollTop(desk.prop("scrollHeight"));
        let chat_input = $('#chat_input');
        let FirstOfChats = $('#first_of_chats').val();
        let CURRENT_CHAT = "{{$current_chat}}";
        let chats_place = $('#last_chats');
        let CHAT_MAIN_BUTTON = $('#send_button');
        let MESSAGE_SEND_ROUTE = "{{route('chat.send.message')}}";
        let MESSAGE_SEEN_ROUTE = "{{route('chat.message.seen')}}";
        let MESSAGE_TYPING_ROUTE = "{{route('chat.typing')}}";
        let CHAT_OPPONENT_ID = "{{$opponent->id}}";
        let SELF_AVATAR = "{{auth()->user()->avatar}}";

        let searchTimeout;
        let IS_TYPING = false;
        setInterval(function () {
            if(IS_TYPING){
                $.ajax({
                    url: MESSAGE_TYPING_ROUTE,
                    type: "post",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        opponent:CHAT_OPPONENT_ID,
                    },
                    success: function (response) {
                    },
                    error:function (response) {
                    }
                })
            }
        },500)
        chat_input.keyup(function (ev) {
            if(ev.which === 13){
                CHAT_MAIN_BUTTON.click()
            }else{
                IS_TYPING = true;
                if (searchTimeout != undefined) clearTimeout(searchTimeout);
                searchTimeout = setTimeout(callServerScript, 250);

                function callServerScript() {
                    IS_TYPING = false;
                }
            }

        })


    </script>

@endsection

