@extends('layouts.master')
<title>Account Report</title>
@section('content')
<style>
      table {
        margin: 0 auto;
    }
    table.dataTable thead th,
    table.dataTable tfoot th {
      background-color: #f5f5f5;
      color: #333;
      font-weight: bold;
      text-align: start;
    }
    
    table.dataTable thead th,
    table.dataTable thead td {
      border-bottom: 1px solid #ddd;
    }
    
    table.dataTable tbody td {
      color: #555;
      font-size: 14px;
    }
    
    table.dataTable tbody tr:nth-child(odd) td {
      background-color: #f9f9f9;
    }
    
    table.dataTable tbody tr:hover td {
      background-color: #f5f5f5;
      cursor: pointer;
    }
    
    
    
  </style>
  
<div class="row">
    <div class="col-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
            <strong id="input-error" class="text-dark"></strong>
            <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <h2>Accounts Report</h2>
        <form class="form-inline" id="accountReportForm">
            <div class="mx-2">
            <label for="" class="mx-2">From</label>
            <input type="date" id="fromDate" class="form-control ">
        </div>
        <div class="mx-2">
            <label for="" class="mx-2 ">To</label>
            <input type="date" id="toDate" class="form-control">
        </div>
        <div class="mx-2 w-50">
            <label for="">Select Name</label>
            <select name="" id="accountId" class="form-control w-100">
                @foreach ($name as $name)
                <option value="{{ $name->id }}" >{{ $name->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mx-2">
            <input type="button" name="accountReport" id="accountReportBtn" class="btn btn-primary mt-4" value="Check">
            
        </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        
  <div class="container">
    
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="genralReport" data-toggle="tab" href="#general-report">General Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="accountReport" data-toggle="tab" href="#all-report">Bill Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" id="transactionReport" href="#tablist-report">Transaction Report</a>
      </li>
    </ul>

    <div class="tab-content">
      {{-- genral report --}}
        <div id="general-report" class="tab-pane active mt-4" >
        <table class="center-table table yajra-datatables table-striped w-100" id="table">
            <thead>
              <tr>
                <th scope="col">Invoice No#</th>
                <th scope="col">Date</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Paid Amount</th>
                <th scope="col">Remaining Amount</th>
                <th scope="col">Bill Type</th>
                
              </tr>
            </thead>
          </table>
      </div>

      {{-- Bill Report --}}
      <div id="all-report" class="tab-pane">
        <div id="bill-report" class="tab-pane active mt-4" >
          <table class="center-table table yajra-datatables table-striped w-100" id="bill">
              <thead>
                <tr>
                  <th scope="col">Invoice No#</th>
                  <th scope="col">Total Amount</th>
                  <th scope="col">Paid Amount</th>
                  <th scope="col">Remaining Amount</th>
                  <th scope="col">Date</th>
                  <th scope="col">Bill Type</th>
                  
                </tr>
              </thead>
            </table>
        </div>
      </div>
      {{-- transaction report --}}
      <div id="tablist-report" class="tab-pane">
        <div id="transaction-report" class="tab-pane active mt-4" >
          <table class="center-table table yajra-datatables table-striped w-100" id="transaction">
              <thead>
                <tr>
                  <th scope="col">Invoice No#</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Date</th>
                  <th scope="col">Payment Type</th>
                  
                </tr>
              </thead>
            </table>
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
<script>
    
    $(document).ready(function(){
      // genral report
        $('#accountReportBtn').on('click',function(){
            var table = $('#table');
    if ($.fn.DataTable.isDataTable(table)) {
        table.DataTable().destroy();
    }
    table.DataTable({
    
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('accountReport') !!}',
                data: function(d) {
                    d.fromdate = $('#fromDate').val();
                    d.todate = $('#toDate').val();
                    d.id = $('#accountId').val();
                }
            },
            columns: [
                {data: 'id'},
                {data: 'date'},
                {data: 'total_amount'},
                {data: 'paid_amount'},
                {data: 'remaining'},
                {data: 'source'},
            ],
            dom: 'Bfrtip',
    buttons: [
        {
                extend: 'excel',
                footer:true,
                title: 'Account Gernal Report'
            },
            {
                extend: 'pdf',
                footer:true,
                title: 'Account Genral  Report',
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                extend: 'print',
                footer:true,
                title: 'Account Genral Report',
                customize: function (win) {
                    $(win.document.body).addClass('center-aligned');
                    $(win.document.body).css('text-align', 'center');
                    $(win.document.body).find('table').addClass('center-aligned');
                }
            },

        
    ],
  
    
        });

        });




        // transaction

        $('#accountReportBtn').on('click',function(){
            var table = $('#transaction');
    if ($.fn.DataTable.isDataTable(table)) {
        table.DataTable().destroy();
    }
    table.DataTable({
    
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('transactionReport') !!}',
                data: function(d) {
                    d.fromdate = $('#fromDate').val();
                    d.todate = $('#toDate').val();
                    d.id = $('#accountId').val();
                }
            },
            columns: [
                {data: 'id'},
                {data: 'amount'},
                {data: 'date'},
                {data: 'payment_type'}
            ],
            dom: 'Bfrtip',
    buttons: [
        {
                extend: 'excel',
                footer:true,
                title: 'Account Transaction  Report'
            },
            {
                extend: 'pdf',
                footer:true,
                title: 'Account Transaction Report',
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                extend: 'print',
                footer:true,
                title: 'Account Transaction  Report',
                customize: function (win) {
                    $(win.document.body).addClass('center-aligned');
                    $(win.document.body).css('text-align', 'center');
                    $(win.document.body).find('table').addClass('center-aligned');
                }
            },

        
    ],
  
    
        });

        });


        // bill report
        
        $('#accountReportBtn').on('click',function(){
            var table = $('#bill');
    if ($.fn.DataTable.isDataTable(table)) {
        table.DataTable().destroy();
    }
    table.DataTable({
    
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('billReport') !!}',
                data: function(d) {
                    d.fromdate = $('#fromDate').val();
                    d.todate = $('#toDate').val();
                    d.id = $('#accountId').val();
                }
            },
            columns: [
                {data: 'id'},
                {data: 'total'},
                {data: 'paid_ammount'},
                {data: 'remaining'},
                {data: 'date'},
                {data: 'bill_type'}
            ],
            dom: 'Bfrtip',
    buttons: [
        {
                extend: 'excel',
                footer:true,
                title: 'Account Bills  Report'
            },
            {
                extend: 'pdf',
                footer:true,
                title: 'Account Bills Report',
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                extend: 'print',
                footer:true,
                title: 'Account Bills  Report',
                customize: function (win) {
                    $(win.document.body).addClass('center-aligned');
                    $(win.document.body).css('text-align', 'center');
                    $(win.document.body).find('table').addClass('center-aligned');
                }
            },

        
    ],
  
    
        });

        });
      });

</script>
@endsection