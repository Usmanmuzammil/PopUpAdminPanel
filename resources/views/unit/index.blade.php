@extends('layouts.master')
@section('title','Product Units')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product Units</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Units</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
{{ View::make("components.productbuttons") }}

    <!-- end page title -->
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <strong class="card-title mb-0">Product Units </strong>
                <a href="{{ url('/unit/create') }}" class="btn btn-primary float-end">Add Unit</a>
            </div>
            <div class="card-body">
                <table  id="own-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($unit as $key => $unit)


                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->unit_name }}</td>
                            <td>{{ $unit->code }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        {{-- <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#{{ $unit->id }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li> --}}
                                        <li><a href="{{ url('unit/'.$unit->id.'/edit') }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        {{-- <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-{{ $unit->id }}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i> &nbsp; Delete</a></li> --}}

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{-- delete modal --}}
                        <div class="modal fade" id="delete-{{ $unit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Product Unit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                  Do you really want to delete this unit?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <form action="{{ url('/unit/'.$unit->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="" id="" value='Delete' class="btn btn-danger">
                                </form></div>
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
@endsection

