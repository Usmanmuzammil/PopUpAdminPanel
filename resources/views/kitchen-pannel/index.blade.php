@extends('kitchen-pannel.layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<!-- Include Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-success mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active fs-18" data-bs-toggle="tab" href="#nav-border-justified-pending-order"
                            role="tab" aria-selected="false">
                            <i class=" ri-information-line align-middle me-1"></i> Pending Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-18" data-bs-toggle="tab" href="#nav-border-justified-complete-order"
                            role="tab" aria-selected="false">
                            <i class=" ri-tornado-line me-1 align-middle"></i> Complete Orders
                        </a>
                    </li>
                </ul>
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="nav-border-justified-pending-order" role="tabpanel">
                        <!-- Content for Pending Orders tab -->
                        <div class="row">
                            <div class="col-12">
                                <div class="row mt-2" id="order-section">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="nav-border-justified-complete-order" role="tabpanel">
                        <!-- Content for Complete Orders tab -->
                        <div class="row">
                            <div class="col-12">
                                <div class="row mt-2" id="complete-section">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
















            </div>

        </div>
    </div>



</div>

<div class="row">
    <div class="col-8">

    </div>
    <div class="col-4  border-left border-dark">

    </div>
</div>
<button id="playsound" style="display: none;">play</button>


@push('js')

<script>
    $(document).ready(function(){
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

// Play the audio

    Pusher.logToConsole = true;

var pusher = new Pusher('207c88bd28eb7d0ae2cc', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    console.log(data);

    $('#playsound').click();
    getOrder();

});


    getOrder();

function getOrder(){

    $.ajax({
        url: '{{ route('kitchen.order') }}',
        'type':"GET",
        success: function(data) {
    // Assuming data is an array of orders
    if(data==""){
            $('#order-section').html("")

        }else{
            $('#order-section').html(data)

        }


},

    });
}
completeOrders();
function completeOrders(){

$.ajax({
    url: '{{ route('kitchen.order.complete') }}',
    'type':"GET",
    success: function(res) {

        if(res==""){
            $('#complete-section').html('')

        }else{
            $('#complete-section').html(res)

        }

},


});
}

});


</script>
@endpush
@endsection
