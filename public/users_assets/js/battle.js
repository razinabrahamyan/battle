function random(num) {
    return Math.floor(Math.random()*num)+1
}
setTimeout(function () {
    $('.create_battle_fixed').addClass('animate__animated animate__fadeOut')
},1000)
$(document).ready(function () {
    function openFirstEmojis(){
        $('#first_emoji_handler').css('display','block').removeClass('animate__fadeOut').addClass('animate__fadeIn');
    }
    function openSecondEmojis(){
        $('#second_emoji_handler').css('display','block').removeClass('animate__fadeOut').addClass('animate__fadeIn');
    }
    function closeFirstEmojis(){
        $('#first_emoji_handler').removeClass('animate__fadeIn').addClass('animate__fadeOut').css('display','none');
    }
    function closeSecondEmojis(){
        $('#second_emoji_handler').removeClass('animate__fadeIn').addClass('animate__fadeOut').css('display','none');
    }
    let video_div = $('#battle_video_div');
    let message_div = $('#message_desc');
    let message_height = video_div.height()-177;
    message_div.css('height',message_height+'px');
    $('#close_messages').click(function () {
        $('#chat').removeClass('opened_chat').removeClass('animate__fadeInRight').addClass('animate__fadeOutRight')
        $('#battles_flexible_desc').removeClass('opened_chat');
        $('.chat_open_handler').css('display','block').addClass('animate__animated animate__fadeIn');
    })
    $('.chat_open_handler').click(function () {
        $('#battles_flexible_desc').addClass('opened_chat ');
        $('#chat').removeClass('animate__fadeOutRight').addClass('animate__fadeInRight opened_chat')
        $(this).css('display','none')
    })
    $('#first_player_emoji_value').click(function () {
        openFirstEmojis()
    })
    $('#second_player_emoji_value').click(function () {
        openSecondEmojis()
    })
    function sendMessage(data){
        $.ajax({
            url: MESSAGE_ROUTE,
            type: "post",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: data,
            success: function (response) {
                if(response.type === 'message'){
                    input.val('')
                }
            },
            error:function (response) {
            }
        })
    }
    function setReaction(desc,data,emoji,align){
        desc.html(emoji).addClass('chosen');
        let smile;
        if(align === 'left'){
            smile = $('<div class="heart_left style'+ random(4) +'">'+ emoji +'</div>');
            $('#flying_smiles_left').append(smile);
        }else{
            smile = $('<div class="heart style'+ random(4) +'">'+ emoji +'</div>');
            $('#flying_smiles_right').append(smile);
        }

        setTimeout(function () {
            smile.remove()
        },4000);
        $.ajax({
            url: REACTION_ROUTE,
            type: "post",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: data,
            success: function (response) {


            },
            error:function (response) {

            }
        })
    }
    let invite_users_desk = $('#choose_invited_user');
    $('.invite_user_input').keyup(function () {
        let nickname = $(this).val();
        invite_users_desk.addClass('animate__fadeIn');
        invite_users_desk.removeClass('animate__fadeOut');
        if (nickname){
            $.ajax({
                type: "GET",
                dataType : "json",
                url: GET_NICKNAME,
                data: {'nickname': nickname},
                success: function(data){
                    let users = data.users;
                    invite_users_desk.css('display','block').empty();
                    if(users.length){
                        for(let i = 0 ; i < users.length ; i++){
                            let user_item = $('<div class="d-flex align-items-center battle_create_opponent p-1">\n' +
                                '                                                <img src="/storage/user/images/avatar/'+ users[i].avatar +'" alt="" >\n' +
                                '                                                <div class="pl-2">\n' +
                                '                                                    <p class="m-0">'+ users[i].nickname +'</p>\n' +
                                '                                                </div>\n' +
                                '                                            </div>')
                            user_item.click(function () {
                                $('#invite_user_value').val(users[i].id);
                                $('.invite_user_input').val(users[i].nickname);
                                $('#invited_user_place').empty()
                                $('#invited_user_place').append($('<div class="front_main_background px-2 d-flex align-items-center h-100"></div>').append(user_item))
                                invite_users_desk.removeClass('animate__fadeIn');
                                invite_users_desk.addClass('animate__fadeOut');
                                invite_users_desk.css('display','none')
                            })
                            invite_users_desk.append(user_item)
                        }
                    }else{
                        invite_users_desk.append('<div >\n' +
                            '                                                <p class="p-2 ">No users found !</p>\n' +
                            '                                            </div>')

                    }

                }
            });
        }else{
            invite_users_desk.removeClass('animate__fadeIn');
            invite_users_desk.css('display','none')
            invite_users_desk.addClass('animate__fadeOut');
        }

    })
    $('#invite_email_button').click(function () {
        $.ajax({
            type: "POST",
            dataType : "json",
            url: INVITE_ROUTE,
            data: {
                email: $('#invite_email').val(),
                type: 'email',
                battle:BATTLE_ID
            },
            success: function(data){
                console.log(data)
                alertSuccess(data.message)
                $('#invite_email').val('')
                $('#invited_user_place').empty()
                $('.invite_user_input').val('')


            }
        });
    })

    $('#invite_nickname_button').click(function () {
        $.ajax({
            type: "POST",
            dataType : "json",
            url: INVITE_ROUTE,
            data: {
                user: $('#invite_user_value').val(),
                type: 'user',
                battle:BATTLE_ID
            },
            success: function(data){
                console.log(data)
                alertSuccess(data.message)
                $('#invite_user_value').val('')

            }
        });
    })
    $('#first_emoji_handler .emojis div').click(function () {
        $('#first_emoji_handler .emojis div').removeClass('chosen').addClass('inactive');
        $(this).removeClass('inactive').addClass('chosen');
        setReaction($('#first_player_emoji_value'),{ battle:BATTLE_ID, user:$(this).data('user'), emoji:$(this).data('id')}, $(this).html(),'left')

        sendMessage({
            message:$(this).html(),
            channel:CHANNEL_NAME,
            reaction:'reaction',
            user:'left'
        })
    })
    $('#second_emoji_handler .emojis div').click(function () {
        $('#second_emoji_handler .emojis div').removeClass('chosen').addClass('inactive');
        $(this).removeClass('inactive').addClass('chosen');
        setReaction($('#second_player_emoji_value'),{ battle:BATTLE_ID, user:$(this).data('user'), emoji:$(this).data('id')}, $(this).html(),'right')

        sendMessage({
            message:$(this).html(),
            channel:CHANNEL_NAME,
            reaction:'reaction',
            user:'right'
        })
    })
    $(document).on('click', function (event) {
        if (!$(event.target).closest('#first_player_heart').length) {
            closeFirstEmojis();
        }

        if (!$(event.target).closest('#second_player_heart').length) {
            closeSecondEmojis();
        }
    });
    function vote(flag,align){
        $('.vote_flag').off();
        sendMessage({
            message:'message',
            channel:CHANNEL_NAME,
            reaction:'vote',
            user:align
        })
        let smile;
        if(align === 'left'){
            smile = $('<div class="heart_left style'+ random(4) +'"><i class="fa fa-flag active_flag" ></i></div>');
            $('#flying_smiles_left').append(smile);
        }else{
            smile = $('<div class="heart style'+ random(4) +'"><i class="fa fa-flag active_flag" ></i></div>');
            $('#flying_smiles_right').append(smile);
        }

        setTimeout(function () {
            smile.remove()
        },4000);
        $.ajax({
            url: VOTE_ROUTE,
            type: "post",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                battle:BATTLE_ID,
                user:flag.data('user'),
            },
            success: function (response) {
                console.log(response,'dsafdsafdsaf');
                if(response.success === 'success'){

                    $('.vote_flag').find('i').css('color','grey');
                    flag.find('i').css('color','#FABA01');
                    flag.addClass('animate__animated animate__tada')
                }
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    }
    $('.vote_flag').click(function () {
        let flag = $(this);
        let align = $(this).data('align');
        vote(flag,align);
    })

    $('#subscribe_button').click(function () {
        let button = $(this);
        $.ajax({
            url: SUBSCRIBE_ROUTE,
            type: "post",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                battle:BATTLE_ID,
            },
            success: function (response) {
                console.log(response,'dsafdsafdsaf');
                if(response.success === 'success'){
                    alertSuccess(response.message);
                    button.addClass('animate__animated animate__bounceOutRight')
                }
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })
    $('#not_interested').click(function () {
        let button = $(this);
        $.ajax({
            url: UNINTERESTING_ROUTE,
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
                    alertSuccess(response.message);
                    button.addClass('animate__animated animate__bounceOutRight')
                }
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })


})

function shuffle(array) {
    let currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}
let CHANNEL_NAME = 'channel_'+ BATTLE_ID;
let input = $('#livechat_message_input');
let desc =  $('#message_desc');
input.keyup(function (ev) {
    if(ev.which === 13){
        $('#message_button').click()
    }
})

$('.report_dropdown_button').click(function () {
    $('#report_on').val($(this).data('user'))
})
$('.report_about_problem').click(function () {
    $.ajax({
        url: REPORT_ROUTE,
        type: "post",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: {
            battle:BATTLE_ID,
            report_on:$('#report_on').val(),
            additional:$('#report_additional').val(),
            report_about:$('#report_about').val()
        },
        success: function (response) {
            console.log(response);
            alertSuccess(response.message);
            $('#report_additional').val('')

        },
        error:function (response) {

        }
    })
})

$('#message_button').click(function () {
    if(input.val() && input.val().length <= 200){
        $.ajax({
            url: MESSAGE_ROUTE,
            type: "post",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                message:input.val(),
                channel:CHANNEL_NAME,
            },
            success: function (response) {
                input.val('')
            },
            error:function (response) {
            }
        })
    }
})
let USERNAME_COLORS = shuffle(['#FF065B','#CFFF09','#0099FF','#F27A1E','#20AACE','#D248D2','#FFFFFF']);
function newLiveChatMessage(e){
    return '<div class="row col-12 mt-2 flex-nowrap animate__fadeIn animate__animated">\n' +
        '             <img src="'+ AVATAR_STORAGE + '/' + e.avatar +'" alt="">\n' +
        '             <div class="pl-3">\n' +
        '                 <p class=" username" style="color:'+ USERNAME_COLORS[e.id % 7] +'">'+ e.user +'</p>\n' +
        '                 <p class=\'live_chat_message\'>'+ e.message +'</p>\n' +
        '             </div>\n' +
        '\n' +
        '</div>'
}
Echo.channel(CHANNEL_NAME)
    .listen('.new_message', e => {
        if(e.type){
            if(e.id != ID_COMPONENT_STATUS){
                let smile;
                if(e.type === 'vote'){
                    if(e.reaction_user ==='left'){
                        smile = $('<div class="heart_left style'+ random(4) +'"><i class="fa fa-flag active_flag" ></i></div>');
                        $('#flying_smiles_left').append(smile);
                    }else{
                        smile = $('<div class="heart style'+ random(4) +'"><i class="fa fa-flag active_flag" ></i></div>');
                        $('#flying_smiles_right').append(smile);
                    }

                }
                else if(e.reaction_user ==='left'){
                    smile = $('<div class="heart_left style'+ random(4) +'">'+ e.message +'</div>');
                    $('#flying_smiles_left').append(smile);
                }else{
                    smile = $('<div class="heart style'+ random(4) +'">'+ e.message +'</div>');
                    $('#flying_smiles_right').append(smile);
                }

                setTimeout(function () {
                    smile.remove()
                },4000);
            }

        }else{
            desc.append(newLiveChatMessage(e))
            desc.stop().animate({ scrollTop: desc.prop("scrollHeight")}, 2000);
        }

    })
