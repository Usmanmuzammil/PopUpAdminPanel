<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/home') }}" class="logo logo-dark">
            <span class="logo-sm text-white">
                PopUp
            </span>
            <span class="logo-lg text-white">
                PopUp Food
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/home') }}" class="logo logo-light">
            <span class="logo-sm text-white">
                PopUp
            </span>
            <span class="logo-lg text-white h3">
                PopUp Food
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                            <a class="nav-link {!! (Request::is('home') || Request::is('/') ? 'active' : '') !!}"

                               href="{{url('/home')}}">
                                <i class=" ri-dashboard-line"></i> <span> Dashboard</span>
                            </a>
                        </li>



                        {{-- accounts --}}
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sideaccount" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-product-hunt-line"></i> <span data-key="t-dashboards">Accounts</span>
                    </a>
                    <div class="{!! Request::is('account*') || Request::is('transaction*') ? '' : 'collapse' !!} menu-dropdown " id="sideaccount">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">

                                <a class="nav-link menu-link {!! (Request::is('account') || Request::is('account*') ? 'active' : '') !!}" href="{{ route('account.index') }}" aria-expanded="false"
                                    aria-controls="sidebarDashboards">
                                    <span data-key="t-dashboards">Cash Accounts</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('transaction.index') }}" class="nav-link {!! (Request::is('transaction') || Request::is('transaction*') ? 'active' : '') !!}"  data-key="t-ecommerce">Transaction
                                </a>
                            </li>

                        </ul>
                    </div>
                </li> --}}
                <!-- end accounts Menu -->







                {{-- product --}}
                <li class="nav-item">
                    <a class="nav-link menu-link  {!! Request::is('product*') ? 'active' : '' !!}" href="{{ url('/product') }}"  >
                        <i class="ri-product-hunt-line"></i> <span data-key="t-dashboards">Products</span>
                    </a>
                    {{-- <div class="{!! Request::is('product*') ||  Request::is('unit*') ||  Request::is('category*') || Request::is('addons*') || Request::is('attribute*') ? '' : 'collapse' !!} menu-dropdown" id="sidebarproduct">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('unit.index') }}"  class="nav-link {!! Request::is('unit*') ? 'active' : '' !!}"
                                    data-key="t-ecommerce">Units</a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ url('/category') }}" class="nav-link {!! Request::is('category*') ? 'active' : '' !!}" data-key="t-ecommerce">  Category
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/addons') }}" class="nav-link {!! Request::is('addons*') ? 'active' : '' !!}" data-key="t-ecommerce">  Addons
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/attribute') }}" class="nav-link {!! Request::is('attribute*') ? 'active' : '' !!}" data-key="t-ecommerce">  Attribute
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/product') }}" class="nav-link {!! Request::is('product*') ? 'active' : '' !!}" data-key="t-ecommerce">  Products
                                </a>
                            </li>



                        </ul>
                    </div> --}}
                </li>
                <!-- end product Menu -->

                {{-- sale --}}
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarpurchase" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-product-hunt-line"></i> <span data-key="t-dashboards">Purchase</span>
                    </a>
                    <div class="{!! Request::is('purchase*') || Request::is('supplier*') ? '' : 'collapse' !!} menu-dropdown" id="sidebarpurchase">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ url('suppliers') }}" class="nav-link {!! Request::is('supplier*')?"active":"" !!}" data-key="t-ecommerce">
                                    Supplier</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('purchase.index') }}" class="nav-link {!! Request::is('purchase*')?"active":"" !!}" data-key="t-ecommerce">Purchase
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('supplier_payment') }}" class="nav-link {!! Request::is('supplier_payment*')?"active":"" !!}" data-key="t-ecommerce">payments
                                </a>
                            </li>

                        </ul>
                    </div>
                </li> --}}
                {{-- sale end --}}

                {{-- sale --}}
                <li class="nav-item">
                    <a class="nav-link menu-link  {!! Request::is('view_sale_list*') ? 'active' : '' !!}" href="{{ url('view_sale_list') }}" >
                        <i class="ri-product-hunt-line"></i> <span data-key="t-dashboards">Bill</span>
                    </a>
{{--
                    <div class="{!! Request::is('customers*') || Request::is('sell*')?"":"collapse" !!} menu-dropdown" id="sidebarsale">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ url('/sell/create') }}" class="nav-link" data-key="t-ecommerce">Add
                                    Bill</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('customers') }}" class="nav-link" data-key="t-ecommerce"> Customer </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('view_sale_list') }}" class="nav-link" data-key="t-ecommerce">Bill
                                </a>
                            </li>
<li class="nav-item">
                                <a href="{{ url('customer_payment') }}" class="nav-link" data-key="t-ecommerce">Payments
                                </a>
                            </li>


                        </ul>
                    </div> --}}
                </li>
                {{-- sale end --}}

                {{-- orderbooker --}}
                <li class="nav-item">
                    <a class="nav-link menu-link  {!! Request::is('order-booker*') ? 'active' : '' !!}" href="{{ route('order-booker.index') }}"  >
                        <i class="ri-product-hunt-line"></i> <span data-key="t-dashboards">Order Booker</span>
                    </a>

                </li>
                 <li class="nav-item">
                    <a class="nav-link menu-link  {!! Request::is('orderbookers/payment*') ? 'active' : '' !!}" href="{{ route('orderbookers.payment.index') }}"  >
                        <i class="ri-product-hunt-line"></i> <span data-key="t-dashboards">Order Booker Payments</span>
                    </a>

                </li>
                {{-- orderbooker end --}}

                 {{-- expense  --}}


                {{-- report --}}

                <li class="nav-item">
                    <a class="nav-link menu-link {!! Request::is('report*') ? 'active' : '' !!}" href="#sidebarreport" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-file-chart-line"></i> <span data-key="t-dashboards">Reports</span>
                    </a>
                    <div class="{!! Request::is('report*') ? '' : 'collapse' !!}  menu-dropdown" id="sidebarreport">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">

                                <a class="nav-link menu-link  {!! Request::is('report/daily') ? 'active' : '' !!}" href="{{ route('sell_report') }}" aria-expanded="false"
                                    aria-controls="sidebarDashboards">
                                    <span data-key="t-dashboards">Daily Report</span>
                                </a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link menu-link  {!! Request::is('report/summary-report') ? 'active' : '' !!}" href="{{ route('summary_report') }}" aria-expanded="false"
                                    aria-controls="sidebarDashboards">
                                    <span data-key="t-dashboards">Summary Report</span>
                                </a>
                            </li>



                        </ul>

                    </div>
                </li>

                {{-- report --}}


                                {{-- sale end --}}


                                {{-- report --}}





            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
