@extends('order-booker-pannel.layouts.master')
@section('content')
<div class="page-content mt-3 p-b50">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab"
            tabindex="0">
            <div class="container">
                @if ($message = Session::get('message'))
                <div id="dangerMessage"
                    class="alert alert-{{ Session::get('type') }} alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
                    style="z-index: 9999; margin-top: 25px;" role="alert">
                    <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                @endif



                     <div class="row" id="">
                    @if(count($orders)==0)
                    <div class="col alert text-white alert-info">No Order Added Yet</div>
                    @endif


                    <table id="ajax_bill_list" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th scope="orf">Bill ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Net Total</th>
                            <th scope="col">Paid </th>
                            <th scope="col">Remaining </th>
                            <th scope="col">Status</th>
                            <th scope="col">Order Type</th>

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
</div>


@push('script')


<script>
    $(document).ready(function(){
        $('#ajax_bill_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get_order_sale_list') }}',
                    dataSrc: function (json) {
                        console.log(json);
                    },

                     pageLength: 25, // Show 25 entries by default

                columns: [
                    { data: 'id'},
                    { data: 'date'},
                    { data: 'total'},
                    { data: 'net_total'},
                    { data: 'paid_amount'},
                    { data: 'remaining'},
                     { data: 'bill_status'},
                    { data: 'order_type'},

                ],

            });

})

</script>
@endpush

@endsection