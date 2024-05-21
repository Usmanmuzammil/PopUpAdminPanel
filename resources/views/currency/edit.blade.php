@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @foreach ($currency as $currency)


            <form action="{{ url('/currency/'.$currency->id) }}" method="post">
                @csrf
                @method('PUT')
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Currency</h4>
                <div class="flex-shrink-0">
                </div>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    <div class="row gy-2">


                        <div class="col-xxl-3 col-md-5">
                            <div>
                                <label for="labelInput" class="form-label">Currency Name*</label>

                                <input type="text" class="form-control" value="{{ $currency->currency_name }}" id="labelInput" name="name" placeholder="Enter Currency name">
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-xxl-3 col-md-5">
                            <label for="placeholderInput" class="form-label">Currency Code*</label>

                            <div class="input-group">
                                <input type="text" name="code" value="{{ $currency->currency_code }}" class="form-control" placeholder="Currency Code" >


                              </div>
                              <span class="text-danger">@error('code'){{ $message }}@enderror</span>

                        </div>

            <div class="col-md-2 mt-4">
                <label >Currency Code*</label>
                <br>

                @php
                    if($currency->status==1){
                        $check="checked";
                    }else{
                        $check="";
                    }
                @endphp
                <input type="checkbox" name="status" {{ $check }}>
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
