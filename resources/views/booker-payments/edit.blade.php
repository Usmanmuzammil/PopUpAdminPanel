@extends('layouts.master')
@section('title','Update Payments')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Payments</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payments</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Payments</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('orderbookers.payment.index') }}" class="btn btn-primary btn-sm">
                        View Payments
                    </a>
                </div>
            </div><!-- end card header -->


            <div class="card-body">
                @foreach ($payments as $payment)

                <form action="{{ route('orderbookers.payment.update',$payment->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">


                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlSelect1">select Order Booker*<span
                                    class="text-danger">*</span></label>
                            <select name="booker" id="booker_id" class="form-control" required>
                                <option value="">Select Order Booker</option>
                                @foreach ($bookers as $booker)
                                <option {{ ($booker->id==$payment->booker_id)?"selected":"" }} value="{{ $booker->id }}">{{ $booker->name }} ({{ $booker->getBalance($booker->id)  }}) </option>
                                @endforeach

                            </select>
                            @error('booker')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Date*</label>
                            <input type="date" value="{{ $payment->date }}" name="date"  id="" class="form-control"
                                placeholder="" required>
                            @error('date')

                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="Account Number">Amount<span class="text-danger">*</span></label>
                            <input type="number" value="{{ $payment->amount }}" name="amount"  class="form-control" id=""
                                placeholder="Enter amount" required>
                            @error('amount')

                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" value="{{ $payment->description }}" id="" class="form-control"
                                placeholder="description">
                            @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" value="Submit" class="btn btn-primary float-end my-2">
                    </div>
                </form>
                @endforeach

            </div>

        </div>

    </div>
</div>
@section('script')

<script>
    $(document).ready(function() {

        });
</script>
@endsection
@endsection
