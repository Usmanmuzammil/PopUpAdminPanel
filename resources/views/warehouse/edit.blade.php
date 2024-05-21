@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card">
            @foreach ($warehouse as $warehouse)


            <form action="{{ url('/warehouse/'.$warehouse->id) }}" method="post">
                @method('PUT')
                @csrf
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Warehouse</h4>
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
                                <label for="labelInput" class="form-label">Warehouse Name*</label>

                                <input type="text" value="{{ $warehouse->name }}" class="form-control" id="labelInput" name="name" placeholder="Enter ware house name">
                                @error('name'){{ $message }}@enderror
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">Email*</label>
                                <input type="email" class="form-control" value="{{ $warehouse->email }}" name="email" id="placeholderInput" placeholder="Warehouse email">
                                @error('email'){{ $message }}@enderror
                            </div>
                        </div>
                    </div>
                        <!--end col-->
                    <div class="row mt-3">
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="valueInput" class="form-label">phone*</label>
                                <input type="number" name="phone" id="" value="{{ $warehouse->phone }}" class="form-control" placeholder="Phone">
                                @error('phone'){{ $message }}@enderror
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="readonlyPlaintext" class="form-label">Address</label>
                                <input type="text" name="address" value="{{ $warehouse->address }}" placeholder="Enter address" class="form-control @error('address') is-invalid @enderror">
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
        @endforeach
        </div>
    </div>

</div>

@endsection
