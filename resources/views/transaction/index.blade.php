@extends('layouts.master')
@section('title','Transactions')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Transcations</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transcations</li>
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
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <p class="card-title">Transactions</p>
        <a href="{{ url('/transaction/create') }}" class="btn btn-primary ">Add Transaction</a>
      </div>

      <div class="card-body">
          <table  id="own-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">

          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Date</th>
              <th scope="col">From Cash & Bank</th>
              <th scope="col">To Cash & Bank</th>
              <th scope="col">Amount</th>
              <th scope="col">Description</th>
              <th scope="col">More</th>
            </tr>
          </thead>
          <tbody>

              @foreach ($transaction as $key => $value)
              <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->date }}</td>
              <td>{{ $value->getAccount('from_account') }}</td>
              <td>{{ $value->getAccount('to_account') }}</td>

              <td>{{ $value->amount }}</td>
              <td>{{ $value->desc }}</td>
              <td>
                <div class="dropdown d-inline-block">
                  <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-fill align-middle"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item "
                      href="{{ route('transaction.invoice',$value->id) }}"><i
                          class="align-bottom me-2 text-muted">-</i>
                      Generate Invoice</a></li>
                      @if(Auth::user()->status==1)

                      <li><a class="dropdown-item "
                        href="{{ route('transaction.edit',$value->id) }}"><i
                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                        Edit</a></li>

                        <li><a class="dropdown-item" href="javascript:void(0)"  data-bs-toggle="modal"
                               data-bs-target="#delete-{{ $value->id }}"
                          href=""><i class="ri-delete-bin-line"></i> &nbsp; Delete</a></li>
                          @endif

                  </ul>
              </div>
              </td>
          </tr>
          <div class="modal fade" id="delete-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Transcation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                  </button>
                </div>
                <div class="modal-body">
                  Do your really want to delete this transaction?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form action="{{ route('transaction.destroy',$value->id) }}" id="form" method="post">
                    @csrf
                    @method('DELETE')
                    {{-- <input type="submit" value="DELETE"> --}}
                    <input  type="submit" value="Delete" class="btn btn-danger">
                </form></div>
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

