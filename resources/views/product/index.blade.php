
@extends('layouts.master')
@section('title',"Products")
@section('content')

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
{{ View::make("components.productbuttons") }}



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
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Products</h5>
                    <a href="{{ url('/product/create') }}" class="btn btn-primary float-end">Add Product</a>
                </div>
                <div class="card-body">
                    <table id="product-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>S-Price</th>
                                <th>P-Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
@section('script')
    @parent
    <script>

        $(document).ready(function() {
            // $('#product-table').DataTable().destroy();
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get.product.list') }}',
                dataSrc: function (json) {
                    console.log(json);
                },

                pageLength: 25, // Show 25 entries by default

                columns: [
                    { data: 'id'},
                    {data : 'catagery_name'},
                    { data: 'product_name'},
                    { data: 'product_code'},
                    { data: 'purchase_price'},
                    { data: 'selling_price'},
                    { data: 'actions', orderable: false, searchable: false }
                ],

            });
            });


    </script>
@endsection
