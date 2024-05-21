<!-- Sidebar -->
<div class="dark-overlay"></div>
<div class="sidebar">
    <div class="inner-sidebar">
        <a href="profile.html" class="author-box">
            <div class="dz-media">
                @if (auth()->user()->image!="")

                <img src="{{ asset('app_assets/images/user/' .auth()->user()->image) }}" alt="author-image">
                @endif
                @if (auth()->user()->image=="")

                <img src="{{ asset('app_assets/images/user/profile.png') }}" alt="author-image">
                @endif

            </div>

            <div class="dz-info">
                <h5 class="name">{{ auth()->user()->name }}</h5>
                <span>{{ auth()->user()->user_name }}</span>
            </div>
        </a>
        <ul class="nav navbar-nav">
            <li>
                <a class="nav-link {!! Request::is('order-bookers') ? 'active' : '' !!}" href="{{ route('order-booker.dashboard') }}">
                    <span class="dz-icon">
                        <i class="icon feather icon-home"></i>
                    </span>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a class="nav-link {!! Request::is('order-bookers/my-orders') ? 'active' : '' !!}" href="{{ route('order-booker.order.index') }}">
                    <span class="dz-icon">
                        <i class="icon feather icon-layers"></i>
                    </span>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a class="nav-link {!! Request::is('order-bookers/delevered-orders') ? 'active' : '' !!}" href="{{ route('order-booker.delevered.order') }}">
                    <span class="dz-icon">
                        <i class="icon feather icon-grid"></i>
                    </span>
                    <span>Complete Orders</span>
                </a>
            </li>   <li>
                <a class="nav-link {!! Request::is('order-bookers/order/reports') ? 'active' : '' !!}" href="{{ route('order-booker.order.report') }}">
                    <span class="dz-icon">
                        <i class="icon feather icon-grid"></i>
                    </span>
                    <span>Report</span>
                </a>
            </li>



            <li>
                <a class="nav-link {!! Request::is('order-bookers/user/profile') ? 'active' : '' !!}" href="{{ route('order-booker.profile') }}">
                    <span class="dz-icon">
                        <i class="icon feather icon-user"></i>
                    </span>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit();">
                    <span class="dz-icon">
                        <i class="icon feather icon-log-out"></i>
                    </span>
                    <span>Logout</span>
                    <form id="logout-form" action="{{ route('booker.logout') }}" method="post">@csrf</form>
                </a>
            </li>

        </ul>
        <div class="sidebar-bottom" style="position: absolute!important;bottom: 35px!important;">

            <div class="app-info">
                <h6 class="name">POPUP FOOD App</h6>
                <span class="ver-info">Order Booker</span>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar End -->
