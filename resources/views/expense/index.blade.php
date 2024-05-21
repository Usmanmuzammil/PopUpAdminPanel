@extends('layouts.master')
@section('title','Expense')
@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Expense</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expense</li>
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

    @if ($message = Session::get('danger'))
        <div id="dangerMessage" class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0" style="z-index: 9999; margin-top: 25px;" role="alert">
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
                    <h5 class="card-title mb-0">Expense</h5>
                    <a href="{{ route('expense.create') }}" class="btn btn-primary ">Add Expese</a>

                </div>
                <div class="card-body">
                    <table id="own-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($expense as $key => $expense)


                            <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->date }}</td>
                                <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->desc }}</td>


                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ url('/Expense/'.$expense->id.'/edit') }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-{{ $expense->id }}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line me-2 text-muted"></i>Delete</a></li>

                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            {{-- delete modal --}}

                            <div class="modal fade" id="delete-{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Expense</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you really want to Delete?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form action="{{ url('/Expense/'.$expense->id.'/destory') }}" method="GET">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" id="" class="btn btn-danger">
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            {{-- delete modal  end--}}

                            {{-- detail modal --}}
                            <div class="modal fade" id="{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Expense </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>Name: </strong>
                                        <span>{{ $expense->desc }}</span>
                                    </div>
                                    <div class="modal-body">
                                        <strong>Amount: </strong>
                                        <span>{{ $expense->amount }}</span>
                                    </div>
                                    <div class="modal-body">
                                        <strong>date: </strong>
                                        <span>{{ $expense->date }}</span>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                </div>
                </div>
            </div>
        </div>
    </div>
    </form>

                    </div>
@endsection
