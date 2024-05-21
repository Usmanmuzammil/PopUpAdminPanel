<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name', '') }}  | Sign In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
    .loader {
    border: 8px solid #fff;
    border-top: 8px solid #405189;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    animation: spin 2s linear infinite;
    position: fixed;
    top: 40%;
    left: 45%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    }


    @keyframes spin {
    0% { transform: rotate(0deg); border-top-color: #571845; }
    25% { border-top-color: #ffc300; }
    50% { border-top-color: #c70039; }
    75% { border-top-color: #ff5733; }
    100% { transform: rotate(360deg); border-top-color: #405189; }
    }

    </style>

</head>

<body>

<div class="loader" id="loader" style="display: none;"></div>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="" class="d-inline-block auth-logo">
                                <img src="{{asset('img/lg.png')}}" alt="" height="30">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome To Kitchen!</h5>
                                <p class="text-muted">Sign in to continue.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{route('kitchen.login.auth')}}">

                                    @csrf
                                    <div class="mb-3">


                                        <input id="email" type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror


                                    </div>

                                    <div class="mb-3">

                                        <div class="position-relative auth-pass-inputgroup mb-3">

                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">


                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit" >Sign In</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->



                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->

    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->




<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!-- particles js -->
<script src="{{asset('assets/libs/particles.js/particles.js')}}"></script>
<!-- particles app js -->
<script src="{{asset('assets/js/pages/particles.app.js')}}"></script>
<!-- password-addon init -->
<script src="{{asset('assets/js/pages/password-addon.init.js')}}"></script>


<!--jquery cdn-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>

<script>
    $(document).ready(function() {
        document.querySelector('form').addEventListener('submit', function () {

            $('.auth-page-wrapper').css('opacity', '0.5');
            $('#loader').show();

            //  $('.container').addClass('opacity-light');
        });

        $(window).on('load', function() {
            // Hide the loader and show the page content
            $('#loader').hide();
            $('.auth-page-wrapper').show();
        });
    });

</script>



</body>
</html>
