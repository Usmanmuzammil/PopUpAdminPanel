@extends('layouts.master')
@section('title','Purchase')
@section('content')
<style>
    .invoice-detail .col-4 {
        border: 1px solid black;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Purchase Bills</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Purchase</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@if ($message = Session::get('success'))

<div id="successMessage"
    class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
    style="z-index: 9999; margin-top: 25px;" role="alert">
    <i class="ri-check-double-line label-icon"></i><strong>{{ $message }}</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('danger'))
<div id="dangerMessage"
    class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
    style="z-index: 9999; margin-top: 25px;" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (count($errors) > 0)

<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Purchase Bills</h5>
                <a href="{{ route('purchase.create') }}" class="btn btn-primary float-end">Create Purchase</a>
            </div>
            <div class="card-body">


                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th scope="orf">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Paid Amount</th>
                            <th scope="col">Remaining</th>

                            <th scope="col">More</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase as $key => $purchase)
                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->date }}</td>
                            <td>{{ $purchase->getSupplier->name }}</td>
                            <td>{{ $purchase->total_amount }}</td>
                            <td><span class="badge bg-success">{{ $purchase->paid_amount }}</span></td>
                            <td><span class="badge bg-danger">{{ $purchase->remaining }}</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item edit-item-btn"
                                                href="{{ route('purchase.invoice',$purchase->id) }}"><i
                                                    class="align-bottom me-2 text-muted"></i>-Genrate Invoice</a></li>
                                        <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#view{{ $purchase->id }}" href="#"><i
                                                    class=" ri-eye-fill align-bottom me-2 text-muted"></i>View</a></li>

                                        <li><a class="dropdown-item "
                                                href="{{ route('purchase.edit', $purchase->id) }}"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                Edit</a></li>

                                        <li><a class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $purchase->id }}" href="#"><i
                                                    class="ri-delete-bin-line"></i> Delete</a>
                                        </li>


                                    </ul>
                                </div>
                            </td>
                        </tr>


                        {{-- sale detail modal end --}}

                        <div class="modal fade" id="view{{ $purchase->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Purchase View</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">


                                            <div class="col-12">
                                                <label for="">Date:</label>
                                                <strong>{{ $purchase->date }}</strong>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <div>

                                                    <label for="">Supplier Name :</label>
                                                    <strong>{{ $purchase->getsupplier->name }}</strong>
                                                </div>
                                                <div>
                                                    <label for="">Balance</label>
                                                    <span class="badge bg-primary">{{ $purchase->getsupplier->getAccountBalance($purchase->getsupplier->id) }}</span>
                                                </div>
                                            </div>
                                            <div class="row bordered invoice-detail">
                                                <div class="col-4 text-center">
                                                    <label for="">Amount </label>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <label for="">Paid Amount</label>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <label for="">Remaining </label>
                                                </div>



                                            </div>
                                            <div class="row invoice-detail">

                                                <div class="col-4 text-center">
                                                    <strong>{{ $purchase->total_amount }}</strong>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <strong>{{ $purchase->paid_amount }}</strong>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <strong>{{ $purchase->remaining }}</strong>
                                                </div>


                                            </div>

                                            @if ($purchase->note!="")
                                                <div class="row">

                                                    <div class="col-12 my-2">
                                                        <div class="alert alert-warning">
                                                            Discription: {{ $purchase->note }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="delete{{ $purchase->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('purchase.destroy', $purchase->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Do you realy want to delele bill?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </tbody>

                </table>
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
        // $('#sale_detail_table').html("");
        $('.sale-modal-loading').show();
        $(document).on('click', '#sale_btn', function() {
            var bill_id = $(this).attr('data-id');
            if (bill_id != "") {
                $.ajax({
                    url: "{{ url('/sell/bill_detail') }}",
                    data: {
                        bill_id: bill_id
                    },
                    success: function(data) {
                        console.log(data);
                        // $('#sale_detail_table').html("");
                        $('.sale_detail_table').html(data);
                        $('.sale-modal-loading').hide();
                    }
                });
            }
        });
    });
</script>
@endsection