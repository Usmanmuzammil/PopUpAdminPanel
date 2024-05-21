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
                <h4 class="card-title mb-0 flex-grow-1">Update Supplier Payment</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('supplier_payment.index') }}" class="btn btn-primary btn-sm">
                        View Supplier Payments
                    </a>
                </div>
            </div>

                <div class="card-body">
                    <form action="{{ route('supplier_payment.update',$payment_data->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="live-preview">

                            <div class="row">
                                <div class='col-lg-6 col-md-6'>
                                      <div class="mb-3">
                                          <label for="labelInput" class="form-label">Select Account <span class="text-danger">*</span></label>
                                          <select required name="account_id" id="" class="form-control">
                                              <option value="">Select Account </option>
                                              @foreach ($accounts as $accounts)
                                              <option {{ $payment_data->account_id == $accounts->id ? 'selected':'' }}  value="{{$accounts->id }}">{{ ucwords($accounts->name) }} </option>
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
                                          <label for="disabledInput" class="form-label">Shop Account<span class="text-danger">*</span></label>
                                          <select required name="shop_account_id" id="" class="form-control">
                                              <option value="">Select Shop Account</option>
                                              @foreach ($shop_accounts  as $accounts)
                                              <option {{ $payment_data->shop_account_id == $accounts->id ? 'selected':'' }}  value="{{$accounts->id }}">{{ ucwords($accounts->name) }} </option>
                                             @endforeach
                                          </select>
                                          <span class="text-danger">
                                              @error('shop_account_id')
                                                  {{ $message }}
                                              @enderror
                                          </span>
                                      </div>
                                  </div>
  
                                
  
                                  <div class='col-lg-6 col-md-6'>
                                      <div class="mb-3">
                                          <label for="disabledInput" class="form-label">Amount <span class="text-danger"> * </span></label>
                                          <input type="text" required value="{{ $payment_data->amount }}" name="amount"
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
                                          <input type="date" name="date" id="" value="{{ $payment_data->date }}"
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

                                            <textarea name="description" id="" class="form-control" cols="30" rows="3">{{ $payment_data->description }}</textarea>

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
