@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ url('/warehouse') }}" method="post">
                @csrf
            <div class="card-header align-items-center d-flex justify-content-between">
                <h4 class="card-title mb-0 flex-grow-1">Add Warehouse</h4>
                <a href="{{ url('warehouse') }}" class="btn btn-primary">View warehouse List</a>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    <div class="row gy-4">


                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="labelInput" class="form-label">Warehouse Name*</label>

                                <input type="text" class="form-control" value="{{ old('name') }}" id="labelInput" name="name" placeholder="Enter ware house name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">Email*</label>
                                <input type="email" value="{{ old('email') }}" class="form-control" name="email" id="placeholderInput" placeholder="Warehouse email">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                        <!--end col-->
                    <div class="row mt-3">
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="valueInput" class="form-label">phone*</label>
                                <input type="number" value="{{ old('phone') }}" name="phone" id="" class="form-control" placeholder="Phone">
                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="readonlyPlaintext" class="form-label">Address</label>
                                <input type="text" value="{{ old('address') }}" name="address" value="{{ old('address') }}" placeholder="Enter address" class="form-control @error('address') is-invalid @enderror">
                                <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->
                    </div>

                </div>
            </div>
            <div class="col-md-6 pb-5 pl-5">
                <input type="submit" name="" id="" class="btn btn-primary float-end mx-3">
            </div>
        </form>
        </div>
    </div>

</div>

@endsection
