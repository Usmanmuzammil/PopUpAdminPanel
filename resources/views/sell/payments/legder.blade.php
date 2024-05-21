@extends('layouts.master')

@section('title')
Customer Ledger
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Customer</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
           
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"> Customer  <span class="text-danger">{{$account->name ?? ""}} </span> Ledger</h4>
                </div>
            
        </div>
        <div class="col">
          
               

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-info rounded-circle fs-3">
                                                <i class="ri-money-dollar-circle-fill align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-white mb-1"> Invoices Total
                                            </p>
                                            <h4 class=" mb-0"><span class="counter-value text-white"
                                                    data-target="{{ $bill_amount ?? 0 }}">0</span></h4>
                                        </div>
                                        
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body bg-success">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-success rounded-circle fs-3">
                                                <i class="ri-arrow-up-circle-fill align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-white mb-1"> Total Payments
                                            </p>
                                            <h4 class=" mb-0"><span class="counter-value text-white"
                                                    data-target="{{ $payment_amount ?? 0 }}">0</span></h4>
                                        </div>
                                       
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body bg-danger">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-danger rounded-circle fs-3">
                                                <i class="ri-arrow-down-circle-fill align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-white mb-1">Balance</p>
                                            <h4 class=" mb-0"><span class="counter-value text-white"
                                                    data-target="{{ $account->getAccountBalance($account->id) ?? 0 }}">0</span></h4>
                                        </div>
                                     
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->


                    <div class="row">
                        
                        <div class="col-md-12">
                            <form action="{{ route('print_customer_report',$account->id) }}" method="get">
                                @csrf
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                   
                                    <div class="col-md-3">
                                    <ul class="nav nav-pills nav-custom nav-custom-light" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#invoices" role="tab">
                                                Sale Invoices
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#payments" role="tab">
                                                Payments
                                            </a>
                                        </li>
                                    </ul>
                                    <input type="hidden" value="{{$account->id}}" name="customer_id" id="customer_id"/>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-2 text-right">
                                        Select Date Range
                                    </div>
                                <div class="col-md-4">
                                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="bx bx-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div> 
                                </div>
                                <input type="hidden" id="selectedStartDate" name="selectedStartDate">
                                <input type="hidden" id="selectedEndDate" name="selectedEndDate">
                                <div class="col-md-1">
                                 <button class="btn btn-primary btn-sm float-end" id="print_report"> Print </button>
                                </div>
                            </div>
                            
                                </div><!-- end card header -->
                            </div>
                        </form>
                        </div>
                    </div>
                
                
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="invoices" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Purchase Invoices</h4>
                                           
                                        </div><!-- end card header -->
                
                                        <div class="card-body">
                                            <div class="">
                                                <table id="customer-invoice-table"
                                                    class="table table-bo.rdered dt-responsive nowrap table-striped align-middle" style="width:100%;">
                                                    <thead class="">
                                                        <tr>
                                                            <th>Invoice</th>
                                                            <th>Date</th>
                                                            <th>Total</th>
                                                            <th>Discount</th>
                                                            <th>Net Total</th>
                                                            <th>Paid</th>
                                                            <th>remaining</th>

                                                        </tr>
                                                    </thead><!-- end thead -->
                
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                
                
                
                
                        <div class="tab-pane" id="payments" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Payments</h4>
                                            <div class="flex-shrink-0">
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                
                                              
                                            </div>
                                        </div><!-- end card header -->
                
                
                
                                        <div class="card-body">
                                            <div class="">
                                                <table id="customer-payment-table"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%;">
                                                    <thead class="">
                                                        <tr>
                                                            <th>TRSID</th>
                                                            <th>Date</th>
                                                            <th>Cash & Bank</th>
                                                            <th>Amount</th>
                                                            <th>Type</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead><!-- end thead -->
                
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                
                    </div>



          
        </div>
    </div>
</div>
@section('script')
    
