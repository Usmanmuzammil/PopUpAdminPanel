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
        @if (session('message'))
            <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                <strong>

                    {{ session('message') }}
                </strong>
                <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                                    <th scope="orf">Sr#</th>
                                    <th scope="col">P.Name</th>
                                    <th scope="col">P.Code</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Purchase purchase</th>
                                    <th scope="col">Selling purchase</th>
                                    <th scope="col">O.stock</th>
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
        // $('#ajax_bill_list').DataTable().destroy();
            $('#ajax_bill_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get.product.list') }}',
                    dataSrc: function (json) {
                        console.log(json);
                    },

                     pageLength: 25, // Show 25 entries by default

                columns: [
                    { data: 'id'},
                    { data: 'product_name'},
                    { data: 'product_code'},
                    { data: 'unit_name'},
                    { data: 'purchase_price'},
                    { data: 'selling_price'},
                    { data: 'opening_stock'},
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
