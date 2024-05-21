@extends('layouts.master')
@section('title','Units')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product Units</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Units</li>
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
            @foreach ($unit as $unit)

            <form action="{{ url('/unit/'.$unit->id) }}" method="post">
                @csrf
                @method('PUT')
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit  Product Unit</h4>
                <a href="{{ url('/unit') }}" class="btn btn-primary">View Product Units</a>
                <div class="flex-shrink-0">
                </div>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    <div class="row gy-4">


                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="labelInput" class="form-label">Unit Name *</label>

                                <input type="text" value="{{ $unit->unit_name }}" class="form-control" id="labelInput" name="name" placeholder="Enter Unit name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">Unit Code *</label>
                                <input type="text" value="{{ $unit->code }}" class="form-control" name="unitCode" id="placeholderInput" placeholder="Unit code">
                                <span class="text-danger">@error('unitCode'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                        <!--end col-->


                </div>
            </div>
            <div class="col-md-6 pb-5 pl-5">
                <input type="submit" name="" id="" class="btn btn-primary float-end mx-3">
            </div>
        </form>
        @endforeach
        </div>
    </div>

</div>

@endsection
