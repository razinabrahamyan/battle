<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{route('dashboard')}}">
                <img src="{{asset('assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="UBATTLE">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-dashboards" data-toggle="collapse" role="button"
                           aria-expanded="true" aria-controls="navbar-dashboards">
                            <i class="fa fa-users-cog text-primary"></i>
                            <span class="nav-link-text">Administrators</span>
                        </a>
                        <div class="collapse show" id="navbar-dashboards">
                            <ul class="nav nav-sm flex-column">
                                @if(\App\Admin::find(auth()->guard('admin')->id())->authorizeRoles(['superadmin']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-admins" data-toggle="collapse" role="button"
                                       aria-expanded="false" aria-controls="navbar-admins">
                                        <i class="fa fa-users text-green"></i>
                                        <span class="nav-link-text">Admins</span>
                                    </a>
                                    <div class="collapse" id="navbar-admins">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{route('admins.view', 2)}}" class="nav-link">
                                                    <i class="fa fa-scroll text-primary"></i>
                                                    Admins
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{route('admins.create', 2)}}" class="nav-link">
                                                    <i class="fa fa-user-plus text-primary"></i>
                                                    Add Admin
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                @if(\App\Admin::find(auth()->guard('admin')->id())->authorizeRoles(['superadmin', 'admin']))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#navbar-moderators" data-toggle="collapse" role="button"
                                           aria-expanded="false" aria-controls="navbar-admins">
                                            <i class="fa fa-users text-red"></i>
                                            <span class="nav-link-text">Moderators</span>
                                        </a>
                                        <div class="collapse" id="navbar-moderators">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{route('admins.view', 3)}}" class="nav-link">
                                                        <i class="fa fa-scroll text-primary"></i>
                                                        Moderators
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('admins.create', 3)}}" class="nav-link">
                                                        <i class="fa fa-user-plus text-primary"></i>
                                                        Add Moderator
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if(\App\Admin::find(auth()->guard('admin')->id())->authorizeRoles(['superadmin', 'admin', 'moderator']))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#navbar-sponsors" data-toggle="collapse" role="button"
                                           aria-expanded="false" aria-controls="navbar-sponsors">
                                            <i class="fa fa-users text-pink"></i>
                                            <span class="nav-link-text">Sponsors</span>
                                        </a>
                                        <div class="collapse" id="navbar-sponsors">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{route('admins.view', 4)}}" class="nav-link">
                                                        <i class="fa fa-scroll text-primary"></i>
                                                        Sponsors
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('admins.create', 4)}}" class="nav-link">
                                                        <i class="fa fa-user-plus text-primary"></i>
                                                        Add Sponsor
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if(\App\Admin::find(auth()->guard('admin')->id())->authorizeRoles(['superadmin', 'admin', 'moderator', 'sponsor']))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#navbar-verifiers" data-toggle="collapse" role="button"
                                           aria-expanded="false" aria-controls="navbar-verifiers">
                                            <i class="fa fa-users text-yellow"></i>
                                            <span class="nav-link-text">Verifiers</span>
                                        </a>
                                        <div class="collapse" id="navbar-verifiers">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{route('admins.view', 5)}}" class="nav-link">
                                                        <i class="fa fa-scroll text-primary"></i>
                                                        Verifiers
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('admins.create', 5)}}" class="nav-link">
                                                        <i class="fa fa-user-plus text-primary"></i>
                                                        Add Verifier
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if(\App\Admin::find(auth()->guard('admin')->id())->authorizeRoles(['superadmin']))
                                    <li class="nav-item">
                                        <a href="{{route('permissions')}}" class="nav-link">
                                            <i class="ni ni-settings-gear-65 text-red"></i>
                                            <b>Permissions</b>
                                        </a>
                                    </li>
                                 @endif
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-users" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-users">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                        <div class="collapse" id="navbar-users">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('users.index','viewers')}}" class="nav-link">Viewers</a>
                                </li>

                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('users.index', 'players')}}" class="nav-link">Players</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-battles" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-battles">
                            <i class="ni ni-controller text-primary"></i>
                            <span class="nav-link-text">Battles</span>
                        </a>
                        <div class="collapse" id="navbar-battles">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('battles.index')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Battles</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-reports" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-battles">
                            <i class="ni ni-controller text-primary"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                        <div class="collapse" id="navbar-reports">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('reports.index')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Reports</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-slider" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-battles">
                            <i class="ni ni-controller text-primary"></i>
                            <span class="nav-link-text">Slider</span>
                        </a>
                        <div class="collapse" id="navbar-slider">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('slider.index')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Sliders</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('slider.create')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Add Slide</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-categories" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-categories">
                            <i class="ni ni-controller text-primary"></i>
                            <span class="nav-link-text">Categories</span>
                        </a>
                        <div class="collapse" id="navbar-categories">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('category.index')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('category.create')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Create Category</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/calendar.html">
                            <i class="ni ni-calendar-grid-58 text-red"></i>
                            <span class="nav-link-text">Calendar</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-settings">
                            <i class="ni ni-settings"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                        <div class="collapse" id="navbar-settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('battle.settings')}}" class="nav-link"> <i class="ni ni-controller text-primary"></i>Battle Settings</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
