@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-8">
        @if (session('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card">
            <form action="{{ url('/variant/') }}" method="post">
                @csrf
            <div class="card-header align-items-center d-flex justify-content-between">
                <h4 class="card-title mb-0 flex-grow-1">Add variant</h4>
                <a href="{{ url('variant') }}" class="btn btn-primary">View Variant List</a>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    <div class="row ">


                        <div class="col-md-12">
                            <div>
                                <label for="labelInput" class="form-label">variant Name*</label>

                                <input type="text" class="form-control" id="labelInput" name="name" placeholder="Enter Unit name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->

                    </div>
                    <div class="row">
                    <div class="col-md-12 mt-3">

                        <input type="submit" name="" id="" class="btn btn-primary float-end mx-3">

                    </div>
                    </div>
                        <!--end col-->


                </div>
            </div>
            <div class="col-md-6 pb-5 pl-5">

            </div>
        </form>
        </div>
    </div>

</div>

@endsection
