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
          {{$type}}  Report <b style="font-weight:bold;"> {{date('D d F Y', strtotime($date)) }} </b>
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
                                            <th colspan="{{$type=="Sale" ? '9':'8'}}" style="font-size:18px;">{{$type}} Record </th>
                                        </tr>
                                          <tr>
                                            <th>Date</th>
                                            <th>{{$type=="Sale"? "Customer":"Pusrchaser"}}</th>
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
                                              $qty=0;
                                             
                                              @endphp
                                            @foreach ($bills as $key=> $bills)
                                                    <tr>
                                                        <td>{{ $bills->date }}</td>
                                                        <td>{{ $bills->getCustomer->name }}</td>
                                                        <td>{{ number_format(round($bills->total)) }}</td>
                                                        <td>{{ number_format(round($bills->discount)) }}</td>
                                                        <td>{{ number_format(round($bills->net_total)) }}</td>
                                                        <td>{{ number_format(round($bills->paid_amount)) }}</td>
                                                        <td>{{ number_format(round($bills->remaining)) }}</td>
                                                       
                                                        <td>{{ $bills->getSaleQty($bills->id)->total_qty }}</td>
                                                       
                                                    </tr>
                                                    @php 
                                                    $total +=  $bills->total;
                                                    $discount +=  $bills->discount;
                                                    $net_total +=  $bills->net_total;
                                                    $paid_amount +=  $bills->paid_amount;
                                                    $remaining +=  $bills->remaining;
                                                    $profit +=  $bills->getProfit($bills->id,$date);
                                                    $qty +=  $bills->getSaleQty($bills->id)->total_qty 
                                                    @endphp
                                                    
                                            @endforeach
                                          
                                          
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th>{{  number_format( round($total) ) }}</th>
                                                <th>{{ number_format( round($discount) ) }}</th>
                                                <th>{{ number_format( round($net_total) ) }}</th>
                                                <th>{{ number_format( round($paid_amount) ) }}</th>
                                                <th>{{ number_format( round($remaining) ) }}</th>
                                            
                                                <th>{{number_format(round($qty))}}</th>
                                            </tr>
                                      </table>

            @endif
            @if ($type=='Purchase')
                
            <table style="width:100%;">

                <tr>
                    <th colspan="{{$type=="Sale" ? '9':'8'}}" style="font-size:18px;">{{$type}} Record </th>
                </tr>
                  <tr>
                    <th>Date</th>
                    <th>{{$type=="Sale"? "Customer":"Pusrchaser"}}</th>
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
                      $qty=0;
                     
                      @endphp
                    @foreach ($purchase as $key=> $purchase)
                            <tr>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase->getSupplier->name }}</td>
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
                        <th colspan="2">Total</th>
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
                                            <th colspan="3" style="font-size:18px;">Payments ({{$pay}})  </th>
                                        </tr>
                                          <tr>
                                            <th>Date</th>
                                            <th>{{$type=="Sale"? "Customer":"Pusrchaser"}}</th>
                                            <th>Amount</th>
                                          </tr>
                                              @php 
                                              $amount = 0;
                                              @endphp
                                            @foreach ($payments as $key=> $payments)
                                                    <tr>
                                                        <td>{{ $payments->date }}</td>
                                                        <td>{{ $payments->getAccountNAme->name }}</td>
                                                        <td>{{ number_format(round($payments->amount)) }}</td>
                                                    </tr>
                                                    @php 
                                                    $amount +=  $payments->amount;
                                               
                                                    @endphp
                                                    
                                            @endforeach
                                          
                                          
                                            <tr>
                                                <th colspan=2>Total</th>
                                                <th>{{  number_format( round($amount) ) }}</th>
                                            </tr>
                                      </table>
             </th>
    </tr>
</table>
</body>