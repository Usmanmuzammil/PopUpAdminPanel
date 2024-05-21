@extends('order-booker-pannel.layouts.master')
@section('content')
<div class="page-content mt-3 p-b50">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab"
            tabindex="0">
            <div class="container">
                @if ($message = Session::get('message'))
                <div id="dangerMessage"
                    class="alert alert-{{ Session::get('type') }} alert-dismissible alert-solid alert-label-icon fade show position-fixed top-0 end-0"
                    style="z-index: 9999; margin-top: 25px;" role="alert">
                    <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                @endif

                <div class="row" id="today">
                    @if(count($bills)==0)
                    <div class="col alert text-white alert-info">No Order Added Yet</div>
                    @endif
                    <div class="col-12 text-center">

                        <div class="spinner-border text-danger text-center" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>


                </div>
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
