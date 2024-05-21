@extends('layouts.master')

@section('content')
<div class="container">
<div class="row">
    <div class="col">
        @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <strong class="card-title mb-0">Variant </strong>
                <a href="{{ url('/variant/create') }}" class="btn btn-primary float-end">Add Variant</a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>SR.NO</th>
                            <th>Name</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($variant as $key => $variant)


                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variant->name }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#{{ $variant->id }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a href="{{ url('variant/'.$variant->id.'/edit') }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#delete/{{ $variant->id }}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i>Delete</a></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{-- delte modal  --}}
                        <div class="modal fade" id="delete/{{ $variant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Do you realy want to delete this variant?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                  <form action="{{ url('/variant/'.$variant->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="" id="" value='DELETE' class="btn btn-danger ">
                                </form></div>
                              </div>
                            </div>
                          </div>
                        {{-- delte modal end --}}

                        <!-- Modal -->
<div class="modal fade" id="{{ $variant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">variant Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <strong>variant Name: </strong>
            <span>{{ $variant->name }}</span>


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
@endsection

