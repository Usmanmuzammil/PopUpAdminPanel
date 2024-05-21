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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success!</strong>{{ session('message') }}
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

                    <form action="">
                        <input type="hidden" name="_token" type="hidden"
                            value="JhWpzx0jpnoIqubz8NBT45yMyIvn2cAQ8p6ZYz4o">
                        @csrf


                        <table id="bill_list" class="table-striped table bordered">
                            <thead>
                                <tr>
                                    <th scope="orf">Bill ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Net Total</th>
                                    <th scope="col">Paid </th>
                                    <th scope="col">Remaining </th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bill as $key => $bill)
                                    <tr>
                                        <td>{{ $bill->id }}</td>
                                        <td>{{ $bill->date }}</td>
                                        {{-- <td>{{ (!empty($bill->getCustomer->name))?$bill->getCustomer->name:"Walk-in-customer" }}</td>
						<td><span class="badge bg-warning text-dark">{{ ($bill['bill_status']==1)?'paid':'unpiad' }}</span></td> --}}
                                        <td>{{ $bill->total }}</td>
                                        <td>{{ $bill->discount }}</td>
                                        <td>{{ $bill->net_total }}</td>
                                        <td>{{ $bill->paid_amount ? $bill->paid_amount : '0' }}</td>
                                        <td>{{ $bill->remaining }}</td>
                                        <td><span
                                                class="badge bg-{{ $bill->bill_status == 1 ? 'success' : 'warning' }}">{{ $bill->bill_status == 1 ? 'Paid' : 'Unpaid' }}</span>
                                        </td>

                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{ route('purchase.invoice',$bill->id) }}"
                                                            class="dropdown-item"><i class="fa fa-copy text-primary"></i>
                                                            Genrate invoice</a></li>
                                                    <li><a class="dropdown-item" id="sale_btn"
                                                            data-id="{{ $bill->id }}" href="javascript:void(0)"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#sale-detail{{ $bill->id }}"><i
                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                            view</a></li>
                                                    <li><a class="dropdown-item "
                                                            href="{{ url('/sell/edit/' . $bill->id . '') }}"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a></li>

                                                    <li><a class="" data-bs-toggle="modal" data-bs-target="#delete/{{ $bill->id }}"
                                                            href="#"><i
                                                                class="ri-delete-bin-line"></i> Delete</a></li>

                                                                
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- sale detail modal --}}
                                    <div class="modal fade " id="sale-detail{{ $bill->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                   <a href="{{ url('/sell/gen_invoice/' . $bill->id . '') }}"
                                                        class="btn btn-outline-primary">Print Invoice</a>
                                                    
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">Sale Detail
                                                    </h5>
                                                    <hr>

                                                    <div class="row px-3">
                                                        <center>
                                                            <div style="display: none"
                                                                class="spinner-border text-primary sale-modal-loading"
                                                                role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </center>
                                                        <div class="sale_detail_table"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- sale detail modal end --}}


                                    {{-- delete modal --}}

                                    <div class="modal fade" id="delete/{{ $bill->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              ...
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    
                                @endforeach

                            </tbody>

                        </table>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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


