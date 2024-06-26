@extends('layouts.master')

@section('content')
    <div class="card">
        
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Return Sell</h4>
            <a href="{{ url('sell/return-list') }}" class="btn btn-primary float-end">View Returned Sells</a>
        </div>
        <div class="card-body ">
            <p class="italic"><small>The field labels marked with * are required input fields.</small></p>
            <form action="#" method="POST" accept-charset="UTF-8" class="payment-form " enctype="multipart/form-data"><input
                    name="_token" type="hidden" value="JhWpzx0jpnoIqubz8NBT45yMyIvn2cAQ8p6ZYz4o">
                @csrf
                <div class="row px-1">
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="date" id="date" class="form-control date"
                                        placeholder="Choose date">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        Reference No
                                    </label>
                                    <input type="text" name="reference_no" id="reference_no" class="form-control"
                                        value="{{ old('reference_no') }}">
                                    @error('reference_no')
                                        {{ $message }}
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer *</label>
                                    <select name="customer" id="customer" class="form-control">

                                        <option value="" readonly>Select customer</option>
                                        @foreach ($customer as $customer)
                                            <option class='customer' data-type="{{ $customer->account_type }}"
                                                value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('customer')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <label>Warehouse *</label>

                                    <select name="warehouse" id="warehouse" class="form-control warehouse">
                                        <option value="" readonly>select ware house</option>
                                        @foreach ($warehouse as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse')
                                        @error('warehouse')
                                            {{ $message }}
                                        @enderror
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <label>Biller *</label>
                                    <select name="biller" id="biller" class="form-control">
                                        <option value="">select biller</option>
                                        @foreach ($biller as $biller)
                                            <option value="{{ $biller->id }}">{{ $biller->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('biller')
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

                    </div>
                </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <h5>Order Table *</h5>
                <div class="table-responsive mt-3">
                    <table id="myTable" class="table table-hover order-list bg-light">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Net Unit Price</th>
                                <th>Discount</th>
                                <th>Tax(%)</th>
                                <th>SubTotal</th>
                                <th><i class="fa fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody id="sale_product_list">

                        </tbody>
                        <tfoot class="tfoot active">
                            <tr>
                                <th colspan="2">Total</th>
                                <th id="grandQuantity"></th>
                                <th></th>
                                <th id="grandDiscount">0.00</th>
                                <th id="grandTax"></th>
                                <th id="grandTotal">0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-3 px-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Order Tax</label>
                    <input type="number" placeholder="Enter tax" class="form-control" id="orderTax" name="order_tax_rate">

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Order Discount</label>
                    <input type="number" id="orderDiscount" class="form-control">

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>
                        Shipping Cost
                    </label>
                    <input type="number" name="shipping_cost" class="form-control" id="shippingCost" step="any">
                </div>
            </div>



            <div class="container-fluid my-4 bg-light">
                <table class="table table-bordered table-condensed totals">
                    <tbody>
                        <tr>
                            <td><strong>Items:</strong>
                                <span class="pull-right fw-bold float-end" id="finalItemQuantity">00</span>
                            </td>
                            <td><strong>Total:</strong>
                                <span class="pull-right fw-bold float-end" id="finalTotal">00</span>
                            </td>
                            <td><strong>Order Tax:</strong>
                                <span class="pull-right fw-bold float-end" id="finalOrderTax">00.00</span>
                            </td>
                            <td><strong>Order Discount:</strong>
                                <span class="pull-right fw-bold float-end" id="finalDiscount">00.00</span>
                            </td>
                            <td><strong>Shipping Cost:</strong>
                                <span class="pull-right fw-bold float-end" id="finalShipingCost">0</span>
                            </td>
                            <td><strong>Grand Total:</strong>
                                <span class="pull-right fw-bold float-end" id="finalGrandTotal"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 ">
                <div class="form-group">
                    <label>Paying Amount *</label>
                    <input type="number" name="paid_amount" class="form-control" id="paying-amount" step="any"
                        value="{{ old('paid_amount') }}"  >
                    @error('paid_amount')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="col-md-2 mt-1">
                <div class="form-group">
                    <label>Change</label>
                    <p id="change" class="ml-2">0.00</p>
                </div>
            </div>
            <div class="col-md-3 mt-1">
                <div class="form-group">
                    <label>Remaining</label>
                    <p id="remaing" class="ml-2">0.00</p>
                </div>
            </div>
        </div>

        <div class="row mt-2 px-3">

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label>Sale Description</label>
                    <textarea rows="5" class="form-control" name="staff_note" id="desc"></textarea>
                    {{-- <input type="hidden" name="hidden" value='1'> --}}
                </div>
            </div>
        </div>
        <div class="form-group p-3">
            <input type="button" value="Submit" class="btn btn-primary mt-2 px-3" id="submit_button">

        </div>


        </form>
    </div>


    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script>
        var bill = [];

        function product() {
            var i_q = document.getElementsByClassName('item_quantity');
            var i_price = document.getElementsByClassName('item_price');
            var i_id = document.getElementsByClassName('item_id');
            var i_tax = document.getElementsByClassName('tax');
            var i_subtotal = document.getElementsByClassName('item_subtotal');
            var i_discount = document.getElementsByClassName('item_discount');

            for (var i = 0; i < i_q.length; i++) {
                bill[i] = {
                    // 'item_id':item_id[$i].value,
                    'item_id': i_id[i].value,
                    'item_quantity': i_q[i].value,
                    'item_price': i_price[i].innerText,
                    'item_tax': i_tax[i].innerText,
                    'item_subtotal': i_subtotal[i].innerText,
                    'item_discount': i_discount[i].innerText,

                }

            }

        }
    </script>
    <script>
        $(document).ready(function() {

            $('#product_list').hide();
            // $('#biller')
            $('#lims_productcodeSearch').on('keyup', function() {
                var product_name = "";

                var customer_id = $('#customer').val();
                var warehouse = $(".warehouse").val();
                var biller_id = $('#biller').val();
                if (customer_id == "" || warehouse == "" || biller_id == "") {
                    alert('please select warehouse,customer and biller');
                } else {
                    product_name = $(this).val();
                }
                if (product_name == "") {
                    $('product_list').hide();
                    $('product_list').html("");
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
                    url: "/sell/product_detail/" + product_id,
                    type: 'GET',
                    data: {
                        count: count
                    },
                    // data:{product_id:product_id}

                    success: function(response) {

                        $('#sale_product_list').append(response.product)

                        subtotal();
                        calculation();
                        product();
                    }


                });
            });

            function subtotal() {

                $('tbody tr').each(function() {
                    var total = 0;
                    var item_price = 0;
                    var item_quantity = 0;
                    item_price = parseInt($(this).find('.item_price').html());
                    item_quantity = $(this).find('.item_quantity').val();
                    var tax = parseInt($(this).find('.tax').html());

                    var beforeTax = item_price * item_quantity;
                    var per = tax / 100 * beforeTax;
                    total = (beforeTax + per);

                    if (total == 'NaN') {
                        total = 0;
                    }
                    $(this).find('.total').html(total);

                });
            }



            $(document).on('keyup', '.item_quantity', function() {
                subtotal();
                calculation();
                product();
            });

            function calculation() {
                var grandTotal = 0;
                var grandTax = 0;
                var grandQuantity = 0;
                var totalItem = $('#sale_product_list tr').length;

                $('tbody tr').each(function() {
                    grandTotal += +$(this).find('.total').text();
                    grandTax += +$(this).find('.tax').text();
                    $(this).find('.item_quantity').each(function() {
                        grandQuantity += +$(this).val();
                    });

                });
                $('#grandTotal').html(parseInt(grandTotal));
                $('#grandTax').text(grandTax);
                $('#grandQuantity').text(grandQuantity);
                $('#finalTotal').text(grandTotal);
                $('#finalItemQuantity').text(totalItem + "(" + grandQuantity + ")");
                finalGrandTotal();

                    var total=$('#finalGrandTotal').text();
                    $('#remaing').text(total);
            }
            // order tax
            $('#orderTax').keyup(function() {
                var orderTax = $(this).val();
                if (orderTax == "") {
                    orderTax = 0;
                }
                $('#finalOrderTax').text(orderTax);
                finalGrandTotal();
            });
            // discont calcultate
            $('#orderDiscount').keyup(function() {
                var orderDiscount = $(this).val();
                if (orderDiscount == "") {
                    orderDiscount = 0;
                }
                $('#finalDiscount').text(orderDiscount);
                finalGrandTotal();
            });
            // final shipping cost
            $('#shippingCost').keyup(function() {
                $('#finalShipingCost').text($(this).val());

                finalGrandTotal();
            });

            function finalGrandTotal() {
                var finalTotal = $('#finalTotal').text();
                var finalOrderTax = $('#finalOrderTax').text();
                var finalOrderDiscount = $('#finalDiscount').text();
                var finalShippingCost = $('#finalShipingCost').text();
                grandTotal = +finalTotal + +finalOrderTax + +finalShippingCost - +finalOrderDiscount;

                $('#finalGrandTotal').text(grandTotal);
            }
            // remove ammount
            $(document).on("click", "#remove_item", function() {
                $(this).closest("tr").remove();
                calculation();
                product();
            });

            //paying ammount

            $('#paying-amount').keyup(function() {
                calculation();
                $('#change').text('0');
                var payingamount = parseInt($('#paying-amount').val());
                var grandTotal = parseInt($('#finalGrandTotal').text());
                if (payingamount >= +grandTotal) {
                    calculation();
                    $('#change').text(+payingamount - +grandTotal);
                    $('#remaing').text('0');
                }
                if(!isNaN(payingamount) && payingamount<grandTotal){
                let remain=$('#remaing').text();
                remain=remain - +payingamount;
                $('#remaing').text(remain);
                }
            });
            // remaiining


            // form submit
            $('#submit_button').on('click', function() {
                $(this).attr('disabled',true);
                $(this).html('<span class="spinner-border text-dark" role="status" aria-hidden="true"></span>'); 
                        
                var ac_type = $('#customer').find(':selected').attr('data-type');

                var total_item = $('#sale_product_list tr').length;
                var date = $('#date').val();
                var reference_no = $('#reference_no').val();
                var account_id = $('#customer').val();
                var warehouse_id = $('.warehouse').val();
                var biller_id = $('#biller').val();
                var item_quantity = $('#grandQuantity').text();
                var orderTax = $('#finalOrderTax').text();
                var orderDiscount = $('#finalDiscount').text();
                var shippingCost = $('#finalShipingCost').text();
                var finalGrandTotal = $('#finalGrandTotal').text();
                var paying_ammount = $('#paying-amount').val();
                var change = $('#change').text();
                var orderDesc = $('#desc').val();
                var remaining = $('#remaing').text();
                var bill_detail = {
                    'date': date,
                    'reference_no': reference_no,
                    'account_id': account_id,
                    'warehouse_id': warehouse_id,
                    'user_id': biller_id,
                    'item_quantity': item_quantity,
                    'ordertax': orderTax,
                    'orderdiscount': orderDiscount,
                    'shippingCost': shippingCost,
                    'finalGrandTotal': finalGrandTotal,
                    'paying_ammount': paying_ammount,
                    'change': change,
                    'orderdescription': orderDesc,
                    'remaining': remaining,
                    'total_item':total_item

                }
                if (total_item == 0) {
                    alert('please select item first');
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/sell/return') }}",
                        type: 'post',
                        data: {

                            bill: bill,
                            bill_detail: bill_detail
                        },
                        success: function(data) {
                            console.log(data);
                            if(data.status=='200'){ 
                          window.location="{{ url('/sell/return-list') }}";
                            }else if(data.status=='0'){
                                Swal.fire({
                             icon: 'error',
                             title: 'Oops...',
                            text: data.message,
                            })
                            }else{
                                Swal.fire({
                             icon: 'error',
                             title: 'Oops...',
                            text: "some thing went wrong..plese try again latter",
                            })
                            }
                            $('#submit_button').attr('disabled',false);
                          $('#submit_button').html('Submit'); 
                 
                        }

                    });
                }
            });

        });
    </script>
@endsection
