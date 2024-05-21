@extends('layouts.master')
@section('title')
    Supplier Payments
@endsection
@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Supplier Payments</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Supplier Payments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @if ($message = Session::get('success'))
        <div id="successMessage" class="alert alert-primary text-primary mt-3">
            <p>{{ $message }}</p>
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
                <h4 class="card-title mb-0 flex-grow-1">Add Supplier Payments</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('supplier_payment.index') }}" class="btn btn-primary btn-sm">
                        View Supplier Payments
                    </a>
                </div>
            </div>

                <div class="card-body">
                    <form action="{{ route('supplier_payment.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="live-preview">

                            <div class="row">
                              <div class='col-lg-6 col-md-6'>
                                    <div class="mb-3">
                                        <label for="labelInput" class="form-label">Select Supplier <span class="text-danger">*</span></label>
                                        <select required name="account_id" id="" class="form-control">
                                            <option value="">Select Supplier</option>
                                            @foreach ($accounts as $accounts)
                                                <option value="{{ $accounts->id }}">{{ ucwords($accounts->name) }} ({{($accounts->getAccountBalance($accounts->id)) }})</option>
                                            @endforeach
                                        </select>
                                            <span class="text-danger">
                                            @error('account_id')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>
                                </div>
                       
                               
                                <div class='col-lg-6 col-md-6'>
                                    <div class="mb-3">
                                        <label for="disabledInput" class="form-label">Shop Cash & Bank Account<span class="text-danger">*</span></label>
                                        <select required name="shop_account_id" id="" class="form-control">
                                            <option value="">Select Cash & Bank Account</option>
                                            @foreach ($shop_accounts  as $shop_accounts)
                                                <option value="{{ $shop_accounts->id }}">{{ ucwords($shop_accounts->name) }} ({{($shop_accounts->getAccountBalance($shop_accounts->id)) }})  </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('shop_account_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class='col-lg-6 col-md-6' style="display:none;">
                                    <div class="mb-3">
                                        <label for="disabledInput" class="form-label">Payment Type <span class="text-danger"> * </span></label>
                                        <select required name="payment_type" id="" class="form-control">
                                            <option value="">Select Type </option>
                                            <option selected value="send">Send </option>
                                            <option value="receive">Receive </option>
                                        </select>
                                        <span class="text-danger">
                                            @error('payment_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class='col-lg-6 col-md-6'>
                                    <div class="mb-3">
                                        <label for="disabledInput" class="form-label">Amount <span class="text-danger"> * </span></label>
                                        <input type="text" required value="{{ old('amount') }}" name="amount"
                                            id="" placeholder="0.00" class="form-control">
                                        <span class="text-danger">
                                            @error('amount')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>



                                <div class='col-lg-6 col-md-6'>
                                    <div class="mb-3">
									<label for="exampleInputtime" class="form-label">Date</label>
                                        <input type="date" name="date" id="" value="{{date('Y-m-d')}}"
                                            class="form-control">
                                        <span class="text-danger">
                                            @error('date')
                                                {{ $message }}
                                            @enderror
                                        </span>
									</div>
								</div>

								  <div class='col-lg-12 col-md-12'>
                                    <div class="mb-3">
									<label for="exampleInputtime" class="form-label">Description</label>
                                       
                                            <textarea name="description" id="" class="form-control" cols="30" rows="3"></textarea>
                                        <span class="text-danger">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </span>
									</div>
								</div>
								
                                <div class='col-lg-12 col-md-12'>
                                    <div class="mb-3">
                            <input type="submit" class="btn btn-primary float-end">
                                 </div>
                              </div>
								
							
                         
                            </div>
						</div>
					
						 
                         
                    </form>
                </div>

            </div>
        </div>

    </div>





@endsection
@section('script')
@parent
<script>
$(document).ready(function() {


    $("#acc_type").change(function() {
        var acc_type = $(this).val();
        if(acc_type==""){
            $('#name').html('<option>--Account Name--</option>')
        }else{


    $.ajax({
        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
        type: "POST",
        url: "/transaction/get_account_name",
        data: {acc_type: acc_type},
        success: function(result) {
           $('#name').html(result);
           console.log(result);
          // do something with the result
        }
      });
    }
    });
  });

</script>
@endsection
