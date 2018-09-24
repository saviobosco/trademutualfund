<!-- begin #header -->
<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="/home" class="navbar-brand">
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
    <!-- end navbar-header -->

    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
        <li>
            <a href="{{ url('/home') }}">
                {{ __('Home') }}
            </a>
        </li>
        <li>
            <a href="{{ url('/user_investments/create') }}">
                {{ __('Start Investment') }}
            </a>
        </li>
        <li class="dropdown navbar-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"> {{ Auth::user()->name }} </span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('/profile/view') }}" class="dropdown-item"> {{ __('Profile') }} </a>
                <a href="{{ url('/profile/edit') }}" class="dropdown-item"> {{ __('Edit Profile') }} </a>
                <a href="{{ url('/profile/update_payment_info') }}" class="dropdown-item"> {{ __('Edit Payment Detail') }} </a>
                <a href="{{ url('/profile/update_settings') }}" class="dropdown-item"> {{ __('Edit My Settings') }} </a>
                <a href="{{ url('/profile/change_password') }}" class="dropdown-item">{{ __('Change Password') }}</a>
                <div class="dropdown-divider"></div>
                <a href="javascript:;" class="dropdown-item"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        >Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <!-- end header navigation right -->
</div>
<!-- end #header -->