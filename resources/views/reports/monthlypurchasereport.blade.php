@extends('layouts.master')
<title>Monthly Purchase Report</title>
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
    
    .dataTables_processing {
      background-color: #fff;
      color: #333;
      font-size: 14px;
      font-weight: bold;
      padding: 10px;
      text-align: center;
      border-radius: 5px;
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
        <h2>Monthly Purchase Report</h2>
        <div class="d-flex my-3">
            <select name="ware house" id="" class="form-control w-25 warehouse">
                <option value="" class="form-control">Select WareHouse</option>
                @foreach ($warehouse as $warehouse)
                    
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                @endforeach
            </select>
            <input type="month" class="form-control w-25 mx-2" name='month' id="month" >
            <input type="button" name="dailreport" id="monthlyreport" class="btn btn-primary" value="Check">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="center-table table yajra-datatables table-striped w-100" id="table">
            <thead>
              <tr>
                <th scope="col">Invoice No#</th>
                <th scope="col">Customer</th>
                <th scope="col">Biller</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Grand Total</th>
                <th scope="col">Paid</th>
                <th scope="col">Dues</th>
              </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Total:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
          </table>
    </div>
</div>
<script>
    
    $(document).ready(function(){
        $('#monthlyreport').on('click',function(){
            
            var table = $('#table');
    if ($.fn.DataTable.isDataTable(table)) {
        table.DataTable().destroy();
    }
    table.DataTable({
    
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('monthlyPurchaseReport') !!}',
                data: function(d) {
                    d.month = $('#month').val();
                    d.warehouse=$('.warehouse').val();
                }
            },
            columns: [
                {data: 'id'},
                {data: 'customer_name'},
                {data: 'biller'},
                {data: 'bill_status',
                render: function (data, type, row) {
                    if (data == 0) {
                        return "<span class='badge bg-warning text-dark'>Unpaid</span>";
                    } else if (data == 1) {
                        return "<span class='badge bg-success text-white'>paid</span>";
                    }
                }
            },
                {data: 'total'},
                {data: 'paid_ammount'},
                {data: 'remaining'}
            ],
            dom: 'Bfrtip',
    buttons: [
        {
                extend: 'excel',
                footer:true,
                title: 'Monthly Purchase Report'
            },
            {
                extend: 'pdf',
                footer:true,
                title: 'Monthly Purchase Report',
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },
            {
                extend: 'print',
                footer:true,
                title: 'Monthly Purchase Report',
                customize: function (win) {
                    $(win.document.body).addClass('center-aligned');
                    $(win.document.body).css('text-align', 'center');
                    $(win.document.body).find('table').addClass('center-aligned');
                }
            },

        
    ],
    footerCallback: function (row, data, start, end, display) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(
                 total
            );
            
            // Total over all pages
            Paid = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(
                  Paid
            );
            
            // Total over all pages
            due = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(6).footer()).html(
                  due
            );
            
        }
    
        });

        $('#monthlyreport').on('click', function(e) {
            e.preventDefault();
            var month=$('#month').val();
            var warehouse=$('.warehouse').val();
            if(month=="" || warehouse==""){
                alert('please select all fields');
            }else{
            table.draw();
            
            }
        });
        });
    });
</script>
@endsection