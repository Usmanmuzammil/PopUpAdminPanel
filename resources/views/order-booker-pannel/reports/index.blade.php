@extends('order-booker-pannel.layouts.master')
@section('content')
<style>
         /* Style for date input container */
         .date-input-container {
            display: flex;
            flex-direction: column;
        }

        /* Style for date input label */
        .date-input-label {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        /* Style for date input field */
        .date-input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
        }

        /* Style for mobile view (adjust as needed) */
        @media (max-width: 768px) {
            .date-input-container {
                margin: 2px 0;
            }
        }
        input[type="date"]::-webkit-datetime-edit-fields-wrapper::after {
            content: "OK";
            display: block;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
        }

</style>
<div class="page-content space-top p-b50">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab" tabindex="0">
            <div class="container">
                @if ($message = Session::get('message'))
<div id="dangerMessage"
    class="alert alert-{{ Session::get('type') }} alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
    style="z-index: 9999; margin-top: 25px;" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form class="" action="{{ route('order-booker.order.get.report') }}" method="post">
    @csrf
    <div class="date-input-container">
        <label for="from-date" class="date-input-label">Date:</label>
        <input type="date" name="date" id="from-date" class="form-control date">
    </div>
{{--
    <div class="date-input-container">
        <label for="to-date" class="date-input-label">To Date:</label>
        <input type="date" name="to_date"  class="form-control date" id="mydate" name="to_date">
    </div>  --}}

    <input type="submit" class="btn btn-primary btn-sm rounded-0 my-md-2 float-end">
</form>


            </div>
        </div>

    </div>
</div>
@push('script')


<script>


    $(document).ready(function(){

})

</script>
@endpush

@endsection