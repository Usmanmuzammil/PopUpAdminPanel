@extends('layouts.master')
@section('title',"Customer")
@section('content')

        <!-- start page title -->
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
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Customer</h4>
                    <a href="{{ url('customers/create') }}" class="btn btn-primary">Add Customer</a>
                </div><!-- end card header -->
                <div class="card-body">
				  <table  id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">    
				  <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Opening Balance</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						
						@if($customers)
                        @foreach ($customers as $key => $customers)
                        <tr>
                                <td>{{ $customers->id }}</td>
                                <td>{{ $customers->name }}</td>
                                <td>{{ ($customers->phone)?$customers->phone:"-" }}</td>
                                <td>{{ $customers->opening_balance }}</td>
                                <td>{{ $customers->getAccountBalance($customers->id) }}</td>
                              
                                <td><div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        {{--<li><a href="javascript:void(0)"  data-toggle="modal" data-target="#{{ $account->id }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>--}}
                                        <li><a class="dropdown-item edit-item-btn" href="{{ route('payment.invoice',$customers->id) }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>View Legder</a></li>

                                        <li><a href="{{ url('customers/'.$customers->id.'/edit') }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li><a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#delete{{ $customers->id }}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i> &nbsp; Delete</a></li> 

                                    </ul>
                                </div>
								</td>
								

								
								
                            </tr>
                            {{-- delete modal --}}
							
                            <div class="modal fade" id="delete{{ $customers->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <strong>Do your realy want to delete this Customer ? All the things related from this Customer will also be deleted..</strong>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form action="{{ url('/customers/'.$customers->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" name="" id="" class="btn btn-danger">
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           
                    @endforeach
						@endif
                    </table>

                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection
