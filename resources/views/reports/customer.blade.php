@extends('layouts.master')
@section('title')
    Customer Report
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Customer Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Customer Report</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Customer Report</h4>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('get_customer_report') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-group">Select Customer </label>
                                <select class="form-control" name="customer_id" required>
                                    @foreach ($customers as $cs)
                                        <option value="{{ $cs->id }}">{{ $cs->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-group"> From Date </label>
                                <input type="date" name="from_date" value="{{ $from_date }}" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-group"> To Date </label>
                                <input type="date" name="to_date" value="{{ $to_date }}" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" />
                                @if($customer_name)
                                <a href="{{ route('print_customer_report', ['id'=>$customer_name->id,'from_date' => $from_date, 'to_date' => $to_date]) }}"
                                    class="btn btn-danger mt-4">Print Report</a>
                                    @endif
                    </form>
                </div>

            </div>

        </div>
    </div>

    @if($bills)
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h6 class="card-title mb-0 flex-grow-1">


                      <b>  {{$customer_name->name}} </b> Record From <b> {{$from_date}} </b> To  <b> {{$to_date}} </b>
                            
                    </h6>
                </div>
                <div class="card-body">

                    <table id="table" class="table table-bordered table-nowrap" >
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Net Total</th>
                            <th>Paid Amount</th>
                            <th>Remaining</th>
                          </tr>
                        </thead>
                          <tbody>
                              
                              @php 
                              $total = 0;
                              $discount = 0;
                              $net_total = 0;
                              $paid_amount = 0;
                              $remaining = 0;
                             
                              @endphp
                            @foreach ($bills as $key=> $bills)
                                    <tr>
                                        <td>{{ $bills->date }}</td>
                                        <td>{{ $bills->id }}</td>
                                        <td>{{ number_format(round($bills->total),2) }}</td>
                                        <td>{{ number_format(round($bills->discount),2) }}</td>
                                        <td>{{ number_format(round($bills->net_total),2) }}</td>
                                        <td>{{ number_format(round($bills->paid_amount),2) }}</td>
                                        <td>{{ number_format(round($bills->remaining),2) }}</td>
                                    </tr>
                                    @php 
                                    $total +=  $bills->total;
                                    $discount +=  $bills->discount;
                                    $net_total +=  $bills->net_total;
                                    $paid_amount +=  $bills->paid_amount;
                                    $remaining +=  $bills->remaining;
                                    @endphp
                                    
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Net Total</th>
                                <th>Paid Amount</th>
                                <th>Remaining</th>
                              </tr>
                            <tr>
                                <th colspan=2>Total</th>
                                <th>{{  number_format( round($total) ) }}</th>
                                <th>{{ number_format( round($discount) ) }}</th>
                                <th>{{ number_format( round($net_total) ) }}</th>
                                <th>{{ number_format( round($paid_amount) ) }}</th>
                                <th>{{ number_format( round($remaining) ) }}</th>

                            </tr>
                          </tfoot>
                        </thead>
                      </table>
                </div>
            </div>
        </div>    
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h6 class="card-title mb-0 flex-grow-1">Payments </h6>
                </div>
                <div class="card-body">

                    <table id="table" class="table table-bordered table-nowrap" >
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                          <tbody>
                              
                              @php 
                              $amount = 0;
                              @endphp
                            @foreach ($payments as $key=> $payments)
                                    <tr>
                                        <td>{{ $payments->date }}</td>
                                        <td>{{ number_format(round($payments->amount),2) }}</td>
                                    </tr>
                                    @php 
                                    $amount +=  $payments->amount;
                               
                                    @endphp
                                    
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                              </tr>
                            <tr>
                                <th>Total</th>
                                <th>{{  number_format( round($amount) ) }}</th>
                               

                            </tr>
                          </tfoot>
                        </thead>
                      </table>
                </div>
            </div>
        </div>    
        
    </div>
    @endif

@endsection
