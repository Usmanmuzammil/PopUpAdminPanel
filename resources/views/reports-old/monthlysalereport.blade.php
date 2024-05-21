@extends('layouts.master')
<title>Monthly Sale Report</title>
@section('content')
  
<div class="row">
    <div class="col-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
            <strong id="input-error" class="text-dark"></strong>
            <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                          
                         <h2>Monthly Sale Report</h2>
    
                        </div>
                        <div class="card-body">
                                  <form method="post" action="{{route('get_monthly_report')}}" >
                                         @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                           <input type="month" value="{{$date}}" class="form-control" name="month" id="month">
                                    </div>
                                    <div class="col-md-2">
                            <input type="submit" name="dailreport" id="monthlyreport" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

        
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{date('F-Y', strtotime($date)) }}</h4>
            </div>
            <div class="card-body">
                
        <table id="table" class="table table-bordered table-nowrap" >
            <thead>
              <tr>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Total Expense</th>
              </tr>
              <tbody>
                  
                  @php 
                  $total_bill_amount = 0;
                  $total_expense_amount = 0;
                  @endphp
                @foreach ($report as $key=> $report)
                        <tr>
                            <td>{{ $report->date }}</td>
                            <td class="total_bill_amount">{{ number_format(round($report->bill_amount),2) }}</td>
                            <td class="total_expense_amount">{{ number_format(round($report->expense_amount),2) }}</td>
                        </tr>
                        @php 
                        $total_bill_amount +=  $report->bill_amount;
                        $total_expense_amount +=  $report->expense_amount;
                        @endphp
                        
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th>Total</th>
                    <th id="bill_amount">{{  number_format( round($total_bill_amount) ) }}</th>
                    <th id="expense_amount">{{ number_format( round($total_expense_amount) ) }}</th>

                </tr>
              </tfoot>
            </thead>
          </table>
          
            </div>
        </div>
 
@section('script')
@parent
<script>
    
    $(document).ready(function(){
     /*
        $('#monthlyreport').on('click', function(e) {
            e.preventDefault();
            var month=$('#month').val();
            if(month!=""){
                $.ajax({
                    url:"{{ url('/Report/monthlyReport') }}",
                    type:"get",
                    data:{month:month},
                    success:function(data){
                        console.log(data);
                        if(data!=""){
                            $('#table tbody').html(data);
                        }else{
                            $('#table tbody').html(data);

                        }
                    }
                });
            }
        });
        
       /*function footerTotal(){
        var et=0;
                var bt=0;
            $('#table tbody tr').each(function(){
                
                 bt += +$(this).closest('tr').find('.total_bill_amount').text();
                 et += +$(this).closest('tr').find('.total_expense_amount').text();
                
            });
            $('#bill_amount').text(bt);
            $('#expense_amount').text(et);
        }
        */

    });
    
</script>
@endsection
@endsection