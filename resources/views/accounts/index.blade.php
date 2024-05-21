@extends('layouts.master')
@section('title','Cash Accounts')
@section('content')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cash Accounts</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Cash Accounts</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
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
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Cash Accounts</h4>
                    <a href="{{ url('/account/create') }}" class="btn btn-primary">Create Cash Account</a>
                </div><!-- end card header -->
                <div class="card-body">
				  <table  id="own-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">

				  <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Account No</th>
                                <th>Op Balance</th>
                                <th>Balance</th>
                                <th>Default</th>
                                <th>Action</th>
                            </tr>
                        </thead>

						@if($account)
                        @foreach ($account as $key => $account)
                        <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->account_no }}</td>
                                <td>{{ $account->opening_balance }}</td>
                                <td>
                                    {{ $account->getAccountBalance($account->id) }}
                                </td>

                            <td>
                                <div class="form-check form-switch form-switch-md text-center" dir="ltr">
                                    <input type="checkbox" class="form-check-input account-switch" id="customSwitchsizemd{{ $account->id }}" {{ $account->status == "default" ? 'checked' : '' }} data-account-id="{{ $account->id }}" data-default="{{ $account->status }}">
                                </div>
                            </td>


                                <td><div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="{{ route('account.edit',$account->id) }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-{{$account->id}}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i> &nbsp; Delete</a></li>

                                    </ul>
                                </div>
								</td>

                            </tr>

                              <div id="delete-{{$account->id}}" class="modal fade" tabindex="-1" aria-labelledby="delete-{{$account->id}}Label" aria-hidden="true" style="display: none;">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="delete-{{$account->id}}Label">Delete Account</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <h5 class="fs-15">
                                                  Are You Sure You Want to Delete This Account?

                                              </h5>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                              <form action="{{ route('account.destroy',$account->id) }}" method="POST">
                                                  @csrf
                                                  @method("DELETE")
                                                  <input type="submit" name="" id="" class="btn btn-danger">
                                              </form>
                                          </div>

                                      </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                              </div><!-- /.modal -->


                          @endforeach
						@endif
                    </table>

                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection
@section('script')
    @parent
    <script>
        // Add event listener to each switch input
        $('.account-switch').on('change', function() {
            const accountId = $(this).data('accountId');

            // Uncheck all other switches
            $('.account-switch').not(this).prop('checked', false);

            // Make an AJAX request to update the account status
            $.ajax({
                url: 'update_account_status/' + accountId,
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Replace with the actual CSRF token
                },
                data: JSON.stringify({ accountId: accountId }),
                success: function(response) {
                    console.log('Account status updated successfully!', response);
                    alert('Account status updated successfully!');
                }
            });
        });
    </script>


@endsection
