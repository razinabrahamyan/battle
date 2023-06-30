let MESSAGE_ENVELOPE = $('#message_notification');
let IS_ON_CHAT_PAGE = $('#is_on_chat_page').val();
let DROPDOWN_CHATS_PLACE = $('#messages_desk_dropdown');
let dropdown_chats = $('.dropdown_chat');
let unread_ids = [];
let TYPING_CHATS = {};
let COOL_TIMEOUT;

dropdown_chats.map(function (index,chat) {
    let jquery_chat  = $(chat);
    if(jquery_chat.data('unread') === 'yes'){
        unread_ids.push(parseInt(jquery_chat.data('info')))
    }

})
function ownMessage(message,avatar,time){
    return '<div class="own_message animate__fadeIn animate__animated">\n' +
        '                       <div class="own_message_info">\n' +
        '                           <div class="own_message_body">\n' +
        '                               <p class="message">' + message + '</p>\n' +
        '                           </div>\n' +
        '                           <p class="message_time">' + time + '</p>\n' +
        '                       </div>\n' +
        '\n' +
        '                       <img class="avatar_image" src="/storage/user/images/avatar/' + avatar + '" alt="">\n' +
        '                   </div>'
}
function opponentMessage(message,avatar,time){
    return '<div class="opponent_message animate__fadeIn animate__animated">\n' +
        '                       <img class="avatar_image" src="/storage/user/images/avatar/' + avatar + '" alt="">\n' +
        '                       <div class="opponent_message_info">\n' +
        '                           <div class="opponent_message_body">\n' +
        '                               <p class="message">' + message + '</p>\n' +
        '                           </div>\n' +
        '                           <p class="message_time">' + time + '</p>\n' +
        '                       </div>\n' +
        '\n' +
        '                   </div>'
}
function makeChatActive(id) {
    let chat = $('#chat_' + id);
    chat.find('.chat_last_message').addClass('active');
}
function makeChatFirst(id) {
    let chat = $('#chat_' + id);
    chat.remove();
    chats_place.prepend(chat)
}
function makeChatMessageUnseen(id) {
    let chat = $('#chat_' + id);
    chat.find('.last_message_holder').addClass('unseen')
}
function updateChatInfo(id,message,time,self = false) {
    let chat = $('#chat_' + id);
    let imagePlace = chat.find('.message_image_holder').empty();
    if(self){
        imagePlace.append('<img src="/storage/user/images/avatar/' + SELF_AVATAR + '" alt="">')
    }

    chat.find('.last_message_body').text(message)
    chat.find('.time').text(time)
}
function makeDropdownChatFirst(id) {
    let chat = $('#dropdown_chat_' + id);
    chat.remove();
    DROPDOWN_CHATS_PLACE.prepend(chat);
}

function makeDropdownChatMessageUnseen(id) {
    let chat = $('#dropdown_chat_' + id);
    chat.find('.drop_message_body_handler').addClass('unseen')
}

function makeDropdownChatMessageSeen(id) {
    let chat = $('#dropdown_chat_' + id);
    chat.find('.drop_message_body_handler').removeClass('unseen')
}

