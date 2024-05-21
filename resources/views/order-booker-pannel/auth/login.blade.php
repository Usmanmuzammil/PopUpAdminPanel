
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wedo.dexignzone.com/xhtml/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Nov 2023 15:18:10 GMT -->
<head>

    <!-- Title -->
	<title>Food-POPUP | Login</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FE4487">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="index, follow">
	<meta name="keywords" content="android, ios, mobile, application template, progressive web app, ui kit, multiple color, dark layout">
	<meta name="description" content="Revolutionize your online store with our Ecommerce App Template. Seamless shopping, secure payments, and personalized recommendations for an exceptional user experience">
	<meta property="og:title" content="Wedo - Ecommerce Mobile App Template ( Bootstrap + PWA )">
	<meta property="og:description" content="Revolutionize your online store with our Ecommerce App Template. Seamless shopping, secure payments, and personalized recommendations for an exceptional user experience.">
	<meta property="og:image" content="https://wedo.dexignzone.com/xhtml/page-error-404.html">
	<meta name="format-detection" content="telephone=no">

	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('app_assets/images/logo.png') }}">

	<!-- Globle Stylesheets -->

	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{ asset('app_assets/css/style.css') }}">

    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

</head>
<body>
    <div class="section-head ml-2 text-center mt-5" style="color: #fe4487;">
        <h1 style="color: #fe4487;">POPUP FOOD</h1>
        <p style="color: #fe4487;">Order Booker App</p>
    </div>
    <div class="container">
        <div class="text-center">
            <img width="200px" src="{{ asset('app_assets/images/logo.png') }}" alt="">
        </div>
    </div>
<div class="page-wrapper">
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->

    <!-- Page Content -->
    <div class="page-content">
		<div class="account-box">
			<div class="container ">


				<div class="account-area">
					<form action="{{ route('order-booker.auth') }}" method="post">
                        @csrf
						<div class="mb-3">
							<label class="form-label" for="name">Username</label>
							<input type="text" id="user_name" name="user_name" autofocus autocomplete="off" class="form-control" placeholder="Type Username Here" required>
                            @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
						</div>
						<div>
							<label class="form-label" for="password">Password</label>
							<div class="mb-3 input-group input-group-icon">
								<input type="password" name="password" id="password" autocomplete="off" class="form-control dz-password" placeholder="Type Password Here" autocomplete="off" required>

							</div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
						</div>

                        <button type="submit" id="submit" class="btn mb-3 btn-primary w-100">Submit</button>
					</form>
				</div>
			</div>
        </div>
    </div>
    <!-- Page Content End -->

</div>
<!--**********************************
    Scripts
***********************************-->
<script src="{{ asset('app_assets/js/jquery.js') }}"></script>
<script src="{{ asset('app_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('app_assets/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- Swiper -->
<script src="{{ asset('app_assets/js/dz.carousel.js') }}"></script><!-- Swiper -->
<script src="{{ asset('app_assets/js/settings.js') }}"></script>
<script src="{{ asset('app_assets/js/custom.js') }}"></script>
<script>
    $(document).ready(function(){
        $('form').submit(function(event) {
                btn = $('#submit');

                btn.html('<span class="spinner-border"></span>')
                btn.attr('disabled',true);
                // Simulate form submission
                // You can replace this with your actual form submission logic
                setTimeout(function() {
                    btn.html('Submit');
                    btn.attr('disabled',false);

                }, 15000);
            });
    })
</script>
</body>

<!-- Mirrored from wedo.dexignzone.com/xhtml/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Nov 2023 15:18:10 GMT -->
</html>
