@extends('layouts.master')
@section('title')
Order Booker Report
@endsection
@section('nav-button')

@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Order Booker Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Order Booker Report</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Order Booker Report  </h4>
                </div>
                <div class="card-body">


                <form method="get" action="{{route('booker.get.report')}}" >

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-group">Select Order Booker : </label>
                            <select name="booker" class="form-control" id="">
                                <option value="">Select Booker</option>
                                @if (isset($id))
                                @foreach ($bookers as $booker)
                                    <option {{ ($booker->id==$id)?"selected":"" }} value="{{ $booker->id }}">{{ $booker->name }}</option>
                                @endforeach

                                @else
                                @foreach ($bookers as $booker)
                                <option value="{{ $booker->id }}">{{ $booker->name }}</option>

                                @endforeach
                                 @endif

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-group">From date : </label>
                            <input type="date" name="from_date" value="{{ $from_date ?? date('Y-m-d')}}" id="" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-group"> Select Date </label>
                            <input type="date" class="form-control" value="{{ $to_date ?? date('Y-m-d')}}" name='to_date' id="date" >

                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-4" />
                            <input type="submit" name="print" class="btn btn-warning mt-4" value="Print" >

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
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                        <li class="nav-item">

                            <a class="nav-link active" data-bs-toggle="tab" href="#base-justified-home" role="tab" aria-selected="true">
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#base-justified-payments" role="tab" aria-selected="false">
                                Payments
                            </a>
                        </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content  text-muted">
                        <div class="tab-pane active" id="base-justified-home" role="tabpanel">
                            <div class="d-flex justify-content-between">
                                <h4>Total Orders</h4>


                            </div>

                            <p class="mb-0">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>




                                @if (isset($orders))
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->net_total }}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td colspan="3" class="fw-bold">Total</td>
                                            <td class="fw-bold">{{ $orders->sum('net_total') }}</td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>


                            </p>
                        </div>


                        <div class="tab-pane" id="base-justified-payments" role="tabpanel">
                            <h6>Total Payments</h6>
                            <p class="mb-0">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                @if (isset($payments))
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->date }}</td>
                                        <td>{{ $payment->amount }}</td>

                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="2" class="fw-bold">Total</td>
                                        <td class="fw-bold">{{ $payments->sum('amount') }}</td>
                                    </tr>
                            @endif
                        </tbody>
                    </table>

                            </p>
                        </div>
                    </div>
                </div><!-- end card-body -->
                <div class="card-footer d-flex justify-content-around">
                    <h4>Balance</h4>
                    @isset($balance)

                    <h4 class="badge bg-primary p-2 text-white fs-18">{{ $balance }}</h4>
                    @endisset
                </div>
            </div>
        </div>
    </div>




@endsection
