<div id="sidebar-wrapper" class="animate__animated @if(!session()->has('first_entry_sidenav'))
<?php session()->put('first_entry_sidenav','false') ?>
    animate__fadeInLeft @endif ">
    <div class="container position-relative logo_bg">
        <div class="position-absolute sidebar_closer_div">
            <button id="sidebar_closer_button" class="no_outline"><i class="fa fa-times"></i></button>
        </div>
        <div class="sidebar-heading text-center pt-3"><a href="{{route('guest.home')}}"><img src="/assets/img/brand/logo.svg"></a></div>
    </div>
    <div class="list-group list-group-flush mt-5  text-capitalize">
        <a href="{{route('guest.home')}}" class="list-group-item-action home row pl-3 pr-1 py-3">
            <div class="col-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.5984" height="20.1806" viewBox="0 0 22.5984 20.1806">
                    <g id="Group_8338" data-name="Group 8338" transform="translate(0.293 0.268)">
                        <g id="_001-home" data-name="001-home">
                            <g id="Group_9" data-name="Group 9" transform="translate(0 0)">
                                <g id="Group_8" data-name="Group 8" transform="translate(0 0)">
                                    <path id="Path_20" data-name="Path 20"
                                          d="M19.787,34.839,10.306,27.9a.52.52,0,0,0-.614,0L.212,34.839a.52.52,0,1,0,.614.839L10,
                                          28.961l9.173,6.717a.52.52,0,0,0,.614-.839Z" transform="translate(0.001 -27.797)"
                                          fill="#fff" stroke="#fff" stroke-width="0.5"/>
                                </g>
                            </g>
                            <g id="Group_11" data-name="Group 11" transform="translate(2.205 7.998)">
                                <g id="Group_10" data-name="Group 10" transform="translate(0 0)">
                                    <path id="Path_21" data-name="Path 21"
                                          d="M71.522,232.543a.52.52,0,0,0-.52.52v8.271H66.845v-4.515a2.6,2.6,0,0,0-5.2,
                                          0v4.515H57.491v-8.271a.52.52,0,1,0-1.039,0v8.791a.52.52,0,0,0,.52.52h5.2a.519.519,0,0,0,.518-.479.391.391,
                                          0,0,0,0-.04v-5.035a1.559,1.559,0,1,1,3.118,0v5.035a.381.381,0,0,0,0,.04.519.519,0,0,0,.518.48h5.2a.52.52,
                                          0,0,0,.52-.52v-8.791A.52.52,0,0,0,71.522,232.543Z" transform="translate(-56.452 -232.543)"
                                          fill="#fff" stroke="#fff" stroke-width="0.5"/>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>

            </div>
            <div class="col-8 p-0">
                @lang('messages.home')
            </div>

        </a>
        <a href="{{route('front.categories')}}" class="list-group-item-action  row pl-3 pr-1 py-3">
            <div class="col-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="21.07" height="21.005" viewBox="0 0 21.07 21.005">
                    <g id="Group_8337" data-name="Group 8337" transform="translate(0.5 0.5)">
                        <g id="magnifying-glass">
                            <path id="Path_32" data-name="Path 32"
                                  d="M19.877,18.984l-4.861-4.861a8.536,8.536,0,1,0-.843.843l4.861,4.861a.6.6,0,0,0
                                  ,.421.177.584.584,0,0,0,.421-.177A.6.6,0,0,0,19.877,18.984ZM1.243,8.53a7.332,
                                  7.332,0,1,1,7.332,7.336A7.34,7.34,0,0,1,1.243,8.53Z" transform="translate(-0.05)"
                                  fill="#fff" stroke="#fff" stroke-width="0.9"/>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="col-8 p-0">
                @lang('messages.categories')
            </div>
        </a>
        <a href="{{route('battles')}}" class="list-group-item-action  row pl-3 pr-1 py-3">
            <div class="col-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 107.461 75.249">
                    <path id="Icon_metro-gamepad" data-name="Icon metro-gamepad" d="M77.6,6.927c-4.616,0-13.582,6.52-21.191,6.52S39.29,6.927,35.215,6.927C7.234,6.927-8.8,82.177,12.124,82.177c17.66,0,20.037-22.006,44.213-22.006,19.561,0,31.039,21.738,44.08,21.738,20.917,0,5.164-74.982-22.821-74.982ZM33.582,49.309a14.67,14.67,0,1,1,14.67-14.67A14.674,14.674,0,0,1,33.582,49.309ZM72.5,41.158a3.26,3.26,0,1,1,3.26-3.26A3.257,3.257,0,0,1,72.5,41.158Zm9.986,9.78a3.26,3.26,0,1,1,3.26-3.26A3.257,3.257,0,0,1,82.486,50.939Zm0-19.561a3.26,3.26,0,1,1,3.26-3.26A3.257,3.257,0,0,1,82.486,31.378Zm9.78,9.78a3.26,3.26,0,1,1,3.26-3.26A3.257,3.257,0,0,1,92.267,41.158ZM33.582,26.488a8.15,8.15,0,1,0,8.15,8.15A8.151,8.151,0,0,0,33.582,26.488Z" transform="translate(-2.572 -6.927)" fill="#fff" stroke="#fff"/>
                </svg>
            </div>
            <div class="col-8 p-0">
                @lang('messages.battles')
            </div>
        </a>
        <a href="#" class="list-group-item-action  row pl-3 pr-1 py-3">
            <div class="col-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <g id="Group_8339" data-name="Group 8339" transform="translate(0.165 -0.307)">
                        <g id="Group_8333" data-name="Group 8333">
                            <g id="Ellipse_3" data-name="Ellipse 3" transform="translate(10.835 0.307)" fill="none" stroke="#fff" stroke-width="1.3">
                                <circle cx="4.5" cy="4.5" r="4.5" stroke="none"/>
                                <circle cx="4.5" cy="4.5" r="3.85" fill="none"/>
                            </g>
                            <g id="Ellipse_444" data-name="Ellipse 444" transform="translate(10.835 11.307)" fill="none" stroke="#fff" stroke-width="1.3">
                                <circle cx="4.5" cy="4.5" r="4.5" stroke="none"/>
                                <circle cx="4.5" cy="4.5" r="3.85" fill="none"/>
                            </g>
                            <g id="Ellipse_442" data-name="Ellipse 442" transform="translate(-0.165 0.307)" fill="none" stroke="#fff" stroke-width="1.3">
                                <circle cx="4.5" cy="4.5" r="4.5" stroke="none"/>
                                <circle cx="4.5" cy="4.5" r="3.85" fill="none"/>
                            </g>
                            <g id="Ellipse_443" data-name="Ellipse 443" transform="translate(-0.165 11.307)" fill="none" stroke="#fff" stroke-width="1.3">
                                <circle cx="4.5" cy="4.5" r="4.5" stroke="none"/>
                                <circle cx="4.5" cy="4.5" r="3.85" fill="none"/>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="col-8 p-0">
                @lang('messages.recommendations')
            </div>
        </a>
        <a href="{{route('players')}}" class="list-group-item-action  row pl-3 pr-1 py-3">
            <div class="col-4 text-center">
                <svg version="1.1" width="25" height="30" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                           fill="#fff"   viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">
                <g>
                    <path d="M175,171.173c38.914,0,70.463-38.318,70.463-85.586C245.463,38.318,235.105,0,175,0s-70.465,38.318-70.465,85.587
                        C104.535,132.855,136.084,171.173,175,171.173z"/>
                    <path d="M41.909,301.853C41.897,298.971,41.885,301.041,41.909,301.853L41.909,301.853z"/>
                    <path d="M308.085,304.104C308.123,303.315,308.098,298.63,308.085,304.104L308.085,304.104z"/>
                    <path d="M307.935,298.397c-1.305-82.342-12.059-105.805-94.352-120.657c0,0-11.584,14.761-38.584,14.761
                        s-38.586-14.761-38.586-14.761c-81.395,14.69-92.803,37.805-94.303,117.982c-0.123,6.547-0.18,6.891-0.202,6.131
                        c0.005,1.424,0.011,4.058,0.011,8.651c0,0,19.592,39.496,133.08,39.496c113.486,0,133.08-39.496,133.08-39.496
                        c0-2.951,0.002-5.003,0.005-6.399C308.062,304.575,308.018,303.664,307.935,298.397z"/>
                </g>

                </svg>
            </div>
            <div class="col-8 p-0">
                players
            </div>
        </a>
        @auth()
            <div class="@if(!session()->has('first_entry_channels'))
            <?php session()->push('first_entry_channels','false') ?>
                animating_channels @endif" id="followers_sidebar_place">

                <a href="#" class="list-group-item-action  row pl-3 pr-1 py-3">
                    <div class="col-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20">
                            <path id="Icon_open-rss-alt" data-name="Icon open-rss-alt"
                                  d="M0,0V5A14.948,14.948,0,0,1,15,20h5A20.027,20.027,
                          0,0,0,0,0ZM0,7.5v5A7.458,7.458,0,0,1,7.5,20h5A12.537,12.537,0,0,0,0,7.5ZM0,15v5H5A5,5,0,0,0,0,15Z" fill="#fff"/>
                        </svg>

                    </div>
                    <div class="col-8 p-0">
                        @lang('messages.followed_users')
                    </div>
                </a>
                @forelse(auth()->user()->followings as $following)
                    <input type="hidden" id="has_followings" value="1">
                    <a href="{{route('user.profile',$following->nickname)}}" class="list-group-item-action">
                        <div class="list-group-item-action  row pl-3 pr-1 py-2">
                            <div class="col-10 pl-2 row offset-2 followed_channels_div ">
                                <div><img src="{{asset('storage/user/images/avatar/'.$following->avatar)}}" class="navbar_profile_icon" alt="user-avatar"></div>
                                <div class="channel_name">
                                    <p class="mb-0 pl-2">{{$following->nickname}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <input type="hidden" id="has_followings" value="0">
                    <div class="list-group-item-action  row pl-3 pr-1 py-2 no_followings">
                        <div class="col-10 pl-2 offset-2 followed_channels_div ">
                            No followed users
                        </div>
                    </div>
                @endforelse




            </div>

            @endauth

        {{--<a href="#" class="list-group-item-action  row pl-3 pr-1 py-3">
            <div class="col-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="23.583" height="23.583" viewBox="0 0 23.583 23.583">
                    <g id="interface" transform="translate(0 0)">
                        <path id="Path_6710" data-name="Path 6710"
                              d="M12.532,23.583h-1.48a2.174,2.174,0,0,1-2.171-2.171v-.5A9.521,9.521,0,0,1,7.4,20.3l-.355.355a2.171,2.171,0,
                              0,1-3.071,0L2.931,19.606a2.171,2.171,0,0,1,0-3.071l.355-.355A9.521,9.521,0,0,1,2.672,14.7h-.5A2.173,2.173,0,0,1,
                              0,12.532v-1.48A2.174,2.174,0,0,1,2.171,8.881h.5A9.523,9.523,0,0,1,3.285,7.4l-.355-.355a2.171,2.171,0,0,1,
                              0-3.071L3.977,2.931a2.171,2.171,0,0,1,3.071,0l.355.355a9.53,9.53,0,0,1,1.478-.614v-.5A2.173,2.173,0,0,1,11.052,
                              0h1.48A2.173,2.173,0,0,1,14.7,2.171v.5a9.521,9.521,0,0,1,1.478.614l.355-.355a2.171,2.171,0,0,1,3.071,0l1.046,
                              1.046a2.171,2.171,0,0,1,0,3.071L20.3,7.4a9.522,9.522,0,0,1,.614,1.478h.5a2.174,2.174,0,0,1,2.171,2.171v1.48A2.174,2.174,0,
                              0,1,21.412,14.7h-.5a9.523,9.523,0,0,1-.614,1.478l.355.355a2.171,2.171,0,0,1,0,3.071l-1.046,1.046a2.171,2.171,0,0,1-3.071,
                              0l-.355-.355a9.53,9.53,0,0,1-1.478.614v.5A2.173,2.173,0,0,1,12.532,23.583Zm-4.9-4.736a8.144,8.144,0,0,0,2.111.876.691.691,
                              0,0,1,.518.669v1.02a.79.79,0,0,0,.789.789h1.48a.79.79,0,0,0,.789-.789v-1.02a.691.691,0,0,1,.518-.669,8.144,8.144,0,0,0,
                              2.111-.876.691.691,0,0,1,.84.106l.723.723a.789.789,0,0,0,1.116,0l1.047-1.047a.789.789,0,0,0,0-1.116l-.723-.723a.691.691,
                              0,0,1-.106-.84,8.143,8.143,0,0,0,.876-2.111.691.691,0,0,1,.669-.518h1.02a.79.79,0,0,0,.789-.789v-1.48a.79.79,0,0,
                              0-.789-.789h-1.02a.691.691,0,0,1-.669-.518,8.144,8.144,0,0,0-.876-2.111.691.691,0,0,1,.106-.84l.723-.723a.789.789,0,0,0,
                              0-1.116L18.629,3.908a.789.789,0,0,0-1.116,0l-.723.723a.691.691,0,0,1-.84.106,8.144,8.144,0,0,0-2.111-.876.691.691,0,0,
                              1-.518-.669V2.171a.79.79,0,0,0-.789-.789h-1.48a.79.79,0,0,0-.789.789v1.02a.691.691,0,0,1-.518.669,8.144,8.144,0,0,
                              0-2.111.876.691.691,0,0,1-.84-.106L6.07,3.908a.789.789,0,0,0-1.116,0L3.908,4.954a.789.789,0,0,0,0,1.116l.723.723a.691.691,0,0,
                              1,.106.84A8.143,8.143,0,0,0,3.86,9.744a.691.691,0,0,1-.669.518H2.171a.79.79,0,0,0-.789.789v1.48a.79.79,0,0,0,.789.789h1.02a.691.691,0,
                              0,1,.669.518,8.144,8.144,0,0,0,.876,2.111.691.691,0,0,1-.106.84l-.723.723a.789.789,0,0,0,0,1.116l1.047,1.047a.789.789,0,0,
                              0,1.116,0l.723-.723a.694.694,0,0,1,.84-.106Z" transform="translate(0 0)" fill="#fff"/>
                        <path id="Path_6711" data-name="Path 6711"
                              d="M149.731,154.862a5.131,5.131,0,1,1,5.131-5.131A5.137,5.137,0,0,1,149.731,154.862Zm0-8.881a3.749,3.749,0,1,
                              0,3.749,3.749A3.754,3.754,0,0,0,149.731,145.982Z" transform="translate(-137.94 -137.94)" fill="#fff"/>
                    </g>
                </svg>

            </div>
            <div class="col-8 p-0">
                @lang('messages.settings')
            </div>
        </a>--}}

    </div>

</div>
