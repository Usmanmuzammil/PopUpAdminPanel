@extends('layouts.master')

@section('content')
    <div class="card">

        <div class="card-header d-flex align-items-center">
            <h4>Update Sell</h4>

        </div>
        <div class="card-body ">
            <p class="italic"><small>The field labels marked with * are required input fields.</small></p>
            @foreach ($bill as $bill)
            <form action="javascript:void(0)" method="POST" accept-charset="UTF-8" class="payment-form " enctype="multipart/form-data"><input
                    name="_token" type="hidden" value="JhWpzx0jpnoIqubz8NBT45yMyIvn2cAQ8p6ZYz4o">
                @csrf
                <div class="row px-1">
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">


                                    <input type="hidden" value="{{ $bill->id }}" id="bill_detail">
                                    <label>Date</label>
                                    <input type="hidden" value="{{ $bill->id }}" id="bill_id">
                                    <input type="date" name="date" value="{{ $bill->date }}"
                                        id="date" class="form-control date" placeholder="Choose date">
                                    <span id="customer-error" style="display: none;" class="text-danher"></span>
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Shop Account</label>
                                    <select name="pay_account_id" id="pay_account_id" class="form-control">
                                        @foreach ($shop_acc as $account)
                                            <option value="{{ $account->id }}" {{ ($account->id==$bill->pay_account_id)?"selected":"" }}>{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="pay-account-error" style="display: none;" class="text-danher"></span>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="account_id" id="account_id" class="form-control">
                                        @foreach ($customer as $customer)
                                            <option value="{{ $customer->id }}" {{ ($customer->id==$bill->account_id)?"selected":"" }}>{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="customer-error" style="display: none;" class="text-danher"></span>
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Select Product</label>
                                <div class="search-box input-group">

                                    <button type="button" class="btn btn-secondary btn-lg p-0 px-4"><i
                                            class="fa fa-barcode"></i></button>
                                    <input type="text" name="product_code_name" id="lims_productcodeSearch"
                                        placeholder="Please type product code and select..."
                                        class="form-control  ui-autocomplete-input" autocomplete="off">

                                </div>
                                @error('product_code_name')
                                    {{ $message }}
                                @enderror
                                <div class="bg-primary p-3" id="product_list" style="display: none;">

                                </div>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h5 class="mt-3">Order Table *</h5>
                                <div class="table-responsive mt-3">
                                    <table id="myTable" class="table table-hover order-list bg-light">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>discount</th>
                                                <th>SubTotal</th>
                                                <th><i class="fa fa-trash"></i>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sale_product_list">
                                            {{-- {{ $bill_detail }} --}}
                                            @foreach ($bill->getBillDetail as $bill_d)
                                                <tr>
                                                    <td>{{ $bill_d->getproduct->product_name }}
                                                        <input type="hidden"
                                                            value="{{ $bill_d->product_id }}" class="item_id"
                                                            name="product_id[]"></td>

                                                    <td style="width:130px;"><input type="number"
                                                            class="item_price form-control"
                                                             value="{{ $bill_d->price }}">
                                                        <span class="price-error text-danger" style="display:none;"></span>

                                                    </td>


                                                    <td style="width:130px;"><input type="number"
                                                            class="item_qty form-control" value="{{ $bill_d->qty }}">
                                                        <span class="qty-error text-danger"
                                                            style="display:none;"></span>
                                                    </td>
                                                    <td style="width:130px;"><input type="number"
                                                        class="item_disc form-control" value="{{ $bill_d->discount }}">
                                                    <span class="qty-error text-danger"
                                                        style="display:none;"></span>
                                                </td>
                                                    <td class=" fw-bold" ><span class="sub_total">{{ $bill_d->net_total }}</span>
                                                    </td>
                                                    <td><a href="javascript:void(0)" class="remove_item"><i
                                                                class="ri-delete-bin-line"></i></a></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot class="tfoot active">
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th id="grandTotal">{{ $bill->total }}</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h5>Pervious Total</h5>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                    <label class="form-group">Perivous Total</label>
                                    <input type="text" class="form-control" readonly value="{{$bill->total}}" />
                            </div>
                            <div class="col-md-3">
                                    <label class="form-group">Perivous Discount</label>
                                    <input type="text" class="form-control" readonly value="{{$bill->discount}}" />
                            </div>
                            <div class="col-md-3">
                                    <label class="form-group">Perivous Net Total</label>
                                    <input type="text" class="form-control" readonly value="{{$bill->net_total}}" />
                            </div>
                            <div class="col-md-3">
                                    <label class="form-group">Pervious Paid Amount</label>
                                    <input type="text" class="form-control" readonly id="perivous_paid" value="{{$bill->paid_amount}}" />
                            </div>
                        </div>

                        <hr>



                        <div class="row mt-5">
                            <div class="col-md-3 text-center">
                                    <label class="form-group fs-16 text-center">Total Amount</label>
                                     <h4 id="nTotal" class="text-center">{{$bill->total}}</h4>
                            </div>
                            <div class="col-md-3">
                                    <label class="form-group">Discount</label>
                                    <input type="text" id="discount" class="form-control"  value="{{$bill->discount}}" />
                            </div>
                           <div class="col-md-3 text-center">
                                    <label class="form-group fs-16 text-center">Net Total</label>
                                     <h4 id="net_total" class="text-center">{{$bill->net_total}}</h4>
                            </div>
                            <div class="col-md-3" style="display: ;">
                                    <label class="form-group">Amount To Pay</label>
                                    <input type="text" class="form-control" id="amt_to_pay" readonly value="{{ $bill->remaining }}" />
                            </div>
                        </div>

                        <hr>








                        <div class="row px-4 mt-4">

                           <div class="col-md-3 ">
                                <div class="form-group">
                                    <label>Pay Amount *</label>
                                    <input type="number" name="paid_amount" class="form-control" id="paid_amount"
                                        step="any"
                                        value="">
                                    @error('paid_amount')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-2 mt-1 d-none">
                                <div class="form-group">
                                    <label>Return</label>
                                    <p id="change" class="ml-2">{{ $bill->change }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 mt-1" style="">
                                <div class="form-group">
                                    <label>Remaining</label>
                                    <br>
                                    <h3 id="remaining" class="ml-2">{{ $bill->remaining }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 px-3">

                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label>Sale Description</label>
                                    <textarea rows="3" class="form-control" name="staff_note" id="desc">{{ $bill->desc }}</textarea>
                                    {{-- <input type="hidden" name="hidden" value='1'> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-3">

                            <button type="submit" value="Submit" class="btn btn-primary mt-2 px-3" id="submit_button">Submit</button>
                        </div>

                        @endforeach
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>

        <script>
            //         var bill = [];

            //         function product() {


            //         }

                var submitForm=true;
            $(document).ready(function() {
                        subtotal();
            //                         subtotal();
            //                         calculation();
            //                         product();
            //                         finalGrandTotal();
            //             $('#product_list').hide();
            //             // $('#biller')

            // alert("this");


            $('#discount').on('keyup', function() {
     var disc=0;
     var gt=0;
     var total=0;
     dis = $(this).val();

	act = dis.endsWith("%");
        gt =$('#grandTotal').text() ;
	    prv_paid =$('#perivous_paid').val() ;

	if(act==true){
	res=dis.split("%");
	abc=res[0];

	disp=(gt/100*abc);
    net_total=gt-disp;
	$("#net_total").text(net_total.toFixed(2));

	$("#amt_to_pay").val(net_total);



}else{
    net_total=gt-dis;
$("#net_total").text(net_total.toFixed(2));
 	$("#amt_to_pay").val(net_total);


}



//subtotal();
cal();

  });


            $(document).on('click','.remove_item',function(){
                $(this).closest('tr').remove();
                subtotal();
                cal();

            });
            $(document).on('keyup','.item_qty ,.item_price  , .item_disc',function(){

                $('tbody tr').each(function(){

                    var price=$(this).closest('tr').find('.item_price').val();
                   var qty= $(this).closest('tr').find('.item_qty').val();
                   var disc= $(this).closest('tr').find('.item_disc').val();

                   var total=price*qty;
                //    alert(total);
                   $(this).closest('tr').find('.sub_total').text((total - disc).toFixed(2));
                });
                subtotal();
                cal();
            });
            $('#lims_productcodeSearch').on('keyup', function() {
                var product_name = "";

                var date = $('#date').val();


                if (date == "") {
                    $('#date-error').show().text('Date is required');

                } else
                if (date == "") {
                    $('#date-error').show().text('Date is required');


                } else {
                    product_name = $(this).val();
                    $('#date-error').hide().text('');
                    $('#customer-error').hide().text('');

                }
                if (product_name == "") {

                    $('#product_list').hide();
                    $('#product_list').html("");
                } else {


                    $.ajax({
                        url: "{{ url('/sell/get-product') }}",
                        type: 'GET',
                        data: {
                            product_name: product_name
                        },
                        beforeSend: function() {
                            $('#product_list').hide();
                        },
                        success: function(data) {
                            if (data != "") {


                                $('#product_list').show();
                                $('#product_list').html(data);
                            } else {

                                $('#product_list').hide();
                            }
                        }

                    });
                }
            });

            $(document).on('click', '.product', function() {

                $('#lims_productcodeSearch').val("");
                var num = 1;
                var count = 0;
                count = $('tbody tr').length;

                var product_id = $(this).data('id');
                $('#product_list').hide();
                $.ajax({
                    url: "{{ url('/sell/product_detail') }}/" + product_id,
                    type: 'GET',
                    data: {
                        count: count
                    },
                    // data:{product_id:product_id}

                    success: function(response) {

                        $('#sale_product_list').append(response.product)

                subtotal();
                cal();

                    }


                });
            });
            var bill_detail=[];
            function dataIntoArray(){


            $('tbody tr').each(function(i,v){
                var id=$(this).closest('tr').find('.item_id').val();
                var price=$(this).closest('tr').find('.item_price').val();
                   var qty= $(this).closest('tr').find('.item_qty').val();
                   var sub_total= $(this).closest('tr').find('.sub_total').text();
                   var disc= $(this).closest('tr').find('.item_disc').val();


           bill_detail[i]={
'item_id':id,
'item_qty':qty,
'item_price':price,
'net_total':sub_total,
'item_discount':disc,
}
});

}




                        function subtotal() {
                            // alert("wotk");
                            var subtotal=0;
                            $('tbody tr').each(function() {

                                subtotal += + $(this).closest('tr').find('.sub_total').text();
                              if (subtotal == 'NaN') {
                                subtotal = 0;
                                }


                            });
                            $('#grandTotal').text(subtotal);
                            $('#nTotal').html(subtotal);

                            discount = $('#discount').val();


                            nettotal = (subtotal-discount);

                            $('#net_total').text(nettotal);
                            prv_paid = $('#perivous_paid').val();
                            $('#amt_to_pay').val(nettotal - prv_paid);




                        }



                        $('#paid_amount').on('keyup',function(){
        var paying=parseInt($('#paid_amount').val()) || 0;
        var total=parseInt($('#grandTotal').text()) || 0;
       var prv_paid= $('#perivous_paid').val() || 0;
       var amt_to_pay= $('#amt_to_pay').val() || 0;

       if(paying>amt_to_pay){
        Swal.fire('pay equal or less then amount to pay')
        $('#submit_button').attr('disabled',true);
    }else{
           $('#submit_button').attr('disabled',false);



        if(paying<total){
            var rem = total- +paying;
            $("#remaining").text(rem - prv_paid);
            $('#change').text('0');

        }
        if(paying >= +total){
            var change= paying - total;
            $("#change").text(change );

            $('#remaining').text('0');

        }


cal();
    }
    });

    function cal(){

    }
            //             $(document).on('keyup', '.item_quantity', function() {
            //                 subtotal();
            //                 calculation();
            //                 product();
            //             });

            //             function calculation() {
            //                 var grandTotal = 0;
            //                 var grandTax = 0;
            //                 var grandQuantity = 0;
            //                 var totalItem = $('#sale_product_list tr').length;

            //                 $('tbody tr').each(function() {
            //                     grandTotal += +$(this).find('.total').text();
            //                     grandTax += +$(this).find('.tax').text();
            //                     $(this).find('.item_quantity').each(function() {
            //                         grandQuantity += +$(this).val();
            //                     });

            //                 });
            //                 $('#grandTotal').html(parseInt(grandTotal));
            //                 $('#grandTax').text(grandTax);
            //                 $('#grandQuantity').text(grandQuantity);
            //                 $('#finalTotal').text(grandTotal);
            //                 $('#finalItemQuantity').text(totalItem + "(" + grandQuantity + ")");
            //                 finalGrandTotal();

            //                     var total=$('#finalGrandTotal').text()-$('#paying-amount').val();

            //                     $('#remaing').text(total);
            //             }
            //             // order tax
            //             $('#orderTax').keyup(function() {
            //                 var orderTax = $(this).val();
            //                 if (orderTax == "") {
            //                     orderTax = 0;
            //                 }
            //                 $('#finalOrderTax').text(orderTax);
            //                 finalGrandTotal();
            //             });
            //             // discont calcultate
            //             $('#orderDiscount').keyup(function() {
            //                 var orderDiscount = $(this).val();
            //                 if (orderDiscount == "") {
            //                     orderDiscount = 0;
            //                 }
            //                 $('#finalDiscount').text(orderDiscount);
            //                 finalGrandTotal();
            //             });
            //             // final shipping cost
            //             $('#shippingCost').keyup(function() {
            //                 $('#finalShipingCost').text($(this).val());

            //                 finalGrandTotal();
            //             });

            //             function finalGrandTotal() {
            //                 var finalTotal = $('#finalTotal').text();
            //                 var finalOrderTax = $('#finalOrderTax').text();
            //                 var finalOrderDiscount = $('#finalDiscount').text();
            //                 var finalShippingCost = $('#finalShipingCost').text();
            //                 grandTotal = +finalTotal + +finalOrderTax + +finalShippingCost - +finalOrderDiscount;

            //                 $('#finalGrandTotal').text(grandTotal);
            //             }
            //             // remove ammount
            //             $(document).on("click", "#remove_item", function() {
            //                 $(this).closest("tr").remove();
            //                 product();
            //                 calculation();

            //             });

            //             //paying ammount
            //             // pay();
            //             $('#paying-amount').keyup(function() {
            //                 calculation();
            //                 $('#change').text('0');
            //                 var payingamount = parseInt($('#paying-amount').val());
            //                 var grandTotal = parseInt($('#finalGrandTotal').text());
            //                 if (payingamount >= +grandTotal) {
            //                     calculation();
            //                     $('#change').text(+payingamount - +grandTotal);
            //                     $('#remaing').text('0');
            //                 }
            //                 if(!isNaN(payingamount) && payingamount<grandTotal){
            //                 let remain=$('#remaing').text();
            //                 remain=grandTotal - +payingamount;
            //                 $('#remaing').text(remain);
            //                 }
            //             });
            //             // remaiining
            //         $('tbody tr').each(function() {

            //             $(document).on('keyup', '.item_quantity', function() {

            //         var qty = $(this).val();
            //         if (qty == "0" || qty == "" || isNaN(qty)) {

            //             $(this).closest('td').find('.qty_error').show().html('Quantity must be greater than 0*');
            //             $('#submit_button').attr('disabled', true);
            //         } else {
            //             $('.qty_error').show().text('');
            //             $('#submit_button').attr('disabled', false);

            //         }
            //         });
            //     });

            //         $('tbody tr').each(function() {
            //   // code goes here


            // $(document).on('keyup', '.item_price', function() {

            //     var price = $(this).val();
            //     if (price == "0" || price == "" || isNaN(price)) {
            //         $(this).closest('td').find('.price_error').show().text('Price must be greater than 0*');
            //         $('#submit_button').attr('disabled', true);

            //     } else {
            //         $('.price_error').show().text('');
            //         $('#submit_button').attr('disabled', false);

            //     }
            // });

            // form submit
            $('#submit_button').on('click', function() {
                // alert('ok');
                dataIntoArray();
var id=$('#bill_id').val();
var date=$('#date').val();
var pay_account_id=$('#pay_account_id').val();
var account_id=$('#account_id').val();
// var customer=$('#customer').val();
var grand_total=$('#grandTotal').text();
var discount=$('#discount').val();
var net_total=$('#net_total').text();
var change=$('#change').text();
var rem=$('#remaining').text();
var paid=$('#paid_amount').val();
var desc=$('#desc').val();
var amt_to_pay=$('#amt_to_pay').val();
var perivous_paid=$('#perivous_paid').val();




bill={
        'bill_id':id,
        'date':date,
        'account_id':account_id,
        'pay_account_id':pay_account_id,
        'grand_total':grand_total,
        'discount':discount,
        'net_total':net_total,
        'change':change,
        'rem':rem,
        'paid':paid,
        'desc':desc,
        'amt_to_pay':amt_to_pay,
        'perivous_paid':perivous_paid
}


                var total_item = $('#sale_product_list tr').length;

                tpaid = (+perivous_paid+ +paid)

                if(total_item<=0){
                    Swal.fire('Please select one item at-least');
                }else{


                    $(this).attr('disabled',true);
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');



                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ url('/sell/update') }}',
                        type: 'post',
                        data: {

                            bill: bill,
                            bill_detail: bill_detail
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == '200') {
                                window.location = "{{ url('/view_sale_list') }}";
                                $('#submit_button').attr('disabled', true);

                            } else if (data.status == '0') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message,
                                })
                                $('#submit_button').attr('disabled', false);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "some thing went wrong..plese try again latter",
                                })
                            }
                            $('#submit_button').attr('disabled', false);
                            $('#submit_button').html('Submit');

                        }

                    });
                }
            });
            });
        </script>
    @endsection
