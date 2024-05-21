@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @if (session('message'))


        <div class="alert alert-warning alert-dismissible fade show" role="alert">{{ session('message') }}
            <button type="button" class="float-end close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        @endif
        <div class="card">

            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Category</h4>
                <a href="{{ route('category.index') }}" class="btn btn-primary">View Category</a>
            </div><!-- end card header -->
            @php

            @endphp
            <div class="card-body">
                <div class="live-preview">

                    @foreach ($category as $c)


                    <form action="{{ route('category.update',$c->id) }}" enctype="multipart/form-data" method="post">
                        <div class="row gy-4">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="">Category Name</label>
                                    <input type="text" name="name" value="{{ $c->catagery_name }}" class="form-control">
                                </div>


                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>

                            </div>
                        </form>

                        <!--end col-->



                    @endforeach

                        <!--end col-->

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
