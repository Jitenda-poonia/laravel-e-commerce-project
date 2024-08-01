<header class="main-header">
    @php $user = Auth::user() @endphp
    <a href="index2.html" class="logo"><b>{{ $user->designation }}</b></a>

    <nav class="navbar navbar-static-top" role="navigation">
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

                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ enquiryCount() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                        </li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="{{ route('enquiry') }}">
                                        <i class="fa fa-bell"></i> {{ enquiryCount() }} new contact enquiry.
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if ($user->hasMedia('image'))
                            <img src="{{ $user->getFirstMediaUrl('image') }}" class="user-image"
                                alt="User Image">
                        @else
                            <p>No profile photo </p>
                        @endif

                        <span class="hidden-xs">{{ $user->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ $user->getFirstMediaUrl('image') }}" class="img-circle"
                                alt="User Image">
                            <p>
                                {{ $user->name }}-{{ $user->designation }}
                                {{ $user->email }}

                                <small>Member since
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('M. Y') }}</small>

                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('user.show', $user->id) }}" class="fa fa-user"> Profile</a>
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
