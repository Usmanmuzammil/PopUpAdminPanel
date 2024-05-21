<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>FOOD POPUP | @yield('title')</title> --}}

    <!-- Favicons Icon -->
    {{--
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app_assets/images/favicon.png') }}"> --}}

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app_assets/images/logo.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="manifest.json">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Global CSS -->
    <link href="{{ asset('app_assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('app_assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app_assets/vendor/swiper/swiper-bundle.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{ asset('app_assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    {{-- taoster --}}




</head>

<body>
    <button id="playsound">play</button>

    <input type="hidden" value="{{ auth()->user()->id }}" name="" id="auth_id">

    <div class="page-wrapper">

        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <div class="load-circle">
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <!-- Preloader end-->

        {{ View::make("order-booker-pannel.components.header") }}
        {{ View::make("order-booker-pannel.components.sidebar") }}

        @yield('content')
        {{ View::make("order-booker-pannel.components.footer") }}

    </div>

    <script src="{{ asset('app_assets/js/jquery.js') }}"></script>
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Include Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('app_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('app_assets/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- Swiper --> --}}

    <script src="{{ asset('app_assets/vendor/countdown/jquery.countdown.js') }}"></script><!-- COUNTDOWN FUCTIONS  -->
    <script src="{{ asset('app_assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!-- Swiper -->
    <script src="{{ asset('app_assets/js/dz.carousel.js') }}"></script><!-- Swiper -->
    <script src="{{ asset('app_assets/js/settings.js') }}"></script>
    <script src="{{ asset('app_assets/js/custom.js') }}"></script>
    <script src="{{asset('app_assets/index.js')}}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    
    <script src="{{asset('assets/1.11.5/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/1.11.5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/responsive/2.2.9/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <script>
        $(document).ready(function(){
            toDaysOrder();
            completeOrders();


            function playBeep() {
            $('#playsound').click();

        }

    $('#playsound').click(function(){
         beepSound = new Audio(`{{ asset('assets/sounds/order-beep.mp3') }}`);


         beepSound.play().then(() => {
            // Playback started successfully
        }).catch(function(error) {
            // Handle the error (e.g., show a message or log it)
            console.error('Error playing audio:', error.message);
        });

        setTimeout(function() {
            beepSound.pause();

        }, 5000);

    })


            function toDaysOrder(){
    $.ajax({
        url:'{{ route('order-booker.today.order') }}',
        type:"GET",
        success:function(res){

            if(res!=""){

                $('#today').html(res[1]);
                $('#footer_total_orders').html(res[0]);
                $('#footer_total_complete_orders').html(res[2]);
                $('.timer').each(function() {

            const billId = $(this).data('bill-id');
            updateTimer(this, billId);
            setInterval(function() {
                updateTimer(this, billId);
            }.bind(this), 1000);
        });

            }
        }
    });
}


// coplements order
function completeOrders(){
    $.ajax({
        url:'{{ route('order-booker.complete.order') }}',
        type:"GET",
        success:function(res){

            if(res!=""){

                $('#completeOrders').html(res[1]);
                $('#footer_total_complete_orders').html(res[0]);


            }
        }
    });
}




// Call playBeep to play the beep sound
        var num = 0
        var errorDisplayed = {};
        function updateTimer(timerElement, invoiceNumber) {
            num++;
            const timerDisplay = $(timerElement);
            const storedTime = localStorage.getItem("currentTime_" + invoiceNumber);

            if (storedTime) {
                const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds

                const timeDifference = currentTime - parseInt(storedTime);
                const remainingTime = 900 - timeDifference; // 900 seconds (15 minutes)

                if (remainingTime > 0) {
                    // Display the timer with the remaining time
                    timerDisplay.text(secondsToTime(remainingTime));
                } else {
                    // Handle timer expiration
                // playBeep();
                if(timerDisplay.text()!="Time Expire"){

                    toastr.error('Order Time Expire.', 'Error');




               timerDisplay.html("<span class='badge bg-danger my-1'>Time Expire</span>");

                }else{
             if(localStorage.getItem("currentTime_" + invoiceNumber)){

            localStorage.removeItem('currentTime_'+invoiceNumber);
     }

                }

                                 }
            }else{
     timerDisplay.html("<span class='badge bg-danger my-1'>Time Expire</span>");

            }
        }


        function secondsToTime(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = seconds % 60;

            return `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}:${remainingSeconds.toString().padStart(2, "0")}`;
        }




            auth_id = $('#auth_id').val();

            // today get order

// Play the audio

    Pusher.logToConsole = true;

var pusher = new Pusher('207c88bd28eb7d0ae2cc', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('order-booker-channel');
channel.bind('order-booker-event', function(data) {
    if(data.message[0]==auth_id){

 toastr.success(data.message[1] ,'Success',  {timeOut:10000});
playBeep();
 toDaysOrder();
 completeOrders();
    }
});



        })

    </script>

    @stack('script')
</body>

</html>
