@extends('layouts.master')

@section('content')
<div class="row">
    <form action="">
        <input type="hidden" name="_token" type="hidden" value="JhWpzx0jpnoIqubz8NBT45yMyIvn2cAQ8p6ZYz4o">
         @csrf
    </form>
    <div class="col p-2">'
        <a href="{{ url('/sell/return') }}" class="btn btn-primary my-2 float-end">Add Return Sells</a>
        <table id="datatable" class="table-striped table bordered">
            <thead>
              <tr>
                <th scope="col">Sr</th>
                <th scope="col">Date</th>
                <th scope="col">Reference</th>
                <th scope="col">Biller</th>
                <th scope="col">Customer</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Grand Total</th>
                <th scope="col">Returned Ammount</th>
                <th scope="col">Paid</th>
                <th scope="col">Due</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($bill as $key => $bill)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $bill['date'] }}</td>
                    <td>{{ $bill['reference_no'] }}</td>
                    <td>{{ $bill->getBiller->name ? $bill->getBiller->name :"Not Found" }}</td>
                    <td>{{ $bill->getCustomer->name }}</td>
                    <td><span class="badge bg-warning text-dark">{{ ($bill['bill_status']==1)?'paid':'unpiad' }}</span></td>
                    <td>{{ $bill['total'] }}</td>
                    <td>{{ $bill['returned_ammount'] }}</td>
                    <td>{{ ($bill['paid_ammount'])?$bill['paid_ammount']:'0' }}</td>
                    <td>{{ $bill['remaining'] }}</td>
                    <td ><div class="dropdown d-inline-block" >
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="{{ url('/sell/gen_invoice/'.$bill->id.'') }}"  class="dropdown-item"><i class="fa fa-copy text-primary"></i> Genrate invoice</a></li>
                            <li><a class="dropdown-item" id="sale_btn" data-id="{{ $bill->id }}"  href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sale-detail{{ $bill->id }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> view</a></li>
                            <li><a class="dropdown-item " href="{{ url('/sell/return/edit/'.$bill->id.'') }}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>

                            <li><a class="dropdown-item " data-toggle="modal" data-target="#delete/12" href="{{ url('/sale/delete/'.$bill->id.'') }}"><i class="ri-delete-bin-line"></i> Delete</a></li>

                        </ul>
                    </div></td>
                </tr>

                {{-- sale detail modal --}}
                <div class="modal fade " id="sale-detail{{ $bill->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                            <button onclick="printDiv();" class="btn btn-outline-primary">Print</button>
                            <button class="btn btn-outline-primary mx-2">Email</button>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Return Sell Detail</h5>
                            <hr>

                        <div class="row px-3" >
                            <center>
                            <div style="display: none" class="spinner-border text-primary sale-modal-loading" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                            </center>
                        <div class="sale_detail_table"></div>
                        </div>
                    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                {{-- sale detail modal end --}}
                @endforeach

            </tbody>

        </table>
    </div>
    </div>
</form>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function printDiv(){
    var body=document.body.innerHTML;
    var printDiv=document.getElementById('bill_detail_print').innerHTML;
    document.body.innerHTML=printDiv;
    window.print();
    document.body.innerHTML=body;

}
    $(document).ready(function(){
        // $('#sale_detail_table').html("");
        $('.sale-modal-loading').show();
        $(document).on('click','#sale_btn',function(){
        var bill_id=$(this).attr('data-id');
        if(bill_id!=""){
                $.ajax({
                    url:"{{ url('/sale/bill_detail') }}",
                    data:{bill_id:bill_id},
                    success:function(data){
                        console.log(data);
                        // $('#sale_detail_table').html("");
                        $('.sale_detail_table').html(data);
                        $('.sale-modal-loading').hide();
                    }
                });
            }
        });
    });
</script>

