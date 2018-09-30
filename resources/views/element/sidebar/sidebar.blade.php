<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="info">
                    {{ Auth::user()->name }}
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Dashboard</li>
            @role('admin')
            <li class="">
                <a href="{{ url('/users/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Users') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/investment_plans/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Investment Plans') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/investment_rules/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Investment Rules') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/global_funds/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Global Funds') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/transactions/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Transactions') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/make_payments/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Provide Helps') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/get_payments/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Get helps') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/transaction_reports/index') }}">
                    <i class="fa fa-users"></i>
                    <span> {{ __('Reports') }} </span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/banks/index') }}">
                    <i class="fa fa-institution"></i>
                    <span> {{ __('Banks') }} </span>
                </a>
            </li>
            @endrole
            <li class="">
                <a href="{{ url('user_investments/index') }}">
                    <i class=""></i>
                    <span> {{ __('My Investments') }} </span>
                </a>
            </li>
            {{--<li class="">--}}
                {{--<a href="{{ url('user_transaction/index') }}">--}}
                    {{--<span> {{ __('My Transactions') }} </span>--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="">
                <a href="{{ url('user_referral/index') }}">
                    <span> {{ __('My Referrals') }} </span>
                </a>
            </li>
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->