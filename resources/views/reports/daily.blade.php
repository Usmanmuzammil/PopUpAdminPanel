@extends('layouts.master')
@section('title')
Daily Report
@endsection
@section('nav-button')

@endsection
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"> Daily Report</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active"> Daily Report</li>
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
                <h4 class="card-title mb-0 flex-grow-1">Daily Report </h4>
            </div>
            <div class="card-body">


                <form method="get" action="{{route('sell_report')}}">


                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-group"> Select Date </label>
                            <input type="date" class="form-control" value="{{  $date ?? old('date') ?? date('Y-m-d') }}"
                                name='date' id="date">

                        </div>
                        <div class="col-md-4">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-4" />

                </form>
            </div>

        </div>

    </div>
</div>
</div>
</div>

{{-- <div class="row">
    <div class="col-12">
        <div class="card p-2">
            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order Type</th>
                        <th>Booker Name</th>
                        <th>Total Amount</th>

                    </tr>
                </thead>
                <tbody>
                    @if (isset($sells))

                    @foreach ($sells as $sell)

                    <tr>
                        <td scope="row">{{ $sell->date }}</td>
                        <td scope="row">{{ $sell->order_type }}</td>
                        <td scope="row">{{ $sell->getBooker->name }}</td>
                        <th scope="row">{{ $sell->net_total }}</th>

                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total</td>
                        <th>{{ $sells->sum('net_total') }}</th>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div> --}}
<div class="row mb-3">


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
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h6 class="card-title mb-0 flex-grow-1">Sell Report</h6>
                    </div>
                    <div class="card-body">

                        <table id="table" class="table table-bordered table-nowrap">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($sells))



                                <tr>
                                    <th>{{ $date ?? "-" }}</th>
                                    <th>{{ $sells ?? "0" }}</th>
                                </tr>

                                @endif
                            </tbody>




                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h6 class="card-title mb-0 flex-grow-1">Order Bookers Report</h6>

                    </div>

                    <div class="card-body">

                        <table id="table" class="table table-bordered table-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Bills</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($bookers))
                                @foreach ($bookers as $booker)
                                <tr>
                                    <td>{{ $booker->name }}</td>
                                    <th>{{ $booker->getDailySell($booker->id , $date,true) }}</th>

                                    <th>{{ $booker->getDailySell($booker->id , $date) }}</th>
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



</div>


</div>



@endsection