@extends('layouts.master')
@section('title','Order Booker')
@section('content')


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Order Booker</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Order Booker</li>
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
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Order Booker</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('order-booker.index') }}" class="btn btn-primary ">
                        View Order Booker
                    </a>
                </div>
            </div><!-- end card header -->


            <div class="card-body">
                @foreach ($booker as $booker)

                <form action="{{ route('order-booker.update',$booker->id) }}" method="post">
                    @method('PUT')
                    @csrf
                 <div class="row">

                    <div class="col-md-6 mb-3">
                      <label for="exampleFormControlSelect1">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" required value="{{ $booker->name }}" class="form-control" id="" placeholder="Enter Order Booker Name">
                      <span class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </span>
                    </div>


                    <div class="col-md-6 mb-3">
                      <label for="exampleFormControlSelect1">Nic<span class="text-danger">*</span></label>
                      <input type="number" name="nic" required value="{{ $booker->nic }}" class="form-control" id="" placeholder="Enter Order Booker Nix">
                      <span class="text-danger">
                        @error('nic')
                        {{ $message }}
                        @enderror
                    </span>
                    </div>




                 <div class="col-md-6 mb-3">
                    <label for="">User Name<span class="text-danger">*</span></label>
                    <input type="text" name="user_name" required value="{{ $booker->user_name }}" id="" class="form-control" placeholder="Enter Order Booker User Name">
                    <span class="text-danger">
                    @error('user_name')
                    {{ $message }}
                    @enderror
                </span>
                 </div>
                 <div class="col-md-6 mb-3">
                    <label for="">Password<span class="text-danger">*</span></label>
                    <input type="password" name="password"  value="{{ old('password') }}" id="" class="form-control" placeholder="Enter Order Booker Password">
                    <span class="text-danger">
                    @error('password')
                    {{ $message }}
                    @enderror
                </span>
                 </div>
                 <div class="col-md-6 mb-3">
                    <label for="">Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation"  value="{{ old('password_confirmation') }}" id="" class="form-control" placeholder="Enter Order Booker Confirm Password">
                    <span class="text-danger">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </span>
                 </div>
                 <div class="col-md-6">
                    <input type="submit" class="btn btn-primary mt-4">
                 </div>

                </div>

                  </form>
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
    <script>

        $('form').on('submit', function() {
            $('.loader').show();
            $('.main-content').css('opacity', '0.5');
        });

    </script>

@endsection
