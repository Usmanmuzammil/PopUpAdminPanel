@extends('layouts.master')

@section('content')
<div class="container-fluid">


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

    <div class="row">
        <div class="col-lg-12">
          @if ($message = Session::get('success'))

          <div id="successMessage" class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0" style="z-index: 9999; margin-top: 25px;" role="alert">
              <i class="ri-check-double-line label-icon"></i><strong>{{ $message }}</strong>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Categories</h5>
                    <a href="{{ route('category.create') }}" class="btn btn-primary ">Add Categories</a>

                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">SR No.</th>

                                <th>Category name</th>
                                <th>Action</th>
                                {{-- <th>Delete</th> --}}
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($category as $key => $value)


                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->catagery_name }}</td>

                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ route('category.edit',$value->id) }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>

                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            {{-- delete modal --}}

                            <div class="modal fade" id="delete/{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you realy want to delete?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form action="{{ url('/category/'.$value->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="delete" id="" class="btn btn-danger">
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            {{-- delete modal  end--}}

                            {{-- detail modal --}}
                            <div class="modal fade" id="{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Catagery Name</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>Name: </strong>
                                        <span>{{ $value->catagery_name }}</span>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
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
        </div>
    </div>
    </form>

                    </div>
@endsection
