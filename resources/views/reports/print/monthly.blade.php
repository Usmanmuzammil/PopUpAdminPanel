
<style>
    .tab{
        width:100%;
        margin: 0px;
    }
  
    th{
    text-align:center;
    padding:5px;
    font-size: 15px;
    border: 1px solid black;
    } 

    td{
        text-align:center;
    padding:5px;
    font-size: 15px;
    }

</style>
<body>
<table class="tab"  cellpadding=0 cellspacing=0>
    
    <tr>
        <th style=" font-size:20px;">
          {{$type}}  Report For {{date('F-Y', strtotime($date)) }}
        </th>
    </tr>
    </table>
    



@php
$pay = "";
    if($type=="Sale")
    $pay= "Recieve";
    else
    $pay= "Send";
@endphp

               

<table style="width:100%;"  cellpadding=5 cellspacing=5>

    <tr>
        <th style="vertical-align: top;">
            @if ($type=='Sale')
                
                                    <table style="width:100%;">

                                        <tr>
                                            <th colspan="{{$type=="Sale"?'8':'7'}}" style="font-size:18px;">{{$type}} Record </th>
                                        </tr>
                                          <tr>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Disc</th>
                                            <th>NetTotal</th>
                                            <th>Paid</th>
                                            <th>Dues</th>
                                           
											<th>Qty</th>
                                          </tr>
                                              
                                              @php 
                                              $total = 0;
                                              $discount = 0;
                                              $net_total = 0;
                                              $paid_amount = 0;
                                              $remaining = 0;
                                              $profit=0;
											  $totalQty=0;
											  $sendtype=0;
												
												
                                              @endphp
                                            @foreach ($report as $key=> $report)
											
											@php
											 if($type=="Sale")
												  $sendtype="sell";
											  else
                                             $sendtype="purchase";
                                              @endphp
                                                    <tr>
                                                        <td>{{ $report->date }}</td>
                                                        <td>{{ number_format(round($report->total)) }}</td>
                                                        <td>{{ number_format(round($report->discount)) }}</td>
                                                        <td>{{ number_format(round($report->net_total)) }}</td>
                                                        <td>{{ number_format(round($report->paid_amount)) }}</td>
                                                        <td>{{ number_format(round($report->remaining)) }}</td>
                                                       
										<td>{{$report->getSaleQtyMonthly($report->date,$sendtype)->total_qty}}</td>
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
                                          
                                          
                                            <tr>
                                                <th>Total</th>
                                                <th>{{  number_format( round($total) ) }}</th>
                                                <th>{{ number_format( round($discount) ) }}</th>
                                                <th>{{ number_format( round($net_total) ) }}</th>
                                                <th>{{ number_format( round($paid_amount) ) }}</th>
                                                <th>{{ number_format( round($remaining) ) }}</th>
                                              
												<th>{{$totalQty}}</th>
                                            </tr>
                                      </table>
            @endif
            @if ($type=='Purchase')
                
            <table style="width:100%;">

                <tr>
                    <th colspan="{{$type=="Sale"?'8':'7'}}" style="font-size:18px;">{{$type}} Record </th>
                </tr>
                  <tr>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Dues</th>
                   
                    
                  </tr>
                      
                      @php 
                      $total = 0;
                      $discount = 0;
                      $net_total = 0;
                      $paid_amount = 0;
                      $remaining = 0;
                      $profit=0;
                      $totalQty=0;
                      $sendtype=0;
                        
                        
                      @endphp
                    @foreach ($purchase as $key=> $purchase)
                    
                    @php
                     if($type=="Sale")
                          $sendtype="sell";
                      else
                     $sendtype="purchase";
                      @endphp
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
                  
                  
                    <tr>
                        <th>Total</th>
                        <th>{{  number_format( round($total) ) }}</th>
                        <th>{{ number_format( round($paid_amount) ) }}</th>
                        <th>{{ number_format( round($remaining) ) }}</th>
                      
                    </tr>
              </table>
@endif
        </th>
             <th style="vertical-align: top;">            
                                    <table style="width:100%;">
                                        <tr>
                                            <th colspan="2" style="font-size:18px;">Payments ({{$pay}})  </th>
                                        </tr>
                                          <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                          </tr>
                                              @php 
                                              $amount = 0;
                                              @endphp
                                            @foreach ($payments as $key=> $payments)
                                                    <tr>
                                                        <td>{{ $payments->date }}</td>
                                                        <td>{{ number_format(round($payments->amount)) }}</td>
                                                    </tr>
                                                    @php 
                                                    $amount +=  $payments->amount;
                                               
                                                    @endphp
                                                    
                                            @endforeach
                                          
                                          
                                            <tr>
                                                <th>Total</th>
                                                <th>{{  number_format( round($amount) ) }}</th>
                                            </tr>
                                      </table>
             </th>
    </tr>
</table>
</body>