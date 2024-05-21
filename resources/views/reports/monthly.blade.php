@extends('layouts.master')
@section('title')
Monthly Report
@endsection
@section('content')
   
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Monthly Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Monthly Report</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Monthly Report</h4>
                </div>
                <div class="card-body">


                <form method="post" action="{{route('get_monthly_report')}}" >
                                         @csrf
                     
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-group">Select Type </label>
                            <select class="form-control" name="type">
                            <option {{$type=="Sale" ? 'selected':''}} value="Sale">Sale</option>
                            <option {{$type=="Purchase" ? 'selected':''}} value="Purchase">Purchase</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group"> Select Month </label>
                            <input type="month" value="{{$date}}" class="form-control" name="month" id="month">
                                   
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Submit" class="btn btn-primary mt-4" />
                            <input type="submit" value="print" name="print" class="btn btn-warning mt-4" />

                            {{-- <a href="{{route('print_monthly_report',['type'=>$type , 'month' => $date])}}"  class="btn btn-danger mt-4">Print Report</a> --}}
                        </form>
                        </div>
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>


@php
$pay = "";
    if($type=="Sale")
    $pay= "Recieve";
    else
    $pay= "Send";
@endphp

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h6 class="card-title mb-0 flex-grow-1">{{ $type }} For {{date('F-Y', strtotime($date)) }}</h6>
                                </div>
                                <div class="card-body">
                                    @if ($type=='Sale')
                                        
                                    <table id="table" class="table table-bordered table-nowrap" >
                                        <thead>
                                          <tr>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Disc</th>
                                            <th>NetTotal</th>
                                            <th>Paid</th>
                                            <th>Dues</th>
                                            
											<th>Qty</th>
                                          </tr>
                                        </thead>
                                          <tbody>
                                              
                                              @php 
                                              $total = 0;
                                              $discount = 0;
                                              $net_total = 0;
                                              $paid_amount = 0;
                                              $remaining = 0;
                                              $profit =0;
											  $totalQty=0;
											  
											  if($type=="Sale")
												  $sendtype="sell";
											  else
                                             $sendtype="purchase";
                                              @endphp
											  
                                            @foreach ($report as $key=> $report)
                                                    <tr>
                                                        <td>{{ $report->date }}</td>
                                                        <td>{{ number_format(round($report->total)) }}</td>
                                                        <td>{{ number_format(round($report->discount)) }}</td>
                                                        <td>{{ number_format(round($report->net_total)) }}</td>
                                                        <td>{{ number_format(round($report->paid_amount)) }}</td>
                                                        <td>{{ number_format(round($report->remaining)) }}</td>
                                                       
														<td>{{ $report->getSaleQtyMonthly($report->date,$sendtype)->total_qty }}</td>
                                                  
                                                    </tr>
                                                    @php 
                                                    $total +=  $report->total;
                                                    $discount +=  $report->discount;
                                                    $net_total +=  $report->net_total;
                                                    $paid_amount +=  $report->paid_amount;
                                                    $remaining +=  $report->remaining;
                                                    if($type == "Sale"){
                                                    $profit +=  $report->getMonthlyProfit($report->date);
													}
													$totalQty += $report->getSaleQtyMonthly($report->date,$sendtype)->total_qty;
                                            
                                                   @endphp
                                                    
                                            @endforeach
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Total</th>
                                                <th>Disc</th>
                                                <th>NetTotal</th>
                                                <th>Paid</th>
                                                <th>Dues</th>
                                              
												<th>Qty</th>
                                              </tr>
                                            <tr>
                                                <th>Total</th>
                                                <th>{{  number_format( round($total) ) }}</th>
                                                <th>{{ number_format( round($discount) ) }}</th>
                                                <th>{{ number_format( round($net_total) ) }}</th>
                                                <th>{{ number_format( round($paid_amount) ) }}</th>
                                                <th>{{ number_format( round($remaining) ) }}</th>
                                               
												<th>{{$totalQty}}</th>

                                            </tr>
                                          </tfoot>
                                        </thead>
                                      </table>
                                    @endif

                                    @if ($type=='Purchase')
                                    <table id="table" class="table table-bordered table-nowrap" >
                                        <thead>
                                          <tr>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Dues</th>
                                            
											
                                          </tr>
                                        </thead>
                                          <tbody>
                                              
                                              @php 
                                              $total = 0;
                                              $discount = 0;
                                              $net_total = 0;
                                              $paid_amount = 0;
                                              $remaining = 0;
                                              $profit =0;
											  $totalQty=0;
											  
											  if($type=="Sale")
												  $sendtype="sell";
											  else
                                             $sendtype="purchase";
                                              @endphp
											  
                                            @foreach ($purchase as $key=> $purchase)
                                                    <tr>
                                                        <td>{{ $purchase->date }}</td>
                                                        <td>{{ number_format(round($purchase->total_amount)) }}</td>
                                                        
                                                        <td>{{ number_format(round($purchase->paid_amount)) }}</td>
                                                        <td>{{ number_format(round($purchase->remaining)) }}</td>
                                                       
                                                    </tr>
                                                    @php 
                                                    $total +=  $purchase->total_amount;
                                                    $paid_amount +=  $purchase->paid_amount;
                                                    $remaining +=  $purchase->remaining;
                                            
                                                   @endphp
                                                    
                                            @endforeach
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Dues</th>
                                              
                                              </tr>
                                            <tr>
                                                <th>Total</th>
                                                <th>{{  number_format( round($total) ) }}</th>
                                                <th>{{ number_format( round($paid_amount) ) }}</th>
                                                <th>{{ number_format( round($remaining) ) }}</th>
                                               

                                            </tr>
                                          </tfoot>
                                        </thead>
                                      </table>
                                    @endif

                                </div>
                            </div>
                        </div>    
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h6 class="card-title mb-0 flex-grow-1">Payments ({{$pay}}) For {{date('F-Y', strtotime($date)) }}</h6>
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

@endsection