@extends('layouts.master')
@section('title','Booker Payment')
@section('content')



<div class="row">
  <div class="col-md-12">



    <div class="card">
        @if ($message = Session::get('success'))

        <div id="successMessage" class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0 w-0" style="z-index: 9999; margin-top: 50px;" role="alert">
            <i class="ri-check-double-line label-icon"></i><strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($message = Session::get('error'))

        <div id="successMessage" class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0 w-100" style="z-index: 9999; margin-top: 25px;" role="alert">
            <i class="ri-check-double-line label-icon"></i><strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      <div class="card-header d-flex justify-content-between">
        <p class="card-title">Payment</p>
        <a href="{{ route('orderbookers.payment.create') }}" class="btn btn-primary ">Add Payment</a>
      </div>

      <div class="card-body">
        <table class="table" id="ajax_bill_list">
          <thead class="thead-dark">
            <tr>
              <th scope="col">SR</th>
              <th scope="col">Date</th>
              <th scope="col">Order Booker</th>
              <th scope="col">Amount</th>
              <th scope="col">More</th>

            </tr>
          </thead>
          <tbody id="">

          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@section('script')
<script>

    $(document).ready(function() {

            $('#ajax_bill_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('orderbookers.payment.get') }}',
                    dataSrc: function (json) {
                        console.log(json);
                    },

                     pageLength: 25, // Show 25 entries by default

                columns: [
                    { data: 'id'},
                    { data: 'date'},
                    { data: 'get_booker.name'},
                    { data: 'amount'},
                    { data: 'actions', orderable: false, searchable: false }
                ],

            });
        });
</script>
@endsection
@endsection

