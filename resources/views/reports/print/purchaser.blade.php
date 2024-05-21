
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
    
    <?php
	$fdate=date("d-M-Y", strtotime($from_date));	
	$tdate=date("d-M-Y", strtotime($to_date));	
	?>	

   
	<th  style=" font-size:20px;">Purchaser {{ucwords($purchaser_name->name)}} Record </th>
	<th  style=" font-size:20px;">From :  <?php echo $fdate; ?> </th>
	<th style="  font-size:20px;">To   : <?php echo  $tdate; ?></th>
	</tr>
    </table>
    <br>
            
<table style="width:100%;"  cellpadding=5 cellspacing=5>

    <tr>
        <th style="vertical-align: top;">
                                    <table style="width:100%;">

                                        <tr>
                                            <th colspan="6" style="font-size:18px; border:0px;">Purchase Record </th>
                                        </tr>
                                          <tr>
                                            <th>Date</th>
                                            <th>ID</th>
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
                                             
                                              @endphp
                                            @foreach ($bills as $key=> $bills)
                                                    <tr>
                                                        <td>{{ $bills->date }}</td>
                                                        <td>{{ $bills->id }}</td>
                                                        <td>{{ number_format(round($bills->total)) }}</td>
                                                        <td>{{ number_format(round($bills->paid_amount)) }}</td>
                                                        <td>{{ number_format(round($bills->remaining)) }}</td>
                                                    </tr>
                                                    @php 
                                                    $total +=  $bills->total_amount;
                                                    $paid_amount +=  $bills->paid_amount;
                                                    $remaining +=  $bills->remaining;
                                                    @endphp
                                                    
                                            @endforeach
                                          
                                          
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th>{{  number_format( round($total) ) }}</th>
                                               
                                                <th>{{ number_format( round($paid_amount) ) }}</th>
                                                <th>{{ number_format( round($remaining) ) }}</th>
                                            </tr>
                                      </table>
        </th>
             <th style="vertical-align: top;">            
                                    <table style="width:100%;">
                                        <tr>
                                            <th colspan="2" style="font-size:18px; border:0px;">Payments Send </th>
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