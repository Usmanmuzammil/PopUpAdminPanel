@extends('layouts.master')
@section('title')
    Customer
@endsection
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
        <div id="successMessage" class="alert alert-primary text-primary mt-3">
            <p>{{ $message }}</p>
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
                <h4 class="card-title mb-0 flex-grow-1">Create Customer</h4>
                <div class="flex-shrink-0">
                    <a href="{{route('customers.index')}}" class="btn btn-primary btn-sm">
                        View Customers
                    </a>
                </div>
            </div><!-- end card header -->
			
			
            <div class="card-body">
                <form action="{{ route('customers.store') }}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="">Customer Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" required value="{{ old('name') }}" class="form-control" id="" placeholder="Enter Supplier Name">
                      <span class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </span>
                    </div>
                 
                    <div class="col-md-6 mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" value="{{ old('phone') }}" id="" class="form-control" placeholder="Enter Phone Number">
                        <span class="text-danger">
                        @error('phone')
                          {{ $message }}
                          @enderror
                      </span>
                      </div>
                
                <div class="col-md-6 mb-3">
                        <label for="">Opening Balance <span class="text-danger">*</span></label>
                        <input type="number" name="opening_balance" required value="{{ old('oppening_balance') }}" id="" class="form-control" placeholder="Enter Opening Balance">
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
            </div>
        </div>

    </div>
</div>
@endsection
