<?php
use App\Models\OrderBooker;
$booker = new OrderBooker();

?>
<!DOCTYPE html>


<style>

    .tab{
        width:100%;
         font-size:12px;

    }
    .tab td, .tab th{
    text-align:center;
    padding:5px;
    }


    th{
    text-align:center;
    padding:5px;
    border: 1px solid black;
    }

    tr{
        margin-bottom: 30px;
    }

</style>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<div class="container bg-white mt-3">

<div class="row">
    <div class="col-md-12">
        <div class="card my-1">

            <h3 class="text-center my-2">Summary Report</h3>
        </div>
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <label class="form-group"> Month </label>
                        <h5 class="badge bg-success"> {{ date("M-Y", strtotime($m ?? date('M-Y') )) }} </h5>
                    </div>
                    {{-- <div class="col-md-6 text-center">
                        <label class="form-group"> To Date </label>
                        <h5 class="badge bg-success"> {{ date("d-M-Y", strtotime($to_date ?? date('Y-m-d') )) }} </h5>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">

    </div>
    <div class="col-md-6">
        <div class="card px-2">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td colspan="2" class="text-center h4">All Over Report</td>
                    </tr>

                    <tr>
                        <th>Report Category</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Orders</td>
                        @isset($orders)

                        <td class="fw-bolder">{{ $orders->count() }}</td>
                        @endisset

                    </tr>
                    <tr>
                        <td>Total Bill Amount</td>
                        @isset($orders)

                        <td class="fw-bolder">{{ $orders->sum('net_total') }}</td>
                        @endisset

                    </tr>

                    <tr>
                        <td>Total Order Booker Payment</td>
                        @isset($payments)

                        <td class="fw-bolder">{{ $payments }}</td>
                        @endisset
                    </tr>
                    <tr>
                        <td>Total Dining Orders</td>
                        @if(isset($total_dining))
                            <td class="fw-bolder">{{ $total_dining }}</td>
                            @else
                            <td class="fw-bolder">0</td>

                        @endif

                    </tr>
                    <tr>
                        <td>Total Parcel Orders</td>
                        @if(isset($total_parcel))
                            <td class="fw-bolder">{{ $total_parcel }}</td>
                        @else
                        <td class="fw-bolder">0</td>


                        @endif

                    </tr>



                    <tr>
                        <td>Total Takeaway Orders</td>
                        @if(isset($total_takeway))

                        <td class="fw-bolder">{{ $total_takeway }}</td>
                        @else
                        <td class="fw-bolder">0</td>

                     @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card px-2">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td colspan="5" class="text-center h4">Order Booker Payments</td>
                    </tr>

                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Total Bill</th>
                        <th>Payment</th>
                        <th>Balance</th>

                    </tr>
                </thead>
                <tbody>
                    @if (isset($BookerPayments))

                        @foreach ($BookerPayments as $key => $payment)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $payment->getBooker->name }}</td>
                                <td>{{ $payment->getBooker->getOrders()->whereMonth('date',date('m',strtotime($m)))->whereYear('date',date('Y',strtotime($m)))->sum('net_total') }}</td>

                                <td>{{ $payment->total_amount }}</td>
                                <td>{{ $booker->getBalance($payment->booker_id) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 ">
        <div class="card">

            <div class="card-body">

        <table class="table table-bordered table-striped table-hovered">
            <thead>
                <tr>
                    <tr>
                        <td colspan="3" class="text-center h4">Total Product Sell </td>
                    </tr>

                    <th>Sr</th>
                    <th>Product Name</th>
                    <th>Sell Qauntity</th>

                </tr>

            </thead>
            <tbody>
                @isset($daily_sell)

                @foreach ($daily_sell as $key=> $bd)

                    <tr>
                        <th>{{ $key+1 }}</th>
                        <th>{{ App\Models\Product::find($bd->product_id)->product_name }}</th>
                        <th>{{ $bd->total_qty }}</th>

                    </tr>

                    @endforeach
                    @endisset
            </tbody>
        </table>
    </div>

    </div>

    </div>
</div>

</div>




</html>