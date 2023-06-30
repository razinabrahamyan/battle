let followed_channels = $('.animating_channels .followed_channels_div');
let heights = [];
let HAS_NOTIFCATIONS = false;
let READY_TO_GET_NOTIFICATIONS = false;
let IS_ON_BATTLES_PAGE = $('#is_on_battles_page').val();
let months = ['Jan','Feb','Mar','Apr','May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$('[data-toggle="tooltip"]').on("click", function () {
    $(this).tooltip('hide')
});
for(let i = 0 ;i < 12 ; i++){
    $('#reg_month').append('<option value="'+ (i+1) +'">'+ months[i] +'</option>');
}

for(let i = new Date().getFullYear()-18 ;i > new Date().getFullYear() - 90 ; i--){
    $('#reg_year').append('<option value="'+ (i) +'">'+ i +'</option>');
}
for(let i = 1;i <= 31 ; i++){
    if(i<10){
        $('#reg_day').append('<option value="'+ (i) +'">'+ '0' + i +'</option>');
    }else{
        $('#reg_day').append('<option value="'+ (i) +'">'+ i +'</option>');
    }

}
for(let i = 0; i < followed_channels.length ; i++){
    heights[i] = $(followed_channels[i]).height();
    $(followed_channels[i]).css('max-height',0)
}
$(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
    console.log(ajaxOptions,'eveeeeeeeeeeent')
});
let count_downs =$('.count_down');
let count_ups =$('.count_up');
let count_durs =$('.count_duration');
count_downs.each(function () {
    let element = $(this);
    let nowTime = new Date().getTime();
    let start_date = new Date(element.data('date')).getTime();
    let interval = Math.floor((start_date-nowTime)/1000)
    if(interval > 0){
        countDown(interval,element);
    }
})
count_ups.each(function () {
    let element = $(this);
    let nowTime = new Date().getTime();
    let start_date = new Date(element.data('date')).getTime();
    let interval = Math.floor((nowTime - start_date)/1000)
    countUp(interval,element);
})
function makeTime(time) {
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
function countDown(time,timerPlace){
    let timer = setInterval(function () {
        if(!time){
            clearInterval(timer)
            timerPlace.remove()
        }
        timerPlace.text(makeTime(time--));
    }, 1000);
}

function countUp(time,timerPlace){
    let timer = setInterval(function () {
        if(!time){
            console.log('vooooooooooooooch',time)
            clearInterval(timer)
            timerPlace.remove()
        }
        timerPlace.text(makeTime(time++));
    }, 1000);
}
count_durs.each(function () {
    let element = $(this);
    let end_date = new Date(element.data('end')).getTime();
    let start_date = new Date(element.data('start')).getTime();
    let interval = Math.floor((end_date - start_date)/1000)
    element.text(makeTime(interval));
})

function updateCitiesLogin(state_id){
    $.ajax({
        url: GET_CITIES,
        type: "get",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: {
            state_id:state_id
        },
        success: function (response) {
            console.log(response.cities)
            let cities = response.cities;
            $('#reg_city').empty();
            for(let i = 0; i < cities.length; i++){
                $('#reg_city').append('<option value="'+ cities[i].id +' ">'+ cities[i].city["en"] +'</option>');
            }
        },
        error:function (response) {
        }
    })
}
function updateStatesLogin(country_id) {
    $.ajax({
        url: GET_STATES,
        type: "get",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: {
            country_id:country_id
        },
        success: function (response) {
            let states = response.states;
            $('#reg_state').empty();
            for(let i = 0; i < states.length; i++){
                $('#reg_state').append('<option value="'+ states[i].id +' ">'+ states[i].state["en"] +'</option>');
            }
            updateCitiesLogin(states[0].id);
        },
        error:function (response) {
        }
    })
}
$('#reg_country').change(function () {
    updateStatesLogin($(this).val())
})

$('#reg_state').change(function () {
    updateCitiesLogin($(this).val())
})
$(document).ready(function () {

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($('#success').val()){
        alertSuccess($('#success').val())
    }
    function addNotification(e){
        if (HAS_NOTIFCATIONS) {
            notification_count.html(parseInt(notification_count.html()) + 1);
        } else {
            notification_count = $('<div class="notification_bell_handler" id="notification_count">1</div>');
            $('#notification_place').append(notification_count);
            HAS_NOTIFCATIONS = true;
            $('.main_notification_desc').empty();
            $('.main_notification_desc').prepend($('<div class="text-right mark_as_read">\n' +
                '                        <button type="button" id="notifications_read">Mark All As Read</button>\n' +
                '                    </div>'));
            $('#notifications_read').click(function () {
                markAsRead();
            })
        }
        if (e.notification.type === 'battle_request') {

            $('.mark_as_read').after(' <div class="p-2">\n' +
                '                            <a href="/battle/' + e.notification.data.battle_id + '">\n' +
                '                                <div class="search_battle_div px-3">\n' +
                '                                    <img src="/storage/user/images/logo/vs_logo.png" alt="">\n' +
                '                                    <div class="pl-2">\n' +
                '                                        <p class="m-0">' + e.notification.data.title + '</p>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </a>\n' +
                '                        </div>');
        } else if (e.notification.type === 'request_answer') {

            $('.mark_as_read').after(' <div class="p-2">\n' +
                '                            <a href="/battle/' + e.notification.data.battle_id + '">\n' +
                '                                <div class="search_battle_div px-3">\n' +
                '                                    <img src="/storage/user/images/avatar/'+ e.notification.data.image +'" alt="">\n' +
                '                                    <div class="pl-2">\n' +
                '                                        <p class="m-0">' + e.notification.data.title + '</p>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </a>\n' +
                '                        </div>');
            if(e.notification.answer === 'accepted'){
                if(IS_ON_BATTLES_PAGE && BATTLE_ID === e.notification.data.battle_id+''){
                    $("#second_player_image").attr("src",'/storage/user/images/avatar/'+e.notification.data.image);
                    $("#second_player_name").text(e.notification.data.nickname);
                    $("#second_player_address").text(e.notification.data.address);
                    $('.battle_pad_prof.opponent_player').addClass('animate__animated animate__flash')
                }
            }
        } else if(e.notification.type === 'invite'){
            $('.mark_as_read').after(' <div class="p-2">\n' +
                '                            <a href="/battle/' + e.notification.data.battle_id + '">\n' +
                '                                <div class="search_battle_div px-3">\n' +
                '                                    <img src="/storage/user/images/logo/vs_logo.png" alt="">\n' +
                '                                    <div class="pl-2">\n' +
                '                                        <p class="m-0">' + e.notification.data.title + '</p>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </a>\n' +
                '                        </div>');
        }else if (e.notification.type === 'ready') {
                $('.mark_as_read').after(' <div class="p-2">\n' +
                    '                            <a href="/battle/' + e.notification.data.battle_id + '">\n' +
                    '                                <div class="search_battle_div px-3">\n' +
                    '                                    <img src="/storage/user/images/avatar/'+ e.notification.data.image +'" alt="">\n' +
                    '                                    <div class="pl-2">\n' +
                    '                                        <p class="m-0">' + e.notification.data.title + '</p>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </a>\n' +
                    '                        </div>');
        }

        notification_bell.removeClass('notify');
        notification_bell.outerWidth(notification_bell.outerWidth());
        notification_bell.addClass('notify');



    }

    function getNotifications(){
        $.ajax({
            type: "GET",
            dataType : "json",
            url: NOTIFICATIONS_ROUTE,
            success: function(data){
                READY_TO_GET_NOTIFICATIONS = true;
                if (data.success === 'success'){
                    let notifications = data.notifications;
                    $('.main_notification_desc').empty();
                    if(notifications.length){
                        $('#notification_count').remove()
                        HAS_NOTIFCATIONS = true;
                        for(let i = 0; i < notifications.length; i++){
                            if (notifications[i].data.type === 'battle_request') {
                                $('.main_notification_desc').append(' <div class="p-2">\n' +
                                    '                            <a href="/battle/' + notifications[i].data.data.battle_id + '?notification_id='+ notifications[i].id +'">\n' +
                                    '                                <div class="search_battle_div px-3">\n' +
                                    '                                    <img src="/storage/user/images/logo/vs_logo.png" alt="">\n' +
                                    '                                    <div class="pl-2">\n' +
                                    '                                        <p class="m-0">' + notifications[i].data.data.title + '</p>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                            </a>\n' +
                                    '                        </div>');
                            } else if (notifications[i].data.type === 'request_answer') {
                                $('.main_notification_desc').append(' <div class="p-2">\n' +
                                    '                            <a href="/battle/' + notifications[i].data.data.battle_id + '?notification_id='+ notifications[i].id +'">\n' +
                                    '                                <div class="search_battle_div px-3">\n' +
                                    '                                    <img src="/storage/user/images/avatar/'+ notifications[i].data.data.image +'" alt="">\n' +
                                    '                                    <div class="pl-2">\n' +
                                    '                                        <p class="m-0">' + notifications[i].data.data.title + '</p>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                            </a>\n' +
                                    '                        </div>');
                            }
                            else if(notifications[i].data.type === 'invite'){
                                $('.main_notification_desc').append(' <div class="p-2">\n' +
                                    '                            <a href="/battle/' + notifications[i].data.data.battle_id + '?notification_id='+ notifications[i].id +'">\n' +
                                    '                                <div class="search_battle_div px-3">\n' +
                                    '                                    <img src="/storage/user/images/logo/vs_logo.png" alt="">\n' +
                                    '                                    <div class="pl-2">\n' +
                                    '                                        <p class="m-0">' + notifications[i].data.data.title + '</p>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                            </a>\n' +
                                    '                        </div>');
                            }else if (notifications[i].data.type === 'ready') {
                                $('.main_notification_desc').append(' <div class="p-2">\n' +
                                    '                            <a href="/battle/' + notifications[i].data.data.battle_id + '?notification_id='+ notifications[i].id +'">\n' +
                                    '                                <div class="search_battle_div px-3">\n' +
                                    '                                    <img src="/storage/user/images/avatar/'+ notifications[i].data.data.image +'" alt="">\n' +
                                    '                                    <div class="pl-2">\n' +
                                    '                                        <p class="m-0">' + notifications[i].data.data.title + '</p>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                            </a>\n' +
                                    '                        </div>');
                            }
                        }
                        notification_count = $('<div class="notification_bell_handler" id="notification_count">1</div>');
                        $('#notification_place').append(notification_count);
                        notification_count.html(notifications.length);
                        $('.main_notification_desc').prepend($('<div class="text-right mark_as_read">\n' +
                            '                        <button type="button" id="notifications_read">Mark All As Read</button>\n' +
                            '                    </div>'));
                        $('#notifications_read').click(function () {
                            markAsRead();
                        })
                    }else{
                        HAS_NOTIFCATIONS = false;
                        $('.main_notification_desc').append('<div class="p-2">\n' +
                            '                        <p class="p-3">No Notifications !</p>\n' +
                            '                    </div>');
                    }
                }
            },
            error:function (exception) {
                console.log('notifiaction error', exception)
            }
        });
    }

    $('.battle_card_reminder').click(function () {
        let reminder = $(this);
        if(!reminder.hasClass('chosen')){
            $.ajax({
                type: "POST",
                dataType : "json",
                url: REMINDER_ROUTE,
                data:{
                    battle:$(this).data('battle')
                },
                success: function(data){
                    if (data.success === 'success'){
                        if(reminder.data('old')){
                            reminder.append('<i class="fa fa-check"></i>');
                            console.log('old')
                        }else{
                            reminder.removeClass('battle_card_reminder').addClass('chosen').attr('data-original-title','Reminder Already Set');
                            console.log('new')
                        }
                        alertSuccess(data.message);
                    }
                }
            });
        }

    })
    function markAsRead(){
        $.ajax({
            type: "GET",
            dataType : "json",
            url: MARK_AS_READ_ROUTE,
            success: function(data){
                if (data.success === 'success'){
                    $('.main_notification_desc').empty();
                    $('.main_notification_desc').append('<div class="p-2">\n' +
                        '                        <p class="p-3">No Notifications !</p>\n' +
                        '                    </div>');
                    $('#notification_count').remove();
                    alertSuccess('notifications marked as read')
                    HAS_NOTIFCATIONS = false;
                }
            }
        });
    }

    let notification_count = $('#notification_count');
    let notification_bell = $('#notif_bell');
    let followed_channels = $('.animating_channels .followed_channels_div');
    let login_errors = JSON.parse($('#login_errors').val());
    let not_match = JSON.parse($('#match_error').val());
    let register_errors = JSON.parse($('#register_errors').val());
    let search_result_desc = $('#search_result_div');


    if (AUTHENTICATED){
        Echo.private('user_notification.' + CHANNEL_VARIABLE)
            .listen('.new_notification', e => {
                if(e.notification.type !== 'ready' || !IS_ON_BATTLES_PAGE || BATTLE_ID != e.notification.data.battle_id){
                    if(READY_TO_GET_NOTIFICATIONS){
                        addNotification(e);
                        getNotifications();
                    }else{
                        setTimeout(function () {
                            addNotification(e)
                            getNotifications();
                        },1000)
                    }
                }else{
                    $.ajax({
                        type: "POST",
                        dataType : "json",
                        url: MARK_READY_NOTIFICATION,
                        data:{
                            battle:BATTLE_ID
                        },
                        success: function(data){

                        }
                    });
                    $('#ready_p').text('Your opponent is ready')
                }


            })
    }

    if (AUTHENTICATED){
        setTimeout(function () {
            getNotifications();
        },1000)
    }


    $('#notifications_read').click(function () {
        markAsRead();
    })

    $('#sidebar_opener_button').click(function () {
        $('#sidebar-wrapper').addClass('opened_sidebar');
    })
    $('#sidebar_closer_button').click(function () {
        $('#sidebar-wrapper').removeClass('opened_sidebar');
    })
    for(let i = 0; i < followed_channels.length ; i++){
        setTimeout(function () {
            $(followed_channels[i]).addClass('animate__animated animate__fadeInLeft');
            $(followed_channels[i]).css('max-height',heights[i])
        },(i+1)*100)
    }
    $('a.auth_modal_clickable').click(function () {
        $('.auth_modal_li').removeClass('active');
        $(this).parent('.auth_modal_li').addClass('active');
    })
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
    $('.checkmark').click(function () {
        $(this).css('border-color','#64A7F8')
        $('.agreement_text').css('color','white')
    })
    $('#signup_button').click(function () {
        if(!$('#terms_and_conditions').prop("checked")){
            $('.checkmark').css('border-color','#dc3545');
            $('.agreement_text').css('color','#dc3545')

        }
    })
    if(login_errors.length !== 0 || not_match.match){
        $('#login_modal_button').click();
    }else if(register_errors.length !== 0){
        $('#login_modal_button').click();
        $('#register_button').click();
    }
    $(document).on('click', function (event) {
        if (!$(event.target).closest('#main_search_div').length) {
            search_result_desc.addClass('animate__fadeOut');
        }
    });
    $('#main_serch_input').keyup(function () {
        search_result_desc.addClass('animate__fadeIn');
        search_result_desc.removeClass('animate__fadeOut');
        let text = $(this).val();
        if(text){
            $.ajax({
                type: "GET",
                dataType : "json",
                url: SEARCH_ROUTE,
                data: {'text': text},
                success: function(data){
                    console.log(data.battles)
                    let battles = data.battles;
                    let users = data.users;
                    search_result_desc.empty();
                    if(users.length || battles.length){
                        if(users.length ){
                            search_result_desc.append('<h5 class="search_result_header p-3 pb-1"> Players</h5>');
                            for(let i = 0 ; i < users.length; i++){
                                search_result_desc.append('<a href="/profile/'+ users[i].nickname +'">\n' +
                                    '<div class="search_battle_div mt-2 pl-4">\n' +
                                    '                                        <img src="/storage/user/images/avatar/'+ users[i]["avatar"] +'" alt="">\n' +
                                    '                                        <div class="pl-2">\n' +
                                    '                                            <p class="mb-0 title">'+ users[i]["nickname"] +'</p>\n' +
                                    '                                        </div>\n' +
                                    '                                    </div>\n' +
                                    '</a>');
                            }
                            search_result_desc.append('<div class="pl-4"><a href="/players" class="text-white view_all_main">view all players</a></div>')
                            search_result_desc.append('<div class="p-2"></div>')
                        }
                        if(battles.length){
                            search_result_desc.append('<h5 class="search_result_header p-3 pb-2 mb-0"> Battles</h5>');
                            for(let i = 0 ; i < battles.length; i++){
                                search_result_desc.append('<a href="/battle/'+ battles[i]['id'] +'">\n' +
                                    '<div class="search_battle_div mt-1 pl-4">\n' +
                                    '                                        <img src="/storage/user/images/logo/vs_logo.png\" alt="">\n' +
                                    '                                        <div class="pl-2">\n' +
                                    '                                            <p class="mb-0 title">'+ battles[i]['title'] +'</p>\n' +
                                    '                                            <p class="battle_users mb-0"><span class="carousel_channel_name">Channel Name </span>vs <span class="carousel_channel_name">Channel Name</span></p>\n' +
                                    '                                        </div>\n' +
                                    '                                    </div>\n' +
                                    '</a>');
                            }
                            search_result_desc.append('<div class="pl-4"><a href="/battles" class="text-white view_all_main">view all battles</a></div>')
                        }

                        search_result_desc.append('<div class="p-2"></div>')
                    }

                    else{
                        search_result_desc.empty();
                        search_result_desc.append('<p class="p-3">No results</p>')
                    }

                }
            });
        }else{
            search_result_desc.removeClass('animate__fadeIn');
            search_result_desc.addClass('animate__fadeOut');
        }

    })


})
