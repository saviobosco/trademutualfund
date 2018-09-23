<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand">
                <picture>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" >
                </picture>
            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">

            <li>
                <a href="{{ url('home') }}"> {{ __('Home') }} </a>
            </li>
            <li>
                <a href="{{ url('user_investments/create') }}"> {{ __('Start New Invest') }} </a>
            </li>
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs"> {{ Auth::user()->name }} </span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="{{ url('/profile/view') }}"> {{ __('Profile') }} </a></li>
                    <li><a href="{{ url('/profile/edit') }}"> {{ __('Edit Profile') }} </a></li>
                    <li><a href="{{ url('/profile/update_settings') }}"> {{ __('Edit My Settings') }} </a></li>
                    <li><a href="{{ url('/profile/change_password') }}">{{ __('Change Password') }}</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- end #header -->