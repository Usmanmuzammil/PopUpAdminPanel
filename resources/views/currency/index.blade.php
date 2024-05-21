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
                <strong class="card-title mb-0">Currency </strong>
                <a href="{{ url('/currency/create') }}" class="btn btn-primary float-end">Add Currency</a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>SR.NO</th>
                            <th>Currency</th>
                            <th>Currency Code</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($currency as $key => $currency)


                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $currency->currency_name }}</td>
                            <td>{{ $currency->currency_code  }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#{{ $currency->id }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a href="{{ url('currency/'.$currency->id.'/edit') }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#delete/{{ $currency->id }}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i> Delete</a></li>

                                    </ul>
                                </div>
                            </td>

                        </tr>

                        {{-- delete confirmation modal --}}
                        <div class="modal fade" id="delete/{{ $currency->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Delete Currency</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Do you realy want to delete?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <form action="{{ url('/currency/'.$currency->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="" id="" value='DELETE' class="btn btn-danger" data-dismiss="modal">
                                </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        {{-- delete confirmation modal end --}}

                        <!--detail  Modal -->
<div class="modal fade" id="{{ $currency->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">currency Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <strong>Currency Name: </strong>
            <span>{{ $currency->currency_name }}</span>
            <br>
            <br>
            <strong>Currency Code: </strong>
            <span>{{ $currency->currency_code }}</span>


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

