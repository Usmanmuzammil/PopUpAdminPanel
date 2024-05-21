@extends('layouts.master')
@section('title','Purchase')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Purchase </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Purchase</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@if ($message = Session::get('success'))

<div id="successMessage"
    class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
    style="z-index: 9999; margin-top: 25px;" role="alert">
    <i class="ri-check-double-line label-icon"></i><strong>{{ $message }}</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('danger'))
<div id="dangerMessage"
    class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
    style="z-index: 9999; margin-top: 25px;" role="alert">
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
                <h4 class="card-title mb-0 flex-grow-1">Create Purchase</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary ">
                        View Purchase
                    </a>
                </div>
            </div><!-- end card header -->

            <div class="card-body ">
                @foreach ($purchase as $purchase)
                    
                <form action="{{ route('purchase.update',$purchase) }}" method="POST" accept-charset="UTF-8" id="purchaseForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="">Select Shop Account</label>
                            <select name="account" id="" class="form-control">
                                <option value="">Select Account</option>
                                @foreach ($account as $account)
                                <option value="{{ $account->id }}" {{ ($purchase->account_id==$account->id)?"selected":"" }}>{{ $account->name }} ({{ $account->getAccountBalance($account->id) }})</option>
                                @endforeach
                            </select>
                            @error('account')
                            <span class="text-danger"></span>
                            @enderror

                        </div>
                        <div class="col-md-4">
                            <label for="">Select Supplier</label>
                            <select name="supplier" id="" class="form-control">
                                <option value="">Select Supplier</option>
                                @foreach ($supplier as $supplier)
                                <option value="{{ $supplier->id }}" {{ ($supplier->id==$purchase->supplier_id)?"selected":"" }}>{{ $supplier->name }} ({{ $supplier->getAccountBalance($supplier->id) }})</option>
                                @endforeach
                            </select>
                            @error('supplier')
                            <span class="text-danger"></span>
                            @enderror

                        </div>
                        <div class="col-md-4">
                            <label for="">Date</label>
                            <input type="date" name="date" value="{{ $purchase->date }}" class="form-control">
                            @error('date')
                            <span class="text-danger"></span>
                            @enderror


                        </div>
                        <div class="col-md-4">
                            <label for="">Total Amount</label>
                            <input type="number" placeholder="Enter Purchase Total Amount" value="{{ $purchase->total_amount }}" name="total_amount" class="form-control">
                            @error('total_amount')
                            <span class="text-danger"></span>
                            @enderror

                        </div>
                        <div class="col-md-4">
                            <label for="">Paid Amount</label>
                            <input type="number" placeholder="Enter Purchase Paid Amount" value="{{ $purchase->paid_amount }}" name="paid_amount" class="form-control">
                            @error('paid_amount')
                            <span class="text-danger"></span>
                            @enderror

                        </div><div class="col-md-4">
                            <label for="">Remaining</label>
                            <input type="number" placeholder="remaining" name="remaining" value="{{ $purchase->remaining }}" class="form-control" readonly>
                            @error('remaining')
                            <span class="text-danger"></span>
                            @enderror

                        </div>
                        <div class="col-12">
                            <label for="">Purchase Note</label>
                            <textarea name="note" class="form-control " id="" cols="12" rows="3" style="width: 100%important;">{{ $purchase->note }}</textarea>
                            
                            @error('note')
                            <span class="text-danger"></span>
                            @enderror

                        </div>
                        
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary float-end">
                        </div>
                        
                    </div>


                </form>
                @endforeach

            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function(){
            $('input[name=total_amount] , input[name=paid_amount]').keyup(function(){
              var total =   $('input[name=total_amount]').val() || 0;
               var paid =  $('input[name=paid_amount]').val() || 0;
               var rem = total - paid;
               $('input[name=remaining]').val(rem);
            });
        });
    </script>
@endsection

@endsection

