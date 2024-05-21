@extends('layouts.master')
@section('content')

<style>
    /* Custom color theme */
    .custom-tabs .nav-link {
        background-color: #212529;
        color: #fff;
        border: 1px solid transparent;
    }

    .custom-tabs .nav-link.active {
        border-bottom: none;
    }

    .custom-tabs .nav-link:hover {
        border: 1px solid #ccc;
        border-bottom: none;
    }

    .custom-tabs .nav-link:last-child {
        border-right: none;
    }

    .db-list-item-title {
        white-space: nowrap;
        text-align: left;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 600;
        text-transform: capitalize;
        --tw-text-opacity: 1;
        color: rgb(31 31 57 / var(--tw-text-opacity));
    }

    .db-list-item-text {
        text-align: left;
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    tr td {
        padding: 10px;
    }

    .variation-table td {
        padding: 15px
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Products Detail</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products Detail</li>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->

                    <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-success mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fs-18" data-bs-toggle="tab" href="#nav-border-justified-info"
                                role="tab" aria-selected="false">
                                <i class=" ri-information-line align-middle me-1"></i> Infromation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-18" data-bs-toggle="tab" href="#nav-border-justified-variant"
                                role="tab" aria-selected="false">
                                <i class=" ri-tornado-line me-1 align-middle"></i> Variation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-18" data-bs-toggle="tab" href="#nav-border-justified-extra" role="tab"
                                aria-selected="false">
                                <i class=" bx bx-customize  align-middle me-1"></i>Extra
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-18" data-bs-toggle="tab" href="#nav-border-justified-addon" role="tab"
                                aria-selected="false">
                                <i class=" bx bx-add-to-queue align-middle me-1"></i>Addon
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="nav-border-justified-info" role="tabpanel">
                            <div class="row">
                                @foreach ($product as $val)
                                <div class="col-6 d-flex justify-content-center">
                                    <table class="w-100 center">
                                        <tbody class="gy-5">

                                            <tr class="my-5">
                                                <td>
                                                    <span class="db-list-item-title w-full sm:w-1/2">Name</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="db-list-item-text w-full fs-18">{{
                                                        $val->product_name
                                                        }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="db-list-item-title w-full sm:w-1/2">Category</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="db-list-item-text w-full fs-18">{{
                                                        $val->getCategory->catagery_name
                                                        }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="db-list-item-title w-full sm:w-1/2">Product Code</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="db-list-item-text w-full fs-18">{{
                                                        $val->product_code
                                                        }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="db-list-item-title w-full sm:w-1/2">Price</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="db-list-item-text w-full fs-18">{{
                                                        $val->selling_price
                                                        }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="db-list-item-title w-full sm:w-1/2">Description</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="db-list-item-text w-full fs-18">{{
                                                        $val->desc
                                                        }}</span></td>
                                            </tr>
                                        </tbody>


                                    </table>

                                </div>
                                <div class="col-6 d-flex justify-content-center">

                                    <div>
                                        <img width="100px" src="{{ asset('img/'.$val->product_image) }}" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="tab-pane" id="nav-border-justified-variant" role="tabpanel">
                            <div class="row">
                                <div class="">

                                    <button data-bs-toggle="modal" data-bs-target="#add-variation"
                                        class="btn btn-primary ">Add
                                        New Variant</button>


                                    @foreach ($attributesWithVariants as $attributeName  => $variants)


                                    <div class="card border my-3 px-2">
                                        <div class="card-header">

                                            <div class="my-2">
                                                <h3>
                                                    -{{ Str::ucfirst($attributeName)  }}
                                                </h3>
                                            </div>
                                        </div>


                                        <table class="table table-striped table-hover  variation-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50%;">NAME</th>
                                                    <th>PRICE</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($variants as $variant)
                                                <tr>
                                                    <td>
                                                        {{ $variant->name }}
                                                    </td>
                                                    <td>
                                                        {{ $variant->price }}
                                                    </td>
                                                    <td>

                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#edit-variation{{ $variant->id }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="ri-pencil-fill"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $variant->id }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </td>

                                                </tr>


                                                {{-- variation edit start --}}
                                                <div class="modal fade" id="edit-variation{{ $variant->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Update
                                                                    Variations</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('item-variantion.update',$variant->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row gy-3">
                                                                        <div class="col-6">

                                                                            <label for="">Name</label>
                                                                            <input type="text" name="name"
                                                                                value="{{ $variant->name }}"
                                                                                placeholder="Enter Variant Name"
                                                                                class="form-control">
                                                                            <input type="hidden" name="item_id"
                                                                                value="{{ Route::current()->parameter('id') }}">
                                                                        </div>
                                                                        <div class="col-6">


                                                                            <label for="">Additional Price</label>
                                                                            <input type="number" name="price"
                                                                                value="{{ $variant->price }}"
                                                                                placeholder="Enter Variant Price"
                                                                                class="form-control">

                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="">Attribute</label>
                                                                            <select name="attribute_id" id=""
                                                                                class="form-control">
                                                                                <option value="">Select Attribute
                                                                                </option>
                                                                                @foreach ($attr as $val)
                                                                                <option {{ ($val->
                                                                                    id==$variant->attribute_id)?"selected":""
                                                                                    }} value="{{ $val->id }}">{{
                                                                                    $val->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="12">
                                                                            <label for="">Description</label>
                                                                            <textarea class="form-control"
                                                                                name="description" id="" cols="0"
                                                                                rows="10">
                                                                            {{ $variant->description }}
                                                                </textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- variation edit end --}}


                                                {{-- delete variant start --}}
                                                <div class="modal fade" id="delete{{ $variant->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                    Attribute</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('item-variantion.destroy',$variant->id) }}"
                                                                method="post">
                                                                @method("DELETE")
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <h4>Do you want to delete this variant?</h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- delete variant end --}}

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    @endforeach



                                </div>

                            </div>


                        </div><!-- end card-body -->
                        <div class="tab-pane" id="nav-border-justified-extra" role="tabpanel">
                            <div class="row">
                                <div class="col my-2">
                                    <button data-bs-toggle="modal" data-bs-target="#add-extra"
                                        class="btn btn-primary ">Add Extra</button>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NAME</th>
                                                    <th>PRICE</th>
                                                    <th>ACTION</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($extra as $value)
                                                <tr>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->price }}</td>
                                                    <td>

                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#edit-extra{{ $value->id }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="ri-pencil-fill"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#delete-extra{{ $value->id }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </td>

                                                </tr>

                                                {{-- edit extra --}}
                                                <div class="modal fade" id="edit-extra{{ $value->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Update
                                                                    Extras</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('item-extras.update',$value->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method("PUT")
                                                                <div class="modal-body">
                                                                    <div class="row gy-3">
                                                                        <div class="col-6">

                                                                            <label for="">Name</label>
                                                                            <input type="text" name="name"
                                                                                value="{{ $value->name }}"
                                                                                placeholder="Enter Extra Name"
                                                                                class="form-control">
                                                                            <input type="hidden"  name="item_id"
                                                                                value="{{ Route::current()->parameter('id') }}">
                                                                        </div>
                                                                        <div class="col-6">


                                                                            <label for="">Price</label>
                                                                            <input type="number"
                                                                                value="{{ $value->price }}" name="price"
                                                                                placeholder="Enter Extra Price"
                                                                                class="form-control">

                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- delete extra --}}

                                                <div class="modal fade" id="delete-extra{{ $value->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">DELETE
                                                                    Extras</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('item-extras.destroy',$value->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method("DELETE")

                                                                <div class="modal-body">
                                                                    <h4>Do you want to delete this extra?</h4>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">YES</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane" id="nav-border-justified-addon" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">

                                            <button data-bs-toggle="modal" data-bs-target="#add-addon"
                                                class="btn btn-primary">
                                                Add New Addon
                                            </button>

                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SR</th>
                                                        <th>NAME</th>
                                                        <th>PRICE</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item_addon as $key => $item_addon)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ $item_addon->name }}</td>
                                                                <td>{{ $item_addon->price }}</td>
                                                                <td>

                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#edit-addon{{ $item_addon->id }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="ri-pencil-fill"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#delete-addon{{ $item_addon->id }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </td>

                                                            </tr>
                                                             {{-- edit extra --}}
                                                <div class="modal fade" id="edit-addon{{ $item_addon->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Update
                                                                    Addons</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('item-addons.update',$item_addon->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method("PUT")
                                                                <div class="modal-body">
                                                                    <div class="row gy-3">
                                                                        <div class="col-12">

                                                                            <label for="">Select Addon</label>
                                                                            <select name="addon_id" class="form-control" id="">
                                                                                <option value="">Select Addon</option>
                                                                                @foreach ($addon as $val)
                                                                                <option {{ ($val->id==$item_addon->id)?"selected":"" }} value="{{ $val->id }}">{{ $val->name }}</option>
                                                                                @endforeach

                                                                            </select>

                                                                            <input type="hidden" name="item_id"
                                                                                value="{{ Route::current()->parameter('id') }}">
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- delete extra --}}

                                                <div class="modal fade" id="delete-addon{{ $item_addon->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">DELETE
                                                                    Addon</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('item-addons.destroy',$item_addon->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method("DELETE")

                                                                <div class="modal-body">
                                                                    <h4>Do you want to delete this addon?</h4>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">YES</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- add variation --}}

                    <div class="modal fade" id="add-variation" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Variations</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('item-variantion.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row gy-3">
                                            <div class="col-6">

                                                <label for="">Name</label>
                                                <input type="text" name="name" placeholder="Enter Variant Name"
                                                    class="form-control">
                                                <input type="hidden" name="item_id"
                                                    value="{{ Route::current()->parameter('id') }}">
                                            </div>
                                            <div class="col-6">


                                                <label for="">Additional Price</label>
                                                <input type="number" name="price" placeholder="Enter Variant Price"
                                                    class="form-control">

                                            </div>

                                            <div class="col-6">


                                                <label for="">Attribute</label>
                                                <select name="attribute_id" id="" class="form-control">
                                                    <option value="">Select Attribute</option>
                                                    @foreach ($attr as $attr)
                                                    <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="12">
                                                <label for="">Description</label>
                                                <textarea class="form-control" name="description" id="" cols="30"
                                                    rows="10">

                        </textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- add end --}}



                    {{-- add addon --}}

                    <div class="modal fade" id="add-addon" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Addons</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('item-addons.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row gy-3">
                                            <div class="col-12">

                                                <label for="">Select Addon</label>
                                                <select name="addon_id" class="form-control" id="">
                                                    <option value="">Select Addon</option>
                                                    @foreach ($addon as $val)
                                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                    @endforeach

                                                </select>

                                                <input type="hidden" name="item_id"
                                                    value="{{ Route::current()->parameter('id') }}">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- add extras end --}}

                    {{-- add extras --}}

                    <div class="modal fade" id="add-extra" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Extras</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('item-extras.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row gy-3">
                                            <div class="col-6">

                                                <label for="">Name</label>
                                                <input type="text" name="name" placeholder="Enter Extra Name"
                                                    class="form-control">
                                                <input type="hidden" name="item_id"
                                                    value="{{ Route::current()->parameter('id') }}">
                                            </div>
                                            <div class="col-6">


                                                <label for="">Additional Price</label>
                                                <input type="number" name="price" placeholder="Enter Extra Price"
                                                    class="form-control">

                                            </div>


                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- add extras end --}}

                </div>

            </div>
        </div>





        @endsection
