@extends('order-booker-pannel.layouts.master')
@section('content')

<!-- Page Content Start -->
<div class="page-content mt-4">

    <div class="container">
        <div class="profile-area">
            <div class="main-profile">
                <div class="media media-60 me-3 rounded-circle">
                    @if(auth()->user()->image=="")
                    <img src="{{ asset('app_assets/images/user/profile.png') }}" alt="profile-image">
                    @endif
                    @if(auth()->user()->image!="")
                    <img src="{{ asset('app_assets/images/user/'.auth()->user()->image.'') }}" alt="profile-image">
                    @endif

                </div>
                <div class="profile-detail">
                    <h6 class="name">{{ Str::ucfirst(auth()->user()->name) }}</h6>
                    <span class="font-12">Username : {{ Str::ucfirst(auth()->user()->user_name) }}</span>
                </div>

            </div>
            <div class="content-box">
                <ul class="row g-2">
                    <li class="col-6">
                        <a href="javascript:void(0)">
                            <div class="dz-icon-box">
                                <i class="icon feather icon-package"></i>
                            </div>
                            <!--<span>Today's Orders <br> {{ auth()->user()->getOrders()->where('date',date('Y-m-d'))->count() ?? 0 }}</span>-->
                            <span>Today's Orders <br> 0</span>
                        </a>
                    </li>
                    <li class="col-6">
                        <a href="javascript:void(0)">
                            <div class="dz-icon-box">
                                <i class="icon feather icon-money">RS</i>
                            </div>
                            <span>Today's Balance <br> 0</span>
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="javascript:void(0)">
                            <div class="dz-icon-box">
                                <i class="icon feather icon-money">RS</i>
                            </div>
                            <span>All Over Balance <br> 0</span>
                        </a>
                    </li>



                </ul>
            </div>
            <div class="title-bar">
                <h6 class="title mb-0">Update Account</h6>
            </div>
            <form class="mb-5" action="{{ route('order-booker.profile.update',auth()->user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row g-2">
                <div class="col-6">
                    <label for="">Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control py-0" autocomplete="off" autofocus name="name" value="{{ Str::ucfirst(auth()->user()->name) }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-6">
                    <label for="">User Name</label>

                        <input type="text" class="form-control py-0 disabled" autocomplete="off" name="user_name" value="{{ Str::ucfirst(auth()->user()->user_name) }}" readonly>
                        @error('user_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-6">
                    <label for="">Nic  <span class="text-danger">*</span> </label>

                    <input type="number" class="form-control" autocomplete="off" value="{{ auth()->user()->nic }}" name="nic" value="" readonly>
                </div>
                <div class="col-6">
                    <label for="">Image</label>

                    <input type="file" class="form-control" name="image">
                </div>
                <div class="col-6">
                    <label for="">Password</label>

                    <input type="password" class="form-control" name="password" value="" >
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-6">
                    <label for="">Confrim Password</label>

                    <input type="password" class="form-control" name="password_confirmation" value="" >
                </div>

                <div class="col-12 mb-4">
                    <input type="submit" class="btn btn-primary my-2 btn-sm float-end rounded-0" name="" id="">
                </div>


            </div>
        </form>

        </div>
    </div>
</div>

@push('script')
    <script>



        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif

    </script>
@endpush


@endsection