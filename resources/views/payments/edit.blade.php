@extends('layouts.master')
@section('title','update transaction')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Transactions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Transaction</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('transaction.index') }}" class="btn btn-primary btn-sm">
                            View transactions
                        </a>
                    </div>
                </div><!-- end card header -->


                <div class="card-body">
                    @foreach ($payment as $payment)
                        
                    <form action="{{ route('payment.update',$payment->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="">From account<span class="text-danger">*</span></label>
                                <select name="from_account" class="form-control" required="" id="from_account">
                                  <option value="" >Select From Account</option>
                                    @foreach ($from_account as $account)
                                        <option value="{{ $account->id }}" {{ ($account->id==$payment->from_account)?"selected":"" }}>{{ $account->name }}</option>
                                    @endforeach
                                    
                                </select>
                                @error('from_account')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleFormControlSelect1">To account *<span
                                        class="text-danger">*</span></label>
                                <select name="to_account" id="to_account" class="form-control">
                                  <option value="">Select to account</option>
                                  @foreach ($to_account as $to_account)
                                        <option value="{{ $to_account->id }}" {{ ($to_account->id==$payment->to_account)?"selected":"" }}>{{ $to_account->name }}</option>
                                    @endforeach
                                    
                                </select>
                                @error('to_account')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Account Number">Amount<span class="text-danger">*</span></label>
                                <input type="text" name="amount" value="{{ $payment->amount }}" class="form-control" id=""
                                    placeholder="Enter amount">
                                    @error('amount')
                                      
                                    <span class="text-danger">
                                      {{ $message }}
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Date*</label>
                                <input type="date" name="date" value="{{ $payment->date }}" id="" class="form-control"
                                    placeholder="">
                                    @error('date')
                                      
                                    <span class="text-danger">
                                      {{ $message }}
                                    </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="">Description<span class="text-danger">*</span></label>
                                <input type="text" name="desc"  value="{{ $payment->desc }}" id=""
                                    class="form-control" placeholder="Desc">
                                    @error('desc')
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

            // $('select[name="from_account"]').change(function(){
            //     var account_type=$(this).val();
            //     if(account_type!=""){

            //         $.ajax({
            //             url:"{{ url('/transaction/accounts/get-account') }}/"+account_type,
            //             type:"GET",
            //             success:function(data){
            //                 $('select[name="to_account"]').html(data.result);
            //             },
            //         });
            //     }else{
            //         $('select[name="to_account"]').html('<option>Select to accounts</option>');
            //     }
            // });
            
            
        });
        </script>
        @endsection
@endsection
