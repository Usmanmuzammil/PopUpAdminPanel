@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ url('/currency') }}" method="post">
                @csrf
            <div class="card-header align-items-center d-flex justify-content-between">
                <h4 class="card-title mb-0 flex-grow-1">Add Currency</h4>
                <a href="{{ url('currency') }}" class="btn btn-primary">View Currency List</a>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    <div class="row gy-4">


                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="labelInput" class="form-label">Currency Name*</label>

                                <input type="text" class="form-control" id="labelInput" name="name" placeholder="Enter Currency name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-xxl-3 col-md-6">
                            <label for="placeholderInput" class="form-label">Currency Code*</label>

                            <div class="input-group">
                                <input type="text" name="code" class="form-control" placeholder="Currency Code" >


                              </div>
                              <span class="text-danger">@error('code'){{ $message }}@enderror</span>

                        </div>
                    </div>
                        <!--end col-->


                </div>
            </div>
            <div class="col-md-12 pb-5 pl-5">
                <input type="submit" name="" id="" class="btn btn-primary float-end mx-3">
            </div>
        </form>
        </div>
    </div>

</div>

@endsection
