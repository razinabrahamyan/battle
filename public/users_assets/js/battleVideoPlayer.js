let video1 = document.getElementById("videoOutput");
let video2 = document.getElementById("videoInput");
let VideoCreator = $('#videoBig'),VideoJoiner = $('#videoSmall');
let FIRST_READY = false;
let SECOND_READY = false;
let DURATION = null;
let IS_PLAYING = false;
let IS_MUTED = true;
let VOLUME_NOW = 1;
let VOLUME_OLD = 50;
function makeVideoTime(time){
    time = Math.floor(time);
    let minutes = Math.floor(time/60);
    let minutesText = minutes < 10? '0' + minutes: minutes;
    time = time%60;
    let secondsText = time < 10? '0' + time: time;
    return minutesText + ':' + secondsText;
}
function makeVideoReady(videoplayer){
    DURATION = videoplayer.duration;
    let scale = $('#track').width()/DURATION;
    let smallWindow = $('#track_hover_time');
    $('#track').attr('max',DURATION)
    setInterval(function () {
        if(IS_PLAYING){
            $('#track').val(parseInt($('#track').val()) + 1)
        }
    },1000)
    $('#track').on('change',function () {
        console.log(DURATION,$(this).attr('max'))
        video1.currentTime = $(this).val();
        video2.currentTime = $(this).val();
    })
    $('#track').on('mouseenter',function (ev) {
        smallWindow.css('display','block');

    })
    $('#track').on('mouseleave',function (ev) {
        smallWindow.css('display','none');
    })
    $('#track').on('mousemove',function (ev) {
        smallWindow.css('display','block');
        smallWindow.css('left',ev.offsetX - smallWindow.outerWidth()/2)
        smallWindow.text( makeVideoTime(ev.offsetX/scale))
    })
}
video1.onloadedmetadata= function(){
    makeVideoReady(video1)
}
video1.onended = function(){
    console.log(888888888888)
    $('#track').val(0)
}
$(document).ready(function () {
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

    video1.ontimeupdate = function () {
        $('#video_time').text(makeVideoTime(video1.currentTime))
    }
    video2.volume = 0;
    video1.volume = 0;

    function muteVideo() {
        if(IS_MUTED){
            makeVolumeConfig(VOLUME_OLD,true);
            video1.muted = false;
            video2.muted = false;
            IS_MUTED = false;
        }else{
            $('#volume_icon_handler').empty();
            $('#volume_icon_handler').append('<i class="fa fa-volume-mute volume_icon"></i>');
            video1.muted = true;
            video2.muted = true;
            IS_MUTED = true;
            $('#volume_input').val(0);
        }
    }
    function makeVolumeConfig(value,fromMute = false){
        value = parseInt(value);
        if(fromMute){
            $('#volume_input').val(value);
        }
        if(value > 50){
            VOLUME_NOW = 2;
            VOLUME_OLD = value;
            $('#volume_icon_handler').empty();
            $('#volume_icon_handler').append('<i class="fa fa-volume-up volume_icon"></i>');

        }else if (value > 0){
            VOLUME_NOW = 1;
            VOLUME_OLD = value;
            $('#volume_icon_handler').empty();
            $('#volume_icon_handler').append('<i class="fa fa-volume-down volume_icon"></i>');
        }else if(value === 0){
            VOLUME_NOW = 0;
            VOLUME_OLD = value;
            $('#volume_icon_handler').empty();
            $('#volume_icon_handler').append('<i class="fa fa-volume-off volume_icon"></i>');
        }
        video1.volume = value/100
        video2.volume = value/100



    }
    $('#volume_icon_handler').click(function () {
        muteVideo();
    })
    $('#volume_input').on('input',function () {
        makeVolumeConfig($(this).val());
        if (IS_MUTED){
            muteVideo();
        }
    })


    video1.onpause = function(){
        IS_PLAYING = false;
        $('.pause_part').css('display','none');
        $('.play_part').css('display','block');
    }
    video1.onplay = function(){
        IS_PLAYING = true;
        $('.pause_part').css('display','block');
        $('.play_part').css('display','none');
    }
    $('.play_part,.pause_part').click(function () {
        if(IS_PLAYING){
            video1.pause()
            video2.pause()

        }else{
            video1.play()
            video2.play()
        }

    })
    $('#video_full').click(function () {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
            $('#full_screen').css('display','block').append($('#live_videos'));
            $('#live_videos').addClass('full_screen_mode');
            $('#wrapper').addClass('full_screen_mode');

        } else {
            if (document.exitFullscreen) {
                $('#videos_place').append($('#live_videos'));
                $('#full_screen').css('display','none')
                $('#live_videos').removeClass('full_screen_mode')
                $('#wrapper').removeClass('full_screen_mode');
                document.exitFullscreen();
            }
        }
    })

    $(document).bind('webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {
        var state = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen;
        if(!state){
            $('#videos_place').append($('#live_videos'));
            $('#full_screen').css('display','none')
            $('#live_videos').removeClass('full_screen_mode')
            $('#wrapper').removeClass('full_screen_mode');
        }
    });
})
