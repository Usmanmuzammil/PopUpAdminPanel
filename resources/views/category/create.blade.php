@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('category.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Add Catagery</h4>
                    <a href="{{ route('category.index') }}" class="btn btn-primary">View Category</a>
                </div><!-- end card header -->
                @php

                @endphp
                <div class="card-body">
                    <div class="live-preview">

                        <div class="row gy-4">


                            <div class="col-md-6">

                                    <label for="labelInput" class="form-label">Catagery Name*</label>

                                    <input type="text" class="form-control" id="labelInput" name="name"
                                        placeholder="Enter Catagery name">
                                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                </div>

                                <div class="col-12 ">
                                    <input type="submit" name="" id="" class="btn btn-primary float-end mx-3">
                                </div>

                            <!--end col-->


                        </div>
                        <!--end col-->


                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