function updateDropdownChatInfo(id,message,time,self = false) {
    let chat = $('#dropdown_chat_' + id);
    let imagePlace = chat.find('.message_image_holder').empty();
    if(self){
        imagePlace.append('<img src="/storage/user/images/avatar/' + SELF_AVATAR + '" alt="">')
    }
    chat.find('.drop_mess_body_text').text(message)
    chat.find('.dropdown_message_time').text(time)
}
function updateDropdownMessageCounter() {
    let counter_div = $('#message_icon_count');
    if (!counter_div.hasClass('has')){
        counter_div.addClass('has')
        counter_div.text(1);
    }else{
        let inner_count = parseInt(counter_div.text());
        counter_div.text(inner_count + 1);
    }
}
function checkUnreadChatAvailability(id) {
    let id_int = parseInt(id);
    let itog = true;
    unread_ids.forEach(function (index) {
        if (id_int === index){
            itog =  false
        }
    })
    return itog;
}
function startChatTyping(id) {
    let chat = $('#chat_' + id);
    chat.find('.message_text_holder').addClass('typing')
}
function endChatTyping(id) {
    let chat = $('#chat_' + id);
    chat.find('.message_text_holder').removeClass('typing')
}
function forceEndTyping(id) {
    endChatTyping(id)
    clearTimeout(TYPING_CHATS[id]);
}
function endTypingAnimation() {
    $('.chat_part').removeClass('typing')
    clearTimeout(COOL_TIMEOUT)
}
function addDropdownChat(id,chat_user) {
    let chat = $('<div class="p-2 dropdown_chat" id="dropdown_chat_'+ id +'" data-unread="yes" data-info="'+ id +'">\n' +
        '                                <a href="/chat/' + chat_user.nickname +'">\n' +
        '                                    <div class="message_dropdown_item">\n' +
        '                                        <img class="main_image" src="/storage/user/images/avatar/' + chat_user.avatar +'" alt="">\n' +
        '                                        <div class="pl-2 w-100">\n' +
        '                                            <div class="d-flex justify-content-between">\n' +
        '                                                <p class="m-0 drop_user">' + chat_user.nickname +'</p>\n' +
        '                                                <span class="dropdown_message_time"></span>\n' +
        '                                            </div>\n' +
        '                                            <div class="drop_message_body_handler unseen">\n' +
        '                                                <div class="drop_message_body">\n' +
        '                                                    <div class="message_image_holder">\n' +
        '                                                    </div>\n' +
        '                                                    <span class="drop_mess_body_text"> </span>\n' +
        '                                                </div>\n' +
        '                                                <div class="not_seen_sign"></div>\n' +
        '                                            </div>\n' +
        '\n' +
        '\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                </a>\n' +
        '                            </div>')
    DROPDOWN_CHATS_PLACE.append(chat)

}

function addChat(id,chat_user) {
    let chat = $('<a href="/chat/' + chat_user.nickname +'" id="chat_'+ id +'">\n' +
        '                           <div class="chat_last_message  " >\n' +
        '                               <div>\n' +
        '                                   <img class="main_image" src="/storage/user/images/avatar/' + chat_user.avatar +'" alt="">\n' +
        '                               </div>\n' +
        '                               <div class="chat_last_body">\n' +
        '                                   <div class="last_body_header">\n' +
        '                                       <p class="nickname">' + chat_user.nickname +'</p>\n' +
        '                                       <p class="time"></p>\n' +
        '                                   </div>\n' +
        '\n' +
        '                                   <div class="last_message_holder">\n' +
        '\n' +
        '\n' +
        '                                       <div class="last_message_body_handler">\n' +
        '                                           <div class="message_image_holder">\n' +
        '\n' +
        '                                           </div>\n' +
        '                                           <p class="last_message_body"></p>\n' +
        '                                       </div>\n' +
        '                                       <div class="not_seen_sign"></div>\n' +
        '                                   </div>\n' +
        '                               </div>\n' +
        '                           </div>\n' +
        '                       </a>');
    chats_place.append(chat)

}

