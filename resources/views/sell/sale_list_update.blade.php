@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sale Bills</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bills</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        @if ($message = Session::get('success'))

        <div id="successMessage" class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0" style="z-index: 9999; margin-top: 25px;" role="alert">
            <i class="ri-check-double-line label-icon"></i><strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Sale Bills</h5>
                        <a href="{{ url('/sell/pos') }}" class="btn btn-primary float-end">Add Bill</a>
                    </div>
                    <div class="card-body">



                        <table id="ajax_bill_list" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="orf">Bill ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Booker </th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Net Total</th>
                                    <th scope="col">Paid </th>
                                    <th scope="col">Remaining </th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
@parent

<script>
    function printDiv() {
        var body = document.body.innerHTML;
        var printDiv = document.getElementById('bill_detail_print').innerHTML;
        document.body.innerHTML = printDiv;
        window.print();
        document.body.innerHTML = body;

    }


    $(document).ready(function() {

            $('#ajax_bill_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get_sale_list') }}',
                    dataSrc: function (json) {
                        console.log(json);
                    },

                     pageLength: 25, // Show 25 entries by default

                columns: [
                    { data: 'id'},
                    { data: 'date'},
                    { data: 'booker_name'},
                    { data: 'total'},
                    { data: 'net_total'},
                    { data: 'paid_amount'},
                    { data: 'remaining'},
                     { data: 'bill_status'},
                    { data: 'order_type'},
                    { data: 'actions', orderable: false, searchable: false }
                ],

            });



        $(document).on('click', '#sale_btn', function() {

            var bill_id = $(this).attr('data-id');
            if (bill_id != "") {
                  $('.sale_detail_table').html("");
                $('.sale-modal-loading').show();



                $.ajax({
                    url: "{{ url('/sell/bill_detail') }}",
                    data: {
                        bill_id: bill_id
                    },
                    success: function(data) {
                        console.log(data);
                         $('#sale_detail_table').html("");
                        $('.sale_detail_table').html(data);
                        $('.sale-modal-loading').hide();
                    }
                });
            }
        });



    });
</script>
@endsection
