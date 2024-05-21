@extends('layouts.master')
@section('content')
<style>
</style>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>


<!-- end page title -->
<div class="row">
    <div class="col">

        <div class="h-100">


            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1 text-primary">Welcome , {{ Auth::user()->name }} !</h4>
                            <p class="text-muted mb-0">Here's what's happening with your store.</p>
                        </div>
                        @if(Auth::user()->id==1)
                        {{-- <div class="mt-3 mt-lg-0">
                            <div class="filter-toggle btn-group float-end mt-2">
                                <div class="btn-group " role="group" aria-label="Basic example">
                                    <button type="button" id="today"
                                        class="btn btn-secondary btn-sm active">Today</button>
                                    <button type="button" id="week" class="btn btn-secondary btn-sm">Last 7
                                        Days</button>
                                    <button type="button" id="month" class="btn btn-secondary btn-sm">This
                                        Months</button>
                                    <button type="button" id="year" class="btn btn-secondary btn-sm">This Year</button>
                                </div>
                            </div>
                        </div> --}}
                        @endif
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            @if(Auth::user()->id==1)
            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="card overflow-hidden bg-success text-white">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h5 class="lh-base mb-0 text-white">Sale</h5>
                                <p class="mb-0 mt-1 pt-1 fs-18" id="total_sale">0</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-3">
                    <div class="card overflow-hidden bg-danger opacity-75 text-white">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h5 class="lh-base mb-0 text-white">Purchase</h5>
                                <p class="mb-0 mt-1 pt-1 fs-18" id="total_purchase">0</p>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-md-3">
                    <div class="card overflow-hidden bg-info ">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h5 class="lh-base mb-0 text-white">Expense</h5>
                                <p class="mb-0 mt-1 pt-1 fs-18 text-white" id="total_expense">0</p>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->


            </div>
            <div class="row mt-3">

                <div class="col-md-3">
                    <div class="card overflow-hidden bg-soft-primary">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h6 class="lh-base mb-0">You Will Pay</h6>
                                <p class="mb-0 mt-1 pt-1 fs-18" id="you_will_pay">0</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-3">
                    <div class="card overflow-hidden bg-soft-danger ">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h6 class="lh-base mb-0">You Will Receive</h6>
                                <p class="mb-0 mt-1 pt-1 fs-18" id="you_will_receive">0</p>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-3">
                    <div class="card overflow-hidden bg-warning ">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h5 class="lh-base mb-0 text-white">Balance</h5>
                                <p class="mb-0 mt-1 pt-1 fs-18 text-white" id="balance">0</p>

                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->

            </div> --}}
            <!--end col-->

            <div class="row">
                <div class="col-6 ">
                    <!-- Active Tables -->
                    <div class="card p-4">

                        <table class="table table-nowrap mb-0 table table-bordered" id="home">
                            <thead>
                                <tr>

                                    <th scope="col">Order No</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="hometable">


                            </tbody>

                        </table>
                    </div>

                </div>
            </div>


        </div>


        @endif



    </div>
</div>
</div>


@endsection
@section('script')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    $(document).ready(function(){
        var table = $('#home').DataTable();
table.destroy()
        var table = $('#home').DataTable({
            select: {
                style: 'multi',
                items: 'row'
            }
        });
        //   getData('today');
    //       $('#today').click(function(){
    //       getData('today');
    //       $(this).addClass('active');
    //       $('#week').removeClass('active');
    //       $('#month').removeClass('active');
    //       $('#year').removeClass('active');
    //       });

    //       $('#week').click(function(){
    //       getData('week');
    //       $(this).addClass('active');
    //       $('#today').removeClass('active');
    //       $('#month').removeClass('active');
    //       $('#year').removeClass('active');
    //       });

    //       $('#month').click(function(){
    //       getData('month');
    //       $(this).addClass('active');
    //       $('#today').removeClass('active');
    //       $('#week').removeClass('active');
    //       $('#year').removeClass('active');
    //       });

    //       $('#year').click(function(){
    //       getData('year');
    //       $(this).addClass('active');
    //       $('#today').removeClass('active');
    //       $('#week').removeClass('active');
    //       $('#month').removeClass('active');
    //       });

    //       function getData(period) {
    //       $.ajax({
    //           type: 'GET',
    //           url: '{{route('dashboard.period')}}',
    //           data: {period: period},
    //           success: function(response) {
    //             console.log(response);
    //             total_sale = response.total_sale;
    //               total_purchase = response.total_purchase;
    //             total_expense = response.total_expense;
    //             total_profit = response.total_profit;
    //             you_will_pay = response.you_will_pay;
    //             you_will_receive = response.you_will_receive;
    //             balance = response.balance;
    //             boss_balance = response.boss_balance;

    //             profit = (total_profit - total_expense  );

    //               $('#total_sale').text(total_sale.toLocaleString('en-US'));
    //               $('#total_purchase').text(total_purchase.toLocaleString('en-US'));
    //               $('#total_expense').text(total_expense.toLocaleString('en-US'));
    //               $('#total_profit').text(profit.toLocaleString('en-US'));
    //               $('#you_will_pay').text(you_will_pay.toLocaleString('en-US'));
    //               $('#you_will_receive').text(you_will_receive.toLocaleString('en-US'));
    //               $('#balance').text(balance.toLocaleString('en-US'));
    //               $('#boss-balance').text(boss_balance.toLocaleString('en-US'));

    //           }
    //       });
    //   }

      Pusher.logToConsole = true;

var pusher = new Pusher('207c88bd28eb7d0ae2cc', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('my-channel');

channel.bind('my-event', function(data) {
    homeorder();
});

homeorder();
function homeorder(){

$.ajax({
    url: '{{ route('home.orders') }}',
    'type':"GET",
    success: function(res) {
        console.log(res);
        if(res!=""){
            $('#hometable').html(res);
        }
},


});
}

        });
</script>
@endsection
