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
    <div class="col-lg-12 ">
        {{-- <center> --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title mb-0 flex-grow-1">Edit Expense</h4>
                <a href="{{ url('Expense') }}" class="btn btn-primary">View Expense</a>
            </div><!-- end card header -->

            <div class="card-body">
              @foreach ($expense as $expense)

                <form action="{{ route('expense.update',$expense) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">


                    <div class="form-group col-md-6">
                      <label for="">Date</label>
                      <input type="date" class="form-control" name="date" value="{{ $expense->date ?? date('Y-m-d') }}">

                      <span class="text-danger">
                      @error('date')
                        {{ $message }}
                      @enderror
                    </span>
                    </div>
                        <div class="form-group mt-2 col-md-6">
                            <label for="exampleFormControlSelect1">Amount</label>
                            <input type="number" name="amount" value="{{ $expense->amount }}" class="form-control" id="" placeholder="Enter Amount">
                            <span class="text-danger">
                        @error('amount')
                                {{ $message }}
                                @enderror
                    </span>
                        </div>

                    </div>


                  <div class="row mt-2">
                      <div class="form-group col-md-12 mt-2">
                          <label for="desc">Description</label>
                          <textarea name="desc" id="" cols="30" rows="2" class="form-control" placeholder="Expense Description">{{ $expense->desc }}</textarea>
                          <span class="text-danger">
                        @error('desc')
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