<script>
    function printInvoice() {
        window.print();
    }

    $(document).ready(function(){

        $(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
  
    $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
      var startDate = picker.startDate.format('YYYY-MM-DD');
      var endDate = picker.endDate.format('YYYY-MM-DD');
      var customerId = $("#customer_id").val();
      $('#selectedStartDate').val(startDate);
        $('#selectedEndDate').val(endDate);
        customer_table_data(startDate,endDate,customerId);
    });

    var startDate = start.format('YYYY-MM-DD');
    var endDate = end.format('YYYY-MM-DD');
    var customerId = $("#customer_id").val();
    $('#selectedStartDate').val(startDate);
        $('#selectedEndDate').val(endDate);
        customer_table_data(startDate, endDate, customerId);





                function customer_table_data(startDate,endDate,customerId){


                    if ($.fn.DataTable.isDataTable('#customer-invoice-table')) {
        // If DataTable is already initialized, just destroy it
        $('#customer-invoice-table').DataTable().destroy();
    }

    if ($.fn.DataTable.isDataTable('#customer-payment-table')) {
        // If DataTable is already initialized, just destroy it
        $('#customer-payment-table').DataTable().destroy();
    }
    

    $('#customer-invoice-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('get_customer_ledger_invoices', ['id' => ':customerId', 'startDate' => ':startDate', 'endDate' => ':endDate']) }}'
                .replace(':customerId', customerId)
                .replace(':startDate', startDate)
                .replace(':endDate', endDate), dataSrc: 'data', // Specify the property containing the data array
                },
                pageLength: 25, // Show 25 entries by default
                columns: [{
                        data: 'id'},
                    {data: 'date', 
                        render: function(data) {
                            var dateObj = new Date(data);
                            var day = dateObj.getDate();
                            var month = dateObj.getMonth() + 1;
                            var year = dateObj.getFullYear();

                            // Pad single-digit day and month with leading zeros if necessary
                            day = day < 10 ? '0' + day : day;
                            month = month < 10 ? '0' + month : month;

                            return day + '-' + month + '-' + year;
                        },
                    },
                    {data: 'total'},
                    {data: 'discount'},
                    {data: 'net_total'},
                    {data: 'paid_amount'},
                    {data: 'remaining'},
                    
                ],
            });
       

            $('#customer-payment-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('get_customer_ledger_payments', ['id' => ':customerId', 'startDate' => ':startDate', 'endDate' => ':endDate']) }}'
                .replace(':customerId', customerId)
                .replace(':startDate', startDate)
                .replace(':endDate', endDate),
                    dataSrc: 'data', // Specify the property containing the data array
                },
                pageLength: 25, // Show 25 entries by default
                columns: [{
                        data: 'id'},
                    {data: 'date', 
                        render: function(data) {
                            var dateObj = new Date(data);
                            var day = dateObj.getDate();
                            var month = dateObj.getMonth() + 1;
                            var year = dateObj.getFullYear();
                             day = day < 10 ? '0' + day : day;
                            month = month < 10 ? '0' + month : month;
                            return day + '-' + month + '-' + year;
                        },
                    },
                    {data: 'get_shop_account_name.name'},
                    {data: 'amount'},
                    {data: 'payment_type'},
                    {data: 'description'},
                ],
            });
       

          
        }
        $('#print_report').click(function() {
      
//       var startDate = $('#selectedStartDate').val();
// var endDate = $('#selectedEndDate').val();
// var supplierId = $("#supplier_id").val();

// // Create the URL with the parameters
// var redirectUrl = '{{ route("print_supplier_report", ["id" => ":supplierId", "startDate" => ":startDate", "endDate" => ":endDate"]) }}'
//   .replace(':supplierId', encodeURIComponent(supplierId))
//   .replace(':startDate', encodeURIComponent(startDate))
//   .replace(':endDate', encodeURIComponent(endDate));

// // Redirect to the URL
// window.location.href = redirectUrl;

});
        

        });

    });
</script>
@endsection

@endsection