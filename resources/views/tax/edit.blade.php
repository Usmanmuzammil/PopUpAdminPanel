@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @foreach ($tax as $tax)

            @endforeach
            <form action="{{ url('/tax/'.$tax->id) }}" method="post">
                @csrf
                @method('PUT')
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Tax</h4>
                <div class="flex-shrink-0">
                </div>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    <div class="row gy-4">


                        <div class="col-xxl-3 col-md-5">
                            <div>
                                <label for="labelInput" class="form-label">Tax Name*</label>

                                <input type="text" value="{{ $tax->name }}" class="form-control" id="labelInput" name="name" placeholder="Enter Unit name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <!--end col-->

                        <div class="col-xxl-3 col-md-5">
                            <label for="placeholderInput" class="form-label">Rate*</label>

                            <div class="input-group">
                                <input type="number" value="{{ $tax->rate }}" name="rate" class="form-control" placeholder="Tax Rate" >

                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                            </div>
                              <span class="text-danger">@error('rate'){{ $message }}@enderror</span>

                        </div>
                        <div class="ml-5 col-md-2">
                            <label for="placeholderInput" class="form-label">value*</label>
                            <br>

                            <input type="checkbox" name="value" id="" class="">
                        </div>

                    </div>
                        <!--end col-->


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
