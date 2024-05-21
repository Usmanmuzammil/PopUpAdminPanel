@extends('layouts.master')
@section('title')
Expense Report
@endsection
@section('nav-button')

@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Expense Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Expense Report</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Expense Report  </h4>
                </div>
                <div class="card-body">


                <form method="GET" action="{{route('expense.report')}}" >

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-group">From date : </label>
                            <input type="date" name="from_date" value="{{date('Y-m-d')}}" id="" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-group"> Select Date </label>
                            <input type="date" class="form-control" value="{{date('Y-m-d')}}" name='to_date' id="date" >

                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Submit" class="btn btn-primary mt-4" />
                            <button type="submit" name="print" class="btn btn-warning mt-4" >Print</button>

                        </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <table class="table border" id="tablewithoutbtn">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Cash & Bank Account</th>
                            <th>Amount</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if(count($expense)>0)
                        @foreach ($expense as  $key=>$expense)
                        <tr>
                                <th>{{ $key+1 }}</th>
                                <td>{{ $expense->date }}</td>
                                <td>{{ $expense->desc }}</td>
                                <td>{{ $expense->getPayAcc->name }}</td>
                                <td>{{ $expense->amount }}</td>
                            </tr>
                            @endforeach

                        @endif
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th>{{ $total ?? 0 }}</th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection
