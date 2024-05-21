<?php
use App\Models\OrderBooker;
$booker = new OrderBooker();

?>
@extends('layouts.master')
@section('title')
Summary Report
@endsection
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Summary Report</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Summary Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

@if ($message = Session::get('success'))
<div id="successMessage" class="alert alert-primary text-primary mt-3">
    <p>{{ $message }}</p>
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Summary Report</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{route('get_summary_report')}}">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-group"> Month </label>
                            <input type="month" name="month" value="{{$m ?? date('Y-m')}}" class="form-control" />
                        </div>
                        {{-- <div class="col-md-4">
                            <label class="form-group"> To Date </label>
                            <input type="date" name="to_date" value="{{$to_date ?? date('Y-m-d') }}"
                                class="form-control" />
                        </div> --}}

                        <div class="col-md-4">
                            <input type="submit" value="Submit" class="btn btn-primary mt-4" />
                            <input type="submit" value="Print" name="print" class="btn btn-warning mt-4" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">

                        <div class="text-center">

                            <h4 class=" my-2">Summary Report</h4>
                            <label class="form-group"> Month </label>
                            <h5 class="badge bg-success"> {{ date("M-Y", strtotime($m ?? date('M-Y') )) }} </h5>

                        </div>


                    </div>
                    {{-- <div class="col-md-4">
                        <label class="form-group"> To Date </label>
                        <h5 class="badge bg-success"> {{ date("d-M-Y", strtotime($to_date ?? date('Y-m-d') )) }} </h5>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">


    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">

                <h6 class="card-title mb-0 flex-grow-1">Product Sell Qauntity</h6>

            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped table-hovered">
                    <thead>
                        <tr>
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


    <div class="col-md-6">
        <div class="row">
            <div class="col-12">
                <div class="card px-2">
                    <table class="table table-bordered table-striped">
                        <thead>
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

            <div class="col-12">
                <div class="card px-2">
                    <div class="card-header">

                        <h4>Order Booker Payments</h4>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Order Booker Name</th>
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
    </div>
</div>
@endsection