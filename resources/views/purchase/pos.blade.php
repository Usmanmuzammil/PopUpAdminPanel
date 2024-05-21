<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    {{-- <link rel="shortcut icon" href="{{ asset('assets/') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- aos css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/aos/aos.css') }}" />

    <!-- Layout config Js -->

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- new bootstrap --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- csrf --}}
    {{-- datable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    {{-- sweet alerts --}}
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
        .payment-options {
            background-color: #fff;
            bottom: 0;
            left: 0;
            padding: 0 10px;
            position: fixed;
            width: 100%;
            z-index: 999;

        }
        .card:hover{
         cursor: pointer;
         border-color:#7c5cc4!important;
        }
        /* .pagination-btn.active {
    background-color: gray;
    color: #fff;
} */

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid" style="">
        <div class="row">
            {{-- right side --}}
            
            <div class="col-7 bg-white">
	
			   		   <div class="row my-2 mt-4">
                    <div class="col-md-4">
                        
                        <select name="pay_account_id" id="pay_account_id" class="form-control">
                            @foreach ($shop_acc as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select name="account_id" id="account_id" class="form-control"> 
                            <option value="0" selected>Walk-in-customer</option>
                            @foreach ($customer as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">

                        <input type="date" class="form-control" value='{{date('Y-m-d')}}' id="date" required>
                    </div>
                        
                </div>
				{{--
                <div class="row mt-4">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group d-flex">
						
						
						<select name="" id="biller" class="form-control mx-2" required>
                                <option value="" disabled selected>--Select Biller--</option>


                                @foreach ($biller as $biller)
                                <option value="{{$biller->id}}">{{ Str::ucfirst($biller->name)}}</option>
                                @endforeach
						</select>
						
						
						
                        
						
                            <select style="display:none;" name="" value=""  id="customer" class="form-control mx-2" required>
                                <option value="" >--Select Customer--</option>
								<option value="1">1</option>
                                @foreach ($customer as $customer)
                                <option value="{{ $customer->id }}">{{ Str::ucfirst($customer->name) }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
				--}}
			   
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control mt-4 p-3" id="search_item" placeholder=" Scan or Search item" >
                        <div id="search_result" class="bg-primary" style="display: none!important;">
                            
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col bg-white" style="height:40vh;overflow-y: auto;">
                        <div class="form-group">
                            <div class="table-responsive transaction-list mCustomScrollbar _mCS_2">
                                <div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside"
                                    style="max-height: none;" tabindex="0">
                                    <div id="mCSB_2_container" class="mCSB_container"
                                        style="position: relative; top: 0px; left: 0px;" dir="ltr">
                                        <table id="myTable"
                                            class="table table-hover table-striped order-list table-fixed ui-keyboard-input ui-widget-content ui-corner-all"
                                            aria-haspopup="true" role="textbox">
                                            <thead>
                                                <tr class=''>
                                                    <th class="col-sm-1">#</th>
                                                    <th class="col-sm-3">Product</th>
                                                    <th class="col-sm-2">Price</th>
                                                    <th class="col-sm-2">Quantity</th>
                                                    <th class="col-sm-1">Discount</th>
                                                    <th class="col-sm-2">SubTotal</th>
													 <th class="col-sm-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                
                {{-- <div class="row">
                    <div class="col-sm-4 ">
                        Item:<span class="totals-title" id="item"></span>(<span id="itemqty">0</span>)
                    </div>
                    <div class="col-sm-4">
                        <span class="totals-title">Total:</span><span id="subtotal">0.00</span>
                    </div>
                </div> --}}
                
                <div class="row">
                    <div class="col">
                        <div class="payment-amount text-center bg-info py-2">
                            <h3 class="text-white">Grand Total <strong id="grand_total" class="net_total">00</strong></h3>
                            
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <input type="text" name=""  id="discount" class="form-control" placeholder="Enter Discount">
                    </div>
                    <div class="col-sm-5">
                        <div class="rounded payment-amount bg-danger ">

                        <h4 class="text-white mx-2  py-2">Net Total :<span id="net_total"></span></h4>
                    </div>
                    </div>
                    <div class="col-sm-3">
                        <button style="background: #00cec9" type="button" class="btn px-5 btn-custom payment-btn  btn-block text-white"
                     id="cash_btn" data-toggle="modal" data-target="#add-payment"><i class="fa fa-money"></i>
                    Cash</button>
                    
                    </div>
                </div>
                
            </div>

            {{-- Right side --}}
            <div class="col-5" style="max-height:90vh;overflow: auto;">
                <header class="bg-white p-3">
                    <div class="d-flex justify-content-between">
                        <a id="toggle-btn" href="{{ url('/') }}" class="menu-btn btn btn-outline-primary"><i
                                class="fa fa-bars"> </i></a>
                        <a class="dropdown-item w-25" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle " data-key="t-logout"></span>
                            {{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </header>
               
                <div class="row mt-3 bg-white">
                    <div class="card-group mt-2"></div>
                    
                    <hr>
                    <div class="pagination bg-white d-flex justify-content-end my-2"></div>
                </div>
            </div>
            <div id="slideer" style="position: absolute;height: 100vh;width: 0vw;right: 0;bottom: 10px;display: none;" ></div>
        </div>

        {{-- sale finalize modal --}}
        <div class="modal fade  bd-example-modal-lg" id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Finalize Sale</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                        <label for="paying_amount">Paying Amount</label>
                        <input type="number" name="paying_amount" id="paying_amount" placeholder="Enter paying amount" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label for="totalamount">Total Amount</label>
                        <input type="number" name="totalamount" id="modal_total" placeholder="Total Amount" class="form-control" readonly required>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-3">
                        <label for="change" >Change</label>
                        <p name='change' class="ml-2" id="change">0.0</p>
                    </div>
                    <div class="col-3">
                        <label for="remaining" >Remaining</label>
                        <p name='remaining' class="ml-2" id="remaining">0.0</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <label for="sale_desc"></label>
                        <textarea name="sale_desc" id="sale_desc" class="form-control" rows="5" placeholder="Sale Description"></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="finalize_sale">Submit</button>
                </div>
              </div>
            </div>
          </div>
        {{-- sale finalize modal end --}}
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


$(document).ready(function(){
   var submitForm=true;
    var items=[];
    var selected_item=[];
	var row_num = 1;

    // 
    loadProducts(1);

    $(document).on('click', '.pagination-btn', function() {
    var page = $(this).data('page');
    
    // Remove "active" class from all buttons
    $('.pagination-btn').removeClass('active');
    
    // Add "active" class to clicked button
    $(this).addClass('active');
    
    loadProducts(page);
});




        function loadProducts(page) {
    $.ajax({
        url: '{{ url("sell/products?page=") }}' + page,
        dataType: 'json',
        success: function(response) {
            var products = response.products;
            var html = '';

            $.each(products, function(index, product) {
                var img = '';

                if (product.product_image != '') {
                    img = product.product_image;
                } else {
                    img = 'no_image.jpg';
                }

                html += '<div class="col-lg-3 col-md-3 product m-0 ">';
                html += '<div class="card border">';
                html += '<input type="hidden" class="id" value="' + product.id + '">';
                html += '<input type="hidden" class="name" value="' + product.product_name + '">';
                html += '<input type="hidden" class="price" value="' + product.selling_price + '">';
                html += '<div class="card-body">';
                html += '<img src="{{ URL::to('/') }}/img/' + img + '" width="100%" height="100px">';
                html += '</div>';
                html += '<div class="text-center text-info product_name">';
                html += '<h6>' + product.product_name + '</h6>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            });

            $('.card-group').html(html);

            // Display pagination buttons
            var totalPages = response.total_pages;
            var paginationHtml = '<hr>';

            for (var i = 1; i <= totalPages; i++) {
                var active="";
                if(page==i){
                    active="active btn btn-danger";

                }else{
                    active="btn btn-secondary";

                }
                paginationHtml += '<button class="pagination-btn mx-1 '+active+'"  data-page="' + i + '">' + i + '</button>';
            }
            // paginationHtml += '</div>'

            $('.pagination').html(paginationHtml);
        }
    });
}

    // 
    $('#discount').on('keyup', function() {
     var disc=0;
     var gt=0;
     var total=0;
     dis = $(this).val();
	act = dis.endsWith("%");
        gt =$('#grand_total').text() ;
	
	if(act==true){
	res=dis.split("%");
	abc=res[0];
	
	disp=(gt/100*abc);
    net_total=gt-disp;
	$("#net_total").text(net_total.toFixed(2));	
 $('#modal_total').val(net_total.toFixed(2));
    
    modal();
    
    
}else{	
    net_total=gt-dis;
$("#net_total").text(net_total.toFixed(2));	
 $('#modal_total').val(net_total.toFixed(2));
modal();
    
    
}
	

    //    disc =$(this).val();
    //    gt =$('#grand_total').text() ;
    //    total =  +gt - +disc;
    // $('#net_total').text(total.toFixed(2));
    // $('#modal_total').val(total.toFixed(2));

    
  });


// dis = $("#discount").val();
// 	act = dis.endsWith("%");

	
// if(act==true){
// res=dis.split("%");
// abc=res[0];
// disp=(tot/100*abc);

// totpr=Math.round(tot-disp);
// $("#nettotal").html(totpr);	
// }else{	
// totpr=Math.round(tot-dis);
// $("#nettotal").html(tot-dis);	
// }
// paid =	$("#pamt").val();
// nettot = $("#nettotal").html();
// $("#ramt").html(nettot-paid);
// }
// 



$(document).on('click','.card',function(){
    var id=$(this).find('.id').val();
    var product_name=$(this).find('.name').val();
    var price=$(this).find('.price').val();
    
    console.log(selected_item);
    if(jQuery.inArray(id,selected_item)!== -1){
        $('tbody tr').each(function(){
            var row_id = $(this).find('.product_id').val();
            if(row_id == id) {
                var qty= $(this).closest('tr').find('.product_qty').val();
                $(this).closest('tr').find('.product_qty').val(++qty);
                rowNum();
                subTotal();
                return false; // break out of loop once the matching row is found
            }
        });
    } else {
        $('#table').append(
            "<tr class=''><th class='px-0 sr'></th>\
            <input type='text' value='"+id+"' class='product_id'>\
            <th overflow:hidden;' class='w-auto'>"+product_name+"</td>\
            <td ><input type='number' class='product_price form-control' value="+price+"></td>\
            <td class='d-flex px-0'><span class='btn btn-danger minus'>-</span><input type='number' class='product_qty form-control w-50' min='1' value='1'><span class='btn btn-success plus'>+</span></td>\
            <td class='w-auto'><input type='number' class='product_disc form-control ' value='0'></td>\
            <th class='sub_total'></th>\
            <td ><a href='#' data-id="+id+" class='remove_btn btn btn-danger'>X</td>\
            </tr>"
        );
        rowNum();
        subTotal();
        selected_item.push(id);
    }
});







    $(document).on('click','.search_product',function(){
        $('#search_item').val('');
        var id=$(this).attr('data-id');
        var name=$(this).attr('data-name');
        var price=$(this).attr('data-price');
        var len=items.length;
        if(jQuery.inArray(id,selected_item)!== -1){
        $('tbody tr').each(function(){
            var row_id = $(this).find('.product_id').val();
            if(row_id == id) {
                var qty= $(this).closest('tr').find('.product_qty').val();
                $(this).closest('tr').find('.product_qty').val(++qty);
                rowNum();
                subTotal();
                return false; // break out of loop once the matching row is found
            }
        });
    }else{

        
        $('#table').append(
            "<tr class=''><th class='px-0 sr'></th>\
            <input type='text' value='"+id+"' class='product_id'>\
            <th overflow:hidden;' class='w-auto'>"+name+"</td>\
            <td ><input type='number' class='product_price form-control' value="+price+"></td>\
            <td class='d-flex px-0'><span class='btn btn-danger minus'>-</span><input type='number' class='product_qty form-control w-50' min='1' value='1'><span class='btn btn-success plus'>+</span></td>\
            <td class='w-auto'><input type='number' class='product_disc form-control ' value='0'></td>\
            <th class='sub_total'></th>\
            <td ><a href='#' data-id="+id+" class='remove_btn btn btn-danger'>X</td>\
            </tr>"
                );
                rowNum();
                subTotal();
        selected_item.push(id);
    }        
        $('#search_result').hide();
    });

    $(document).on('click','.minus',function(){
            var quantity=$(this).closest('td').find('.product_qty').val();
            $(this).closest('td').find('.product_qty').val(+quantity - 1);
            subTotal();
        });

        $(document).on('click','.plus',function(){
            var quantity=$(this).closest('td').find('.product_qty').val();
            $(this).closest('td').find('.product_qty').val(+quantity + 1);
            subTotal();
            
        });
    $(document).on('click','.remove_btn',function(){
        $(this).closest("tr").remove();
        var id=$(this).attr('data-id');
        var index = selected_item.indexOf(id);
    if ( index > -1) {
        selected_item.splice(index, id);
    }
        rowNum();
        
        subTotal();
    });

    
    $('#search_item').on('keyup',function(){
        
        var search_item=$(this).val();
        if(search_item){
            $.ajax({
                url:"{{ url('pos/search_item') }}",
                type:"post",
                data:{search_item:search_item},
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                success:function(data){
                    console.log(data);
                    $('#search_result').html(data.search_item);
                    $('#search_result').show();
                }
            });
        }else{
            $('#search_result').hide();

        }
    });


    $('.close').on('click',function(){
        $('.modal').hide();
        $('#finalize_sale').attr('disabled',false).html("Submit");
        
    });

function rowNum(){
    $('tbody tr').each(function(v,i){
        $(this).find('.sr').html(v+1);
        // console.log(v);
    });
}

function subTotal(){
    $('tbody tr').each(function(v,i){
       var price= $(this).find('.product_price').val() ;
       var qty= $(this).find('.product_qty').val() ;
       var disc= $(this).find('.product_disc').val() ;
        // console.log(v);
        var subtotal=price*qty;
        $(this).find('.sub_total').text((subtotal - disc).toFixed(2));

        
    
    });
    grandTotal();
}
    
function grandTotal(){
    var grandTotal=0;
    $('tbody tr').each(function(){
        
        grandTotal += +$(this).find('.sub_total').text();
    });
    $('#grand_total').text(grandTotal.toFixed(2));  
    $('#net_total').text(grandTotal.toFixed(2));  
    $('#modal_total').val(grandTotal.toFixed(2));  
    $('#discount').val("");  
 
}




$(document).on('keyup', '.product_price,  .product_qty ,.product_disc', function() {
    subTotal();
});



    

    $('#paying_amount').on('keyup',function(){
        var paying=parseInt($('#paying_amount').val()) || 0;
        var total=parseInt($('#modal_total').val()) || 0;
        if(paying<total){

            $("#remaining").text((+total - +paying).toFixed(2));
            $('#change').text('0');

        }
        if(paying >= +total){

            $("#change").text((+paying- +total).toFixed(2));
            $('#remaining').text('0');

        }
        


    });

    function modal(){
        var paying=parseInt($('#paying_amount').val()) || 0;
        var total=parseInt($('#modal_total').val()) || 0;
        if(paying<total){

            $("#remaining").text((+total - +paying).toFixed(2));
            $('#change').text('0');

        }
        if(paying >= +total){

            $("#change").text((+paying- +total).toFixed(2));
            $('#remaining').text('0');

        }
        
    }

    $('#cash_btn').on('click',function(){
        modal();
    });
    
    var bill_detail=[];
    function cash(){
        $('tbody tr').each(function(i,v){
            var id=$(this).closest('tr').find('.remove_btn').attr('data-id');
            var price=$(this).closest('tr').find('.product_price').val();
           var qty= $(this).closest('tr').find('.product_qty').val();
           var disc= $(this).closest('tr').find('.product_disc').val();
           var net_total= $(this).closest('tr').find('.sub_total').text();
           bill_detail[i]={
'item_id':id,
'item_qty':qty,
'item_price':price,
'net_total':net_total,
'discout':disc
};
        });
    }
    $('tbody tr').each(function(){
    var qty = $(this).find('.product_qty').val();
    var price = $(this).find('.product_price').val();
    if(qty <= 0 || price <= 0 || price == "" || qty == ""){
        submitForm = false;
        return submitForm; // exit the loop if any invalid value is found
    }else{
        submitForm = true;
        return submitForm;
    }
});
    var bill=[];
    $('#finalize_sale').on('click',function(){
        cash();
    var rowCount = $('tbody tr').length;
    if(rowCount==0){
        Swal.fire("Please select item to sell")
    }else if(submitForm){
        $(this).attr('disabled',true);
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

        var date=$('#date').val();
        
        var account_id=$('#account_id').val();
        var pay_account_id=$('#pay_account_id').val();
        var discout=$('#discount').val();
        var grand_total=$('#grand_total').text();
        var tax=$('#tax').val();
        var change=$('#change').text();
        var rem=$('#remaining').text();
        var paid=$('#paying_amount').val();
        var desc=$('#sale_desc').val();
        var net_total=$('#net_total').text();
        
        bill={
        'date':date,
        'pay_account_id':pay_account_id,
        'account_id':account_id,
        'grand_total':grand_total,
        'discout':discout,
        'change':change,
        'rem':rem,
        'paid':paid,
        'desc':desc,
        'net_total':net_total,

        }
            $.ajax({
                url:"{{ url('/pos/addSale/') }}",
                type:"post",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data:{
                    bill:bill,
                    bill_detail:bill_detail
                },
                success:function(data){
                    console.log(data);
                    if(data.status=='200'){
						    var invoiceNumber = data.id;
    window.location.href = "{{ route('invoice', ':id') }}".replace(':id', invoiceNumber);

                       // window.location="/sell/gen_invoice/"+data.id;
                            }else{
                                alert('record not inserted');

                            }
                }
            });
    }else{
        Swal.fire("Product Quantity and Price must be greater then 0");

    }
    });
    

    $('#search_item').on('change', function(){
        var barcode = $(this).val();
        $.ajax({
    url: "{{ url('/sell/products/barcode') }}",
    type: "post",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        barcode: barcode
    },
    success: function(data) {
        console.log(data);
        $('').html(data.products);
    },
    fail: function(jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
    }
   
});
$(this).val("");
    
    });



});



</script>
</html>
