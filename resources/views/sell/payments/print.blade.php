<html>
<head>
    <title>Report</title>
</head>

<style>

 th,td {
border:1px solid black;
padding:;
}
    </style>
<body>
        <center></center>
        <table  style="width:100%; text-align:center;">
            <tr>
<th colspan="3">               <p style="font-size:20px; padding:4px;"> Customer NAME :  {{ strtoupper($account->name ?? "")}} LEDGER </th>
            </tr>
            <tr >
               
                <th>
                    <p style="font-size:14px; padding:4px;">Date Range: {{ date("d-M-Y" , strtotime($fromDate)) }} To {{ date("d-M-Y" , strtotime($toDate)) }} </p>
                </th>
                <th>
                    <p style="font-size:14px;">Opening Balance: {{ $account->opening_balance }}</p>
                </th>
                <th>
                    <p style="font-size:14px;">Closing Balance: {{ $account->getAccountBalance($account->id) }}</p>
                </th>
            </tr>
        </table>
        <br>
    <table  style="width:100%; text-align:center;" id="tab">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Type</th>
                <th>Total </th>
                <th>Discount</th>
                <th>Net Total</th>
                <th>Paid </th>
                <th>Remaining </th>
                <th>Payment</th>

                
            </tr>
        </thead>
        <tbody>
         
            @foreach ($report as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->net_total }}</td>
                    <td>{{ $item->paid_amount }}</td>
                    <td>{{ $item->remaining }}</td>
                    <td>{{ $item->payment_amount }}</td>

                </tr>
            @endforeach
        </tbody>
       <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th>{{ $totalAmount ?? 0 }}</th>
            <th>{{ $totalDiscount  ?? 0 }}</th>
            <th>{{ $totalNetTotal  ?? 0 }}</th>
            <th>{{ $totalPaid  ?? 0 }}</th>
            <th>{{ $totalRem  ?? 0 }}</th>
            <th>{{ $totalPayment   ?? 0 }}</th>
        </tr>
       </tfoot>
    </table>
</body>
</html>