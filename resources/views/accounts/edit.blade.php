@extends('layouts.master')
@section('title','Cash Accounts')
@section('content')


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cash Accounts</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Cash Accounts</li>
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
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit Cash Account</h4>
                <div class="flex-shrink-0">
                    <a href="{{route('account.index')}}" class="btn btn-primary">
                        View Cash Accounts
                    </a>
                </div>
            </div><!-- end card header -->


            <div class="card-body">
                @foreach ($account as $account)

                <form action="{{ route('account.update',$account->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">

                    <div class="col-md-6 mb-3">
                      <label for="exampleFormControlSelect1">Account Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" required value="{{ $account->name }}" class="form-control" id="" placeholder="Enter Account Name">
                      <span class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </span>
                    </div>

                   <div class="col-md-6 mb-3">
                        <label for="Account Number">Account Number</label>
                        <input type="text" name="account_no" value="{{ $account->account_no }}" class="form-control" id="" placeholder="Enter Account Number">
                        <span class="text-danger">
                          @error('account_no')
                          {{ $message }}
                          @enderror
                        </span>
                      </div>



                <div class="col-md-6 mb-3">
                        <label for="">Opening Balance <span class="text-danger">*</span></label>
                        <input type="number" name="opening_balance" required value="{{ $account->opening_balance }}" id="" class="form-control" placeholder="Enter Opening Balance">
                        <span class="text-danger">
                        @error('opening_balance')
                        {{ $message }}
                        @enderror
                    </span>
                    </div>

                  </div>
                    <div class="form-group mt-2">
                        <input type="submit" value="Submit" class="btn btn-primary float-end my-2">
                    </div>
                  </form>
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection
