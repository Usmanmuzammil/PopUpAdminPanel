@extends('layouts.master')
@section('title','Product')
@section('content')
<style>
    #value {
        min-width: 5px !important;
        padding: 0px !important;
        max-width: 40px !important;
    }
</style>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Products</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
                <h4 class="card-title mb-0 flex-grow-1">Edit Product</h4>
                <div class="flex-shrink-0">
                    <a href="{{ url('product') }}" class="btn btn-primary">
                        View Products
                    </a>
                </div>
            </div>

            @foreach ($product as $product)

            <div class="card-body">
                <form action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('PUT')
                    <div class="live-preview">

                        <div class="row">

                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="labelInput" class="form-label">Select Category <span
                                            class="text-danger">*</span></label>
                                    <select name="category" class="form-control" id="">
                                        <option value="">Select Category</option>
                                        @foreach($category as $category)
                                            <option value="{{ $category->id }}" {{ ($category->id==$product->category_id)?"selected":"" }}>{{ $category->catagery_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('category')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>

                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="labelInput" class="form-label">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="product_name" class="form-control" id="labelInput"
                                        placeholder="Product name" value="{{ $product->product_name }}" required>
                                    <span class="text-danger">
                                        @error('product_name')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>



                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="labelInput" class="form-label">Product Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="product_code" class="form-control" id="labelInput"
                                        placeholder="Product code" value="{{ $product->product_code }}" required>
                                    <span class="text-danger">
                                        @error('product_code')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>


                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="labelInput" class="form-label">Unit<span
                                            class="text-danger">*</span></label>
                                    <select name="unit" id="" class="form-control">
                                        <option value="">select unit</option>
                                        @foreach ($unit as $unit)
                                        <option value="{{ $unit->id }}" {{ ($product->unit_id==$unit->id)?"selected":""
                                            }}>{{ $unit->unit_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('unit')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>



                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="exampleInputtime" class="form-label">Purchase Price</label>
                                    <input type="number" placeholder="Purchase Price" name="purchase_price" id=""
                                        value="{{ $product->purchase_price }}" class="form-control" required>
                                    <span class="text-danger">
                                        @error('purchase_price')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>



                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="exampleInputtime" class="form-label">Selling Price</label>
                                    <input type="number" placeholder="Selling Price" name="selling_price" id=""
                                        value="{{ $product->selling_price }}" class="form-control">
                                    <span class="text-danger">
                                        @error('selling_price')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>





                            <div class='col-lg-4 col-md-4'>
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" name="image" id="image_input" class="">
                                    <span class="text-danger">
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                            <div class='col-12'>
                                <div class="">
                                    <input type="submit" class="btn btn-primary float-end">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row mt-3">


                </form>
            </div>
            @endforeach

        </div>
    </div>

</div>


@endsection