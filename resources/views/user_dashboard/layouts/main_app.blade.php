<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UBattle Front - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
          type="text/css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
          rel="stylesheet"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link href="{{asset('users_assets/css/style.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>

    {{--<script src="{{ asset('/js/app.js') }}"></script>--}}

    <script>
        let AUTHENTICATED = "{{auth()->check()}}";
        let SEARCH_ROUTE = "{{route('main.search')}}";
        let MARK_AS_READ_ROUTE = "{{route('mark.as.read')}}";
        let NOTIFICATIONS_ROUTE = "{{route('user.notifications')}}";
        let REMINDER_ROUTE = "{{route('set.reminder')}}";
        let GET_CITIES = "{{route('user.get.cities')}}";
        let GET_STATES = "{{route('user.get.states')}}";
        let CHANNEL_VARIABLE;
        @auth()
            CHANNEL_VARIABLE = "{{auth()->user()->id}}"
        @endauth;
        @guest()
            CHANNEL_VARIABLE = 0;
        @endguest
        function alertSuccess(message) {
            $('#battle_alert_success').remove();
            let desk = $('<div class="battle_alert_div animate__animated" id="battle_alert_success"> </div>')
            let text = $('<p class="mb-0" id="alert_message">alert message</p>');
            desk.append(text);
            $('#wrapper').prepend(desk);
            text.text(message)
            desk.css('display','block');
            desk.addClass('animate__fadeInDown');
            setTimeout(function () {
                desk.removeClass('animate__fadeInDown');
                desk.addClass('animate__bounceOutRight');
            },2000)
        }
        function alertError(message) {
            $('#battle_alert_error').remove();
            let desk = $('<div class="battle_alert_div animate__animated" id="battle_alert_error"> </div>')
            let text = $('<p class="mb-0" id="alert_message">alert message</p>');
            desk.append(text);
            $('#wrapper').prepend(desk);
            text.text(message)
            desk.css('display','block');
            desk.addClass('animate__fadeInDown');
            setTimeout(function () {
                desk.removeClass('animate__fadeInDown');
                desk.addClass('animate__bounceOutRight');
            },2000)
        }
    </script>


</head>
<body>
<div class="d-flex" id="wrapper">
    <div id="full_screen">

    </div>
    <div class="create_battle_fixed">
        <div class="create_battle_place">
            <p>Create Battle</p>
            @auth()
                <a class="btn" href="{{route('battle.create')}}"><i class="fa fa-plus"></i></a>
            @else
                <a type="button" data-toggle="modal" data-target="#loginModal"><i class="fa fa-plus"></i></a>
            @endauth

        </div>
    </div>
    <div class="battle_alert_div animate__animated" id="battle_alert_success">
        <p class="mb-0" id="alert_message">alert message</p>
    </div>
    <div class="battle_alert_error_div animate__animated" id="battle_alert_error">
        <p class="mb-0" id="alert_message_error">alert message</p>
    </div>
    @if(session()->has('success'))
        <input type="hidden" id="success" value="{{session()->get('success')}}">
    @else
        <input type="hidden" id="success" value="">
    @endif
    @include('user_dashboard.includes.sidebar')
    <div id="page-content-wrapper" >
        @yield('nav')
        @yield('content')

        @include('user_dashboard.includes.footer')
    </div>
</div>
@include('user_dashboard.includes.login_modal')


@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script src="{{asset('users_assets/js/moment.min.js')}}"></script>
<script src="{{asset('users_assets/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('users_assets/js/owl.autoplay.js')}}"></script>
<script src="{{asset('users_assets/js/app.js')}}"></script>
<script src="{{asset('users_assets/js/chat.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
</script>
</body>
</html>
