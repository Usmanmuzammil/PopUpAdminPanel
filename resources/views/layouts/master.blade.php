<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name', '') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Sweet Alert css-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="{{asset('assets/1.11.5/css/dataTables.bootstrap5.min.css')}}" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="{{asset('assets/responsive/2.2.9/css/responsive.bootstrap.min.css')}}" />

    <!-- glightbox css -->
    <link rel="stylesheet" href="{{asset('assets/libs/glightbox/css/glightbox.min.css')}}">

    <!--Swiper slider css-->
    <link href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/select2/css/select2.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/select2/select.min.css')}}" rel="stylesheet" />

    {{-- date --}}

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterangepicker.css')}}" />


    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>


    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    PopUp Food
                                </span>
                                <span class="logo-lg">
                                    PopUp Food
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    PopUp Food
                                </span>

                                <span class="logo-lg">
                                    PopUp Food
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <div class="d-sm-flex align-items-center justify-content-between mt-1">
                            <h4 class="mb-sm-0">
                                <a href="{{ url('/sell/pos') }}" class="btn btn-primary"> POS </a>
                                @yield('nav-button')
                            </h4>
                        </div>

                    </div>


                    <div class="d-flex align-items-center">



                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..."
                                                aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">

                                    <i class="ri-user-follow-fill"></i>

                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                            {{Auth::user()->name}}</span>
                                    </span>
                                </span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">{{Auth::user()->name}} !</h6>

                                {{-- <a class="dropdown-item" href="#"><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Profile</span></a> --}}

                                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#update-time">
                                    <i class=" ri-time-line"></i>
                                    Pos Timing
                                </a>


                                <a class="dropdown-item" href="{{route('logout')}}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </header>


        @if(Auth::user()->status==1)

        {{ View::make("components.sidebar") }}
        @else
        {{ View::make("components.sidebar-user") }}

        @endif
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">


            <div class="page-content">
                <div class="container-fluid">



                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <div class="loader" id="loader" style="display: none;"></div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Yas Solution.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Yas Solution.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Modal -->


    {{-- @php --}}
    // Fetch restaurant times from the database
    // $restaurantTimes = \App\Models\RestaurantTime::where('day', now()->format('l'))->first();
    {{-- @endphp --}}

    <!-- Check if start time has passed and end time is on the next day -->
    {{-- @if(
    $restaurantTimes &&
    $restaurantTimes->start_time &&
    $restaurantTimes->end_time &&
    $this->isStartTimePassed($restaurantTimes->start_time) &&
    $this->isEndTimeOnNextDay($restaurantTimes->end_time)
    ) --}}




