@extends('layouts.master')
<title>Daily Sell Report</title>
@section('content')
<style>
     #table {
    width: 100%;
    margin: 0 auto;
    text-align: center;
}
table {
    
    margin: 0 auto;
  display: table;
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
        <h2>Daily sell Report</h2>
        <div class="d-flex my-3">
           
            <input type="date" class="form-control w-25 mx-2" value="{{date('Y-m-d')}}" name='date' id="date" >
            <input type="button" name="dailreport"  id="dailyreport" class="btn btn-primary" value="Submit">
        </div>
    </div>
</div>




<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-12">
        <table class="center-table table yajra-datatables table-striped w-100" id="table" style="text-align: center;">
           <thead>
              <tr>
                <th scope="col">Bill ID</th>
                <th scope="col">Date</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Paid </th>
                <th scope="col">Return</th>
               
              </tr>
            </thead>
            <tfoot>
                <tr>
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
</div>
</div>
@endsection
@section('script')
@parent
<script>
    
    $(document).ready(function(){

	$('#dailyreport').on('click',function(){
    var table = $('#table');
    if ($.fn.DataTable.isDataTable(table)) {
        table.DataTable().destroy();
    }
    table.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('dailyReport') !!}',
            data: function(d) {
                d.date = $('#date').val();
                d.warehouse=$('.warehouse').val();
            }
        },
        columns: [
            {data: 'id'},
            {data: 'date'},
            {data: 'total'},
            {data: 'paid_amount'},
            {data: 'change'}
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                footer:true,
                title: 'Daily Sale Report'
            },
           /* {
                extend: 'pdf',
                title: 'Daily Sale Report',
                footer:true,
                customize: function (doc) {
                    doc.defaultStyle.alignment = 'center';
                    doc.styles.tableHeader.alignment = 'center';
                }
            },*/
            {
                extend: 'print',
                footer:true,
                title: 'Daily Sale Report',
                customize: function (win) {
                    $(win.document.body).addClass('center-aligned');
                    $(win.document.body).css('text-align', 'center');
                    $(win.document.body).find('table').addClass('center-aligned');
                }
            }
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api(), data;
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            var total = api
                .column(2, {search: 'applied'})
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            $(api.column(2).footer()).html('Total Sale Amount' + total);
        }
    });
});



	});
</script>
@endsection