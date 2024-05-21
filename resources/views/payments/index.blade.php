@extends('layouts.master')
@section('title','transactions')
@section('content')

@if ($message = Session::get('success'))

<div id="successMessage" class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0" style="z-index: 9999; margin-top: 25px;" role="alert">
    <i class="ri-check-double-line label-icon"></i><strong>{{ session('message') }}</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <p class="card-title">Payment</p>
        <a href="{{ url('/transaction/create') }}" class="btn btn-primary ">+Add Payment</a>
      </div>

      <div class="card-body">
        <table class="table" id="datatable">
          <thead class="thead-dark">
            <tr>
              <th scope="col">SR</th>
              <th scope="col">Date</th>
              <th scope="col">From Account</th>
              <th scope="col">To Account</th>
              <th scope="col">Amount</th>
              <th scope="col">description</th>
              <th scope="col">More</th>
            </tr>
          </thead>
          <tbody>

              @foreach ($payment as $key => $payment)
              <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $payment->date }}</td>
              <td>{{ $payment->getPaymentDebitAccountName->name }} ({{ $payment->getPaymentDebitAccountName->account_type }})</td>
              <td>{{ $payment->getPaymentCreditAccountName->name }}</td>
              <td>{{ $payment->amount }}</td>
              <td>{{ $payment->desc }}</td>
              <td>
                <div class="dropdown d-inline-block">
                  <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-fill align-middle"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item "
                              href="{{ route('payment.edit',$payment->id) }}"><i
                                  class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                              Edit</a></li>

                      <li><a class="dropdown-item " data-toggle="modal"
                              data-target="#delete/{{ $payment->id }}"
                              href=""><i

                                  class="ri-delete-bin-line"></i> Delete</a></li>

                  </ul>
              </div>
              </td>
          </tr>
          <div class="modal fade" id="delete/{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do your realy want to delete this payment?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <form action="{{ route('payment.destroy',$payment->id) }}" id="form" method="post">
                    @csrf
                    @method('DELETE')
                    {{-- <input type="submit" value="DELETE"> --}}
                    <input  type="submit" value="delete" class="btn btn-danger ">
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

