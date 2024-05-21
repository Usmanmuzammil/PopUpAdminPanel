@extends('layouts.master')
@section('title')
   Customer Payments
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Customer Payments</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customer Payments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @if ($message = Session::get('success'))

    <div id="successMessage" class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0" style="z-index: 9999; margin-top: 25px;" role="alert">
        <i class="ri-check-double-line label-icon"></i><strong>{{ $message }}</strong>
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
                  <h5 class="card-title mb-0">Customer Payments</h5>
                  <a href="{{ route('customer_payment.create') }}" class="btn btn-primary btn-sm float-end">Add Customer Payment</a>
              </div>
              <div class="card-body">
                  <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                      <thead>
              <tr>
                <th scope="col">SR</th>
                <th scope="col">Date</th>
                <th scope="col">Customer Name </th>
                <th scope="col">Cash & Bank Account</th>
                <th scope="col">Amount</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($payments as $key => $value)
                <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->date }}</td>
                <td>{{ $value->getAccountName->name }}</td>
                <td>{{ $value->getShopAccountName->name }}</td>
                <td>{{ $value->amount }}</td>
                <td><span class="badge bg-{{$value->payment_type == "receive" ? 'danger':'success'}}">{{ ucwords($value->payment_type) }} </span></td>
                <td>{{ $value->description }}</td>
                <td>
                  <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal" data-bs-target="#view{{ $value->id }}" href="#"><i class=" ri-eye-fill align-bottom me-2 text-muted"></i>View</a></li>

                        <li><a class="dropdown-item edit-item-btn" href="{{ route('customer_payment.edit',$value->id) }}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal" data-bs-target="#delete{{ $value->id }}" href="javascript:void(0)"><i class="ri-delete-bin-line"></i> &nbsp; Delete</a></li>

                    </ul>
                </div>
                </td>
            </tr>

              {{-- delete modal --}}
              <div class="modal fade" id="delete{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Payment</h5>
                     
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Do You Sure You Want To Delete This Payment ...?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route('customer_payment.destroy',$value->id) }}" id="form" method="post">
                        @csrf
                        @method('DELETE')
                        {{-- <input type="submit" value="DELETE"> --}}
                        <input  type="submit" value="Delete" class="btn btn-danger">
                    </form></div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="view{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                      {{-- <div class="text-center"> --}}

                        <h4 class="modal-title text-center" id="exampleModalLabel">Payment View</h4>
                      {{-- </div> --}}
                      

                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <div class="col-6">
                          <label for="" class="fs-22">Date:</label>
                          <strong class="fs-21">{{ $value->date }}</strong>
                        </div>
                        <div class="col-6">
                          <label for="" class="fs-22">Customer Name :</label>
                          <strong class="fs-21">{{ $value->getAccountName->name }}</strong>
                        </div>
                        <div class="col-6">
                          <label for="" class="fs-22">Account :</label>
                          <strong class="fs-21">{{ $value->getShopAccountName->name }}</strong>
                        </div>
                        <div class="col-6">
                          <label for="" class="fs-22">Amount :</label>
                          <strong class="fs-21">{{ $value->amount }}</strong>
                        </div>
                        <div class="col-12">
                          <div class="alert alert-warning">
                        <strong >Note:{{ $value->description }}</strong>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      
                    </div>
                  </div>
                </div>
              </div>
                @endforeach


            </tbody>
          </table>
    </div>
  </div>
</div>

@endsection