@php
    $pos = App\Models\pos_seting::latest()->first();

    @endphp



    {{-- @if(App\Models\pos_seting::where('created_at','<',date('Y-m-d H:i:s'))->where('closing_date','<',date('Y-m-d
            H:i:s')) ->count() == 0 ) --}}
            @if ($pos)

            @if( $pos->created_at > date('Y-m-d H:i:s') || $pos->closing_date < date('Y-m-d H:i:s') )
            <div class="modal fade" id="systemStartModal" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="systemStartModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif


                        <div class="modal-header">
                            <h5 class="modal-title" id="systemStartModalLabel">POS Time</h5>

                        </div>
                        <form action="{{ route('setings.store') }}" method="post">
                            <div class="modal-body">
                                <!-- Add your popup content here -->
                                @csrf

                                <div>


                                    <input type="time" class="form-control" value="{{ now()->format('H:i') }}"
                                        name="opening_time" id="" required>
                                    @error('opening_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div>
                                    <label for="">Close Time</label>
                                    <input type="time" class="form-control" name="closing_time" id="" autofocus
                                        required>
                                    @error('closing_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="my-2">

                                    <div class="form-check form-switch form-switch-custom form-switch-success ">
                                        <input class="form-check-input" name="status" value="1" type="checkbox"
                                            role="switch" id="SwitchCheck11">
                                        <label class="form-check-label" for="SwitchCheck11">Check For Every Day</label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">

                                <button type="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

                @endif
                @else
                <div class="modal fade" id="systemStartModal" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="systemStartModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif


                        <div class="modal-header">
                            <h5 class="modal-title" id="systemStartModalLabel">POS Time</h5>

                        </div>
                        <form action="{{ route('setings.store') }}" method="post">
                            <div class="modal-body">
                                <!-- Add your popup content here -->
                                @csrf

                                <div>


                                    <input type="time" class="form-control" value="{{ now()->format('H:i') }}"
                                        name="opening_time" id="" required>
                                    @error('opening_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div>
                                    <label for="">Close Time</label>
                                    <input type="time" class="form-control" name="closing_time" id="" autofocus
                                        required>
                                    @error('closing_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="my-2">

                                    <div class="form-check form-switch form-switch-custom form-switch-success ">
                                        <input class="form-check-input" name="status" value="1" type="checkbox"
                                            role="switch" id="SwitchCheck11">
                                        <label class="form-check-label" for="SwitchCheck11">Check For Every Day</label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">

                                <button type="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

                @endif

        {{-- update time --}}

        <div class="modal fade" id="update-time" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Timing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @php
                    $pos = App\Models\pos_seting::latest()->first();
                    
                    @endphp
                    @if ($pos)
                    @foreach (App\Models\pos_seting::where('created_at','>=',$pos->created_at)->where('created_at','<=',$pos->closing_date)->get() as $time)
                    <form action="{{ route('setings.update',$time->id) }}" method="post">
                        @method('PUT')
                        <div class="modal-body">
                            <!-- Add your popup content here -->
                            @csrf

                            <div>
                                <label for="">Opening Time</label>
                                <input type="time" class="form-control" value="{{ $time->opening_time }}"
                                    name="opening_time" id="" required>
                            </div>
                            <div>
                                <label for="">Close Time</label>
                                <input type="time" class="form-control" value="{{ $time->closing_time }}"
                                    name="closing_time" id="" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @endforeach

                    @endif

                </div>
            </div>
        </div>
        <!-- Trigger the modal to show when the document is ready -->




        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->


        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
        <script src="{{asset('assets/js/plugins.js')}}"></script>


        <!-- glightbox js -->
        <script src="{{asset('assets/libs/glightbox/js/glightbox.min.js')}}"></script>

        <!-- isotope-layout -->
        <script src="{{asset('assets/libs/isotope-layout/isotope.pkgd.min.js')}}"></script>


        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>


        <!--Swiper slider js-->
        <script src="{{asset('assets/libs/swiper/swiper-bundle.min.js')}}"></script>


        <!-- prismjs plugin -->
        <script src="{{asset('assets/libs/prismjs/prism.js')}}"></script>

        <!--jquery cdn-->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>

        <!-- Lord Icon -->
        <script src="{{asset('assets/js/mssddfmo.js')}}"></script>

        <!-- Modal Js -->
        <script src="{{asset('assets/js/pages/modal.init.js')}}"></script>


        <!-- Sweet Alerts js -->
        <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js-->
        <script src="{{asset('assets/js/pages/sweetalerts.init.js')}}"></script>

        <!--datatable js-->
        <script src="{{asset('assets/1.11.5/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/1.11.5/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/responsive/2.2.9/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

        <!-- App js -->

        <!--select2 cdn-->
        <script src="{{asset('assets/select2/js/select2.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/select2.init.js')}}"></script>

        <!--select2 cdn-->
        <script src="{{asset('assets/select2/select.min.js')}}"></script>




        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- barcharts init -->
        <script src="{{asset('assets/js/pages/apexcharts-bar.init.js')}}"></script>


        <!-- radialbar charts init -->
        <script src="{{asset('assets/js/pages/apexcharts-radialbar.init.js')}}"></script>


        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <!-- Include DateRangePicker library -->
        <script type="text/javascript" src="{{asset('assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/daterangepicker.min.js')}}"></script>

        @yield('script')

        <script>
            $(document).ready(function () {
        $('#systemStartModal').modal('show');

        $("#successMessage").delay(5000).slideUp(300);
        $("#dangerMessage").delay(5000).slideUp(300);


    $('#datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'print', 'excel', 'pdf'
        ],

    });


    $('#own-table').DataTable({
        "order": [[ 0, "desc" ]],
    });


    // date

});



        </script>
</body>

</html>
