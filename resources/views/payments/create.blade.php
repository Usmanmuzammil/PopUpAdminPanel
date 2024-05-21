@extends('layouts.master')
@section('title','Payments')
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
                    <h4 class="card-title mb-0 flex-grow-1">Add Payments</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('payment.index') }}" class="btn btn-primary btn-sm">
                            View Payments
                        </a>
                    </div>
                </div><!-- end card header -->


                <div class="card-body">
                    <form action="{{ route('payment.store') }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="">From account<span class="text-danger">*</span></label>
                                <select name="from_account" class="form-control" required="" id="from_account">
                                  <option value="">Select From Account</option>
                                    @foreach ($from_account as $from_account)

                                        @if($from_account=="shop-account")
                                        <option value="{{ $from_account->id }}">{{ $from_account->name }} ({{ $from_account->getSellBill->sum('paid_amount') + $from_account->getAccountCreditPayment->sum('amount') +  $from_account->getShopCredit->sum('amount') + $from_account->opening_balance - $from_account->getShopDebit->sum('amount') - $from_account->getPurchaseBill->sum('paid_amount') - $from_account->getShopExpense->sum('amount') - $from_account->getAccountDebitPayment->sum('amount') }})</option>

                                        @else
                                  <option value="{{ $from_account->id }}">{{ $from_account->name   }} ({{ $from_account->getSellBill->sum('net_amount') + $from_account->getAccountCreditPayment->sum('amount')  + $from_account->opening_balance - $from_account->getSellBill->sum('paid_amount') - $from_account->getAccountDebitPayment->sum('amount') }})  </option>

                                        @endif

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
                                  @foreach ($to_account as $account)
                                  @if($account->account_type=='shop-account')

                                  <option value="{{ $account->id }}">{{ $account->name   }} ({{$account->getSellBill->sum('paid_amount') + $account->getAccountCreditPayment->sum('amount') +  $account->getShopCredit->sum('amount') + $account->opening_balance - $account->getShopDebit->sum('amount') - $account->getPurchaseBill->sum('paid_amount') - $account->getShopExpense->sum('amount') - $account->getAccountDebitPayment->sum('amount') }})  </option>
                                  @else
                                  <option value="{{ $account->id }}">{{ $account->name   }} ({{ $account->getSellBill->sum('net_amount') + $account->getAccountCreditPayment->sum('amount')  + $account->opening_balance - $account->getSellBill->sum('paid_amount') -  + $account->getAccountDebitPayment->sum('amount') }})  </option>

                                  @endif
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
                                <input type="text" name="amount" value="{{ old('amount') }}" class="form-control" id=""
                                    placeholder="Enter amount">
                                    @error('amount')

                                    <span class="text-danger">
                                      {{ $message }}
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Date*</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" id="" class="form-control"
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
                                <input type="text" name="desc"  value="{{ old('des') }}" id=""
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
