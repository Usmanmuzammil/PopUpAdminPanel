@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @if (session('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card">
            @foreach ($variant as $variant)


            <form action="{{ url('/variant/'.$variant->id) }}" method="post">
                @csrf
                @method('PUT')
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">update variant</h4>
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
                                <label for="labelInput" class="form-label">variant Name*</label>

                                <input type="text" value="{{ $variant->name }}" class="form-control" id="labelInput" name="name" placeholder="Enter Unit name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 col-md-6">


                                <label for="placeholderInput" class="form-label">variant value*</label>
                                <div>
                                    @php
                                        if($variant->value==1){
                                            $check="checked";
                                        }else{
                                            $check="";
                                        }
                                    @endphp
                                    <br>
                                <input type="checkbox" class="" name="value" id="placeholderInput" {{ $check }}>
                                {{-- <span class="text-danger">@error('unitCode'){{ $message }}@enderror</span> --}}
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
