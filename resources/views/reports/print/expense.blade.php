
<head>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>Expense Report</title>
</head>

{{-- <table class="tab"  cellpadding=0 cellspacing=0>
    
    <tr>
        <th style=" font-size:20px;">
    Expense  Report <b style="font-weight:bold;"> </b>
        </th>
    </tr>
</table> --}}
<center>
    <section class="bg-white">

        <h3 class="my-2">Expense Report</h3>
        From <span class="badge bg-primary">{{ $from_date ?? "" }}</span> To <span class="badge bg-primary">{{ $to_date ?? "" }}</span>    
    </section>
    </center>    
<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card p-4">
            <table class="table table-bordered" id="tablewithoutbtn">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>From Account</th>
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

<script>
    window.print();
</script>