$(document).ready(function () {
    if(IS_ON_CHAT_PAGE){
        CHAT_MAIN_BUTTON.click(function () {
            if(chat_input.val() && chat_input.val().length <= 200){
                let value = chat_input.val();
                chat_input.val('')
                $.ajax({
                    url: MESSAGE_SEND_ROUTE,
                    type: "post",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        message:value,
                        opponent:CHAT_OPPONENT_ID,
                    },
                    success: function (response) {
                        let d = new Date();
                        let timeOfMessage = d.getHours() + ':' + d.getMinutes();
                        let chat_id = response.chat_id;
                        if(response.first_message){
                            addChat(chat_id,response.chat_user);
                            updateChatInfo(chat_id,value,timeOfMessage,true)
                            makeChatActive(chat_id);
                            makeChatFirst(chat_id);
                            FirstOfChats = chat_id;
                            CURRENT_CHAT = chat_id;
                        }else{
                            if(FirstOfChats != CURRENT_CHAT){

                                updateChatInfo(chat_id,value,timeOfMessage,true)
                                makeChatFirst(chat_id)
                                CURRENT_CHAT = chat_id;
                                FirstOfChats = chat_id;
                            }else{

                                updateChatInfo(chat_id,value,timeOfMessage,true)
                            }
                        }
                        desk.append(ownMessage(value,SELF_AVATAR,timeOfMessage))
                        desk.stop().animate({ scrollTop: desk.prop("scrollHeight")}, 2000);

                    },
                    error:function (response) {
                    }
                })
            }
        })

    }


    Echo.private('message.'+ CHANNEL_VARIABLE)
        .listen('.new_chat_message', e => {
            if(e.type === 'message'){
                let chat_id = e.data.chat_id;
                forceEndTyping(chat_id)
                if(IS_ON_CHAT_PAGE){
                    if(e.data.first_message){
                        if(e.data.chat_user.id == CHAT_OPPONENT_ID){
                            endTypingAnimation();
                            desk.append(opponentMessage(e.data.message,e.user.avatar,e.data.time))
                            desk.stop().animate({ scrollTop: desk.prop("scrollHeight")}, 2000);
                            addChat(chat_id,e.data.chat_user);
                            updateChatInfo(chat_id,e.data.message,e.data.time)
                            makeChatActive(chat_id);
                            makeChatFirst(chat_id);
                            FirstOfChats = chat_id;
                            CURRENT_CHAT = chat_id;
                        }else{
                            addChat(chat_id,e.data.chat_user);
                            updateChatInfo(chat_id,e.data.message,e.data.time)
                            makeChatFirst(chat_id);
                            makeChatMessageUnseen(chat_id);
                            FirstOfChats = chat_id;
                        }
                    }else{
                        if(e.data.chat_user.id == CHAT_OPPONENT_ID){
                            desk.append(opponentMessage(e.data.message,e.user.avatar,e.data.time))
                            desk.stop().animate({ scrollTop: desk.prop("scrollHeight")}, 2000);
                            updateChatInfo(chat_id,e.data.message,e.data.time)
                            makeChatActive(chat_id);
                            makeChatFirst(chat_id);
                            FirstOfChats = chat_id;
                            CURRENT_CHAT = chat_id;
                        }else{
                            updateChatInfo(chat_id,e.data.message,e.data.time)
                            makeChatFirst(chat_id);
                            makeChatMessageUnseen(chat_id);
                            FirstOfChats = chat_id;
                        }

                    }
                    if(e.data.chat_user.id == CHAT_OPPONENT_ID){
                        $.ajax({
                            url: MESSAGE_SEEN_ROUTE,
                            type: "post",
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                chat:CURRENT_CHAT,
                            },
                            success: function (response) {

                            },
                            error:function (response) {
                            }
                        })
                    }
                }
                if(e.data.first_message){
                    addDropdownChat(chat_id,e.data.chat_user)
                }
                updateDropdownChatInfo(chat_id,e.data.message,e.data.time)
                makeDropdownChatFirst(chat_id)
                if(IS_ON_CHAT_PAGE && e.data.chat_user.id == CHAT_OPPONENT_ID){
                    makeDropdownChatMessageSeen(chat_id)
                }else{
                    makeDropdownChatMessageUnseen(chat_id)
                    if(checkUnreadChatAvailability(chat_id)){
                        MESSAGE_ENVELOPE.removeClass('wiggled');
                        MESSAGE_ENVELOPE.outerWidth(MESSAGE_ENVELOPE.outerWidth());
                        MESSAGE_ENVELOPE.addClass('wiggled');
                        updateDropdownMessageCounter();
                        unread_ids.push(parseInt(chat_id))
                    }
                }
            }else if(e.type === 'typing'){
                let chat_id = e.data.chat_id;
                startChatTyping(chat_id)
                if (TYPING_CHATS[chat_id] != undefined) clearTimeout(TYPING_CHATS[chat_id]);
                TYPING_CHATS[chat_id] = setTimeout(function () {
                    forceEndTyping(chat_id)
                },2000)
                if(e.user.id == CHAT_OPPONENT_ID){
                    $('.chat_part').addClass('typing')
                    if (COOL_TIMEOUT != undefined) clearTimeout(COOL_TIMEOUT);
                    COOL_TIMEOUT = setTimeout(function () {
                        endTypingAnimation();
                    },2000)
                }

            }



        })
})
