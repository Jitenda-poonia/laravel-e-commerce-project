<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo"><b>{{ Auth::user()->designation }}</b></a>
    <!-- admin/index.blade.php -->

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <p style="color: white">
                        Login: {{ logintime() }}
                    </p>
                </li>

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ enquiryCount() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                            {{-- <p>10 new members joined today</p> --}}
                        </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="{{ route('enquiry') }}">
                                        <i class="fa fa-bell"></i> {{ enquiryCount() }} new contact enquiry.
                                    </a>
                                </li>

                                {{-- <li>
                                    <a href="{{ route('user.edit', Auth::user()->id) }}">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (auth()->user()->hasMedia('image'))
                            <img src="{{ auth()->user()->getFirstMediaUrl('image') }}" class="user-image"
                                alt="User Image">
                        @else
                            <p>No profile photo </p>
                        @endif


                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ Auth::user()->getFirstMediaUrl('image') }}" class="img-circle"
                                alt="User Image">
                            <p>
                                {{ Auth::user()->name }}-{{ Auth::user()->designation }}
                                {{ Auth::user()->email }}

                                <small>Member since
                                    {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M. Y') }}</small>

                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('user.show', Auth::user()->id) }}" class="fa fa-user"> Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="fa fa-power-off"> Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
