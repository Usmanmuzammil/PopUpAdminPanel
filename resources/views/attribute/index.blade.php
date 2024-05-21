@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Attribute</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Attribute</li>
                </ol>
            </div>
        </div>
    </div>
</div>
{{ View::make("components.productbuttons") }}

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
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Attribute</h4>
                <a href="" data-bs-toggle="modal" data-bs-target="#add-attr" class="btn btn-primary">Add Attribute</a>
            </div>
            <div class="card-body">


                <table id="own-table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">

                    <thead>
                        <tr>
                            <th>SR</th>
                            <th>Attribute Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attr as $key => $attr)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $attr->name }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#edit-{{$attr->id}}"
                                                class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        </li>
                                        {{-- <li><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{$attr->id}}"
                                                class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i>
                                                &nbsp; Delete</a></li> --}}

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-{{ $attr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Attribute</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('attribute.update',$attr->id) }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <div class="modal-body">
                                            <div>
                                                <label for="">Attribute Name</label>
                                                <input type="text" value="{{ $attr->name }}" name="attribute_name" placeholder="Enter Attribute Name"
                                                    class="form-control" id="">
                                            </div>
                                             <div class="my-2">
                                <label for="">Allow As Multi Select Attribute</label>
                                <br>
                                <label for="half-in-half">Yes</label><input class="mx-2" {{ ($attr->status==1)?"checked":"" }} type="radio" name="status" value="1">
                                <label for="half-in-half">No</label><input  class="mx-2" {{ ($attr->status==0)?"checked":"" }} type="radio" name="status" value="0">
                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
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

        {{-- add new attribute --}}
        <!-- Modal -->
        <div class="modal fade" id="add-attr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Attribute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('attribute.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div>
                                <label for="">Attribute Name</label>
                                <input type="text" name="attribute_name" placeholder="Enter Attribute Name"
                                    class="form-control" id="">
                            </div>
                            <div class="my-2">
                                <label for="">Allow As Multi Select Attribute</label>
                                <br>
                                <label for="half-in-half">Yes</label><input class="mx-2"  type="radio" name="status" value="1">
                                <label for="half-in-half">No</label><input  class="mx-2" checked type="radio" name="status" value="1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
