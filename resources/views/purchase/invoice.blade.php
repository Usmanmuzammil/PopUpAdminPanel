@extends('layouts.master')
@section('title')
Purchase
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Purchase</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Purchase</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<style>
    /* Your existing styles here */

    /* Additional styles for invoice-like appearance */
    .invoice-container {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .invoice-header h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .invoice-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-details .left {
        font-weight: bold;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .invoice-table th,
    .invoice-table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .invoice-total {
        text-align: right;
        font-weight: bold;
        font-size: 18px;
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    small {
        font-size: 11px;
    }
     @media print {
    .print-button {
      display: none;
    }
  }
</style>
<div class="container">
    <div class="row">

        <div class="col-12">
            <button class="btn btn-warning float-end print-button" onclick="printInvoice();">Print</button>
        </div>
    </div>
</div>

<div class="invoice-container">
    <div class="invoice-header">
        <h2>Purchase  Invoice</h2>
    </div>

    
    @foreach($purchase as $purchase)
    <div id="receipt-data">
        <div class="invoice-details">
            <div class="left"><span class="fw-normal fs-6">Supplier Name</span>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{ $purchase->getSupplier->name }}</div>
            
        </div>

        <table class="invoice-table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                </tr>
            </thead>
            <tbody>
              
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->date }}</td>
                    
                    <td>{{ $purchase->total_amount }}</td>
                    <td>{{ $purchase->paid_amount }}</td>
                    <td>{{ $purchase->remaining }}</td>
                </tr>
                
            </tbody>
            <tfoot>

                        
                        <tr>
                            
                            <th colspan="4"><strong>Balance</strong></th>
                                
                            <td> <span class="badge bg-primary">{{ $purchase->getSupplier->getAccountBalance($purchase->supplier_id) }}</span></td>
                        </tr>
                        
                
            </tfoot>
        </table>
        @if ($purchase->note!="")
            
        <div class="">
            <div class="col-12">
                <div class="alert alert-warning">{{ $purchase->note }}</div>
            </div>
        </div>
        @endif

      

        <div class="centered" style="margin: 20px 0;">
            <small>Developed By <b>YAS SOLUTION</b> for contact 03123731807</small>
        </div>
    </div>
    @endforeach
</div>
<script>
     function printInvoice() {
        window.print();
    }
</script>
@endsection
