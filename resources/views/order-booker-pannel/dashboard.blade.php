@extends('order-booker-pannel.layouts.master')
@section('content')

<head>
    <title>@section('title','Add Order')</title>
</head>
<style>
    body {}

    #zero-pad .footer-background {
        background-color: rgb(204, 199, 199);
    }


    @media(max-width:991px) {
        #zero-pad #heading {
            padding-left: 50px;

        }

        #zero-pad #prc {
            margin-left: 70px;
            padding-left: 110px;
        }

        #zero-pad #quantity {
            padding-left: 48px;
        }

        #zero-pad #produc {
            padding-left: 40px;
        }

        #zero-pad #total {
            padding-left: 54px;
        }
    }

    @media(max-width:767px) {
        #zero-pad .mobile {
            font-size: 10px;
        }

        #zero-pad h5 {
            font-size: 14px;
        }

        #zero-pad h6 {
            font-size: 9px;
        }

        #zero-pad #mobile-font {
            font-size: 11px;
        }

        #zero-pad #prc {
            font-weight: 700;
            margin-left: -45px;
            padding-left: 105px;
        }

        #zero-pad #quantity {
            font-weight: 700;
            padding-left: 6px;
        }

        #zero-pad #produc {
            font-weight: 700;
            padding-left: 0px;
        }

        #zero-pad #total {
            font-weight: 700;
            padding-left: 9px;
        }

        #zero-pad #image {
            width: 60px;
            height: 60px;
            border-radius: 5px !important;

        }

        #zero-pad .col {
            width: 100%;
        }

        #zero-pad {
            padding: 2%;
            margin-left: 10px;
        }

        #zero-pad #footer-font {
            font-size: 12px;
        }

    }

    .bootstrap-touchspin .btn {
        width: 30px;
        height: 30px;
        font-size: 20px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-sm);
    }



    .xoo-wsc-basket {
        background-color: #ffffff;
        top: 15px;
        right: 30px;
        position: fixed;
        z-index: 1000;
    }


    .xoo-wsc-basket {
        background-color: #ffffff;
        top: 15px;
        right: 30px;
        position: fixed;
        z-index: 1000;
    }

    .xoo-wsc-items-count {
        border-radius: 50%;
        position: absolute;
        top: -15px;
        font-size: 13px;
        width: 28px;
        height: 28px;
        line-height: 28px;
        text-align: center;
        overflow: hidden;
        background: red;
        right: 10px;
        color: white;
    }

    .category-container {
        display: flex;
        align-items: center;
    }

    .category-scroll-left,
    .category-scroll-right {
        cursor: pointer;
        padding: 10px;
        color: #555;
    }

    .category-scroll-left:hover,
    .category-scroll-right:hover {
        color: #333;
    }

    .category-area {
        overflow-x: auto;
        white-space: nowrap;
    }

    .category-scroll {
        display: inline-flex;
        flex-wrap: nowrap;
        /* margin-bottom: 10px; Adjust as needed */
    }

    .arrow-icon {
        font-size: 20px;
    }

    /* Optional: Add Font Awesome for better arrow icons */
    .category-scroll-left .arrow-icon::before {
        content: '\f104';
        /* Unicode for left arrow in Font Awesome */
        font-family: 'Font Awesome 5 Free';
    }

    .category-scroll-right .arrow-icon::before {
        content: '\f105';
        /* Unicode for right arrow in Font Awesome */
        font-family: 'Font Awesome 5 Free';
    }
</style>

<!-- Page Content Start -->

<div class="page-content mt-3 p-b65 ">
    <div class="container py-0">



        <!-- Category Start -->
        <div class="category-container">

            <div class="category-area text-center">
                <input type="hidden" name="category_id" id="" value="0">

                <div class="category-scroll">
                    <span class="rounded-0 p-0 px-2 m-1 btn btn-outline-danger category_btn" data-id="0">All</span>

                    @foreach ($category as $category)
                    <span class="rounded-0 p-0 px-2 m-1 btn btn-outline-danger category_btn"
                        data-id="{{ $category->id }}">{{ Str::ucfirst($category->catagery_name) }}</span>
                    @endforeach
                </div>
            </div>


        </div>



        <hr>
        <!-- Catagory End -->


        <!-- ComingSoon End -->






        <!-- Product Item list Start -->
        <div class="product-items-list">
            <ul id="product-list">

                <div class="spinner-border text-primary text-center" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>


            </ul>
        </div>

        <div class="pagination"></div>
        <!-- Product Item list End -->


        <!-- Top Selection End -->
    </div>
</div>
<!-- Page Content End -->



<!-- Multicolor Canvas Start -->
<div class="offcanvas offcanvas-bottom m-3 rounded" tabindex="-1" id="offcanvasBottom"
    aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-body small">
        <ul class="theme-color-settings">
            <li>
                <input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-primary">
                <label for="primary_color_1"></label>
                <span>Default</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green">
                <label for="primary_color_2"></label>
                <span>Green</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue">
                <label for="primary_color_3"></label>
                <span>Blue</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink">
                <label for="primary_color_4"></label>
                <span>Pink</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow">
                <label for="primary_color_5"></label>
                <span>Yellow</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange">
                <label for="primary_color_6"></label>
                <span>Orange</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple">
                <label for="primary_color_7"></label>
                <span>Purple</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-red">
                <label for="primary_color_8"></label>
                <span>Red</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue">
                <label for="primary_color_9"></label>
                <span>Lightblue</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal">
                <label for="primary_color_10"></label>
                <span>Teal</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime">
                <label for="primary_color_11"></label>
                <span>Lime</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange">
                <label for="primary_color_12"></label>
                <span>Deeporange</span>
            </li>
        </ul>
    </div>
</div>
<!-- Multicolor Canvas Start -->

{{-- product variants modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title p-0" id="exampleModalLabel">Select Product</h5>
                <button class="btn-ext-dark fw-bold btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body p-2">
                <div class="variants-section">

                </div>
            </div>
            <div class="modal-footer">
                <button style="width: 100%;" id="add-product" data-bs-dismiss="modal" type="button"
                    class="btn btn-outline-primary close-button p-2 rounded-pill">
                    <span class="fw-bold fs-22">Add</span> <span id="variant-total" class="mx-2 fw-bold fs-22"></span>Rs
                </button>
            </div>
        </div>
    </div>
</div>
{{-- product variants modal end --}}

<!-- Modal -->



<div class="xoo-wsc-basket" style="">


    <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">

        <span class="xoo-wsc-items-count" id="total-cart">0</span>

        <i class="icon feather icon-shopping-cart h3"></i>
    </a>

</div>

<div class="offcanvas offcanvas-end  w-100  " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Cart</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <label for="">Customer Name</label>
                        <input type="text" required class="form-control" name="customer_name" id="customer_name"
                            placeholder="Enter Customer Name">
                    </div>
                    <div class="col-6">
                        <label for="">Select Order Type</label>
                        <select class="form-control" name="order_type" id="order_type" aria-label="" required="">


                            <option value="dine-in">Dine-in</option>
                            <option value="delivery">Delivery</option>
                            <option value="car-dine-in">Car Dine-in</option>
                            <option value="take-away">Take Away</option>

                        </select>
                    </div>




                </div>
            </div>
            <div class="col-md-6 my-3 my-md-0 ">
                <div class="d-flex justify-content-between">

                    <h5>Grand Total : </h5>
                    <h5 class="fload-end" id="grand_total">0</h5>
                </div>
                <div class="row g-4">

                    <div class="">
                        <!--<a href="javascript:viod(0)" id="cash-btn"-->
                        <!--    class="btn btn-outline-primary btn-sm float-end rounded-0">Submit</a>-->
                        <button id="cash-btn" class="btn btn-outline-primary btn-sm float-end rounded-0">
                            Submit
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div>

                    <div id="table" class="">

                    </div>
                </div>
            </div>


        </div>



    </div>

</div>
</div>



@endsection
<script src="{{asset('assets/js/sweet-alert.js')}}"></script>
<script src="{{asset('assets/js/pages/sweetalerts.init.js')}}"></script>


<script src="{{ asset('app_assets/js/jquery.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
  if (!data) return e.preventDefault() // stops modal from being shown
})
        // cartTable();



   var submitForm=true;
    var items=[];
    var selected_item=[];
	var row_num = 1;
    var addons = {};
    var item_addons = {};
    var extras = {};
    var variants = [];
    //
    loadProducts(1,0);



    $(document).on('click', '.pagination-btn', function() {
    var page = $(this).data('page');

    // Remove "active" class from all buttons
    $('.pagination-btn').removeClass('active');

    // Add "active" class to clicked button
    $(this).addClass('active');
    var category_id = $('input[name=category_id]').val();

    loadProducts(page,category_id);
});




// varint selectboxs

$(document).on('click','.card',function(){


    var id=$(this).closest('li').find('.id').val();

    var product_name=$(this).closest('li').find('.name').val();
    var price=$(this).closest('li').find('.price').val();
    var stock=$(this).closest('li').find('.stock').val();
    var image=$(this).closest('li').find('img').attr('src');

        if (selected_item.includes(id)) {
            // Find the table row with the matching product id
            const $tableRow = $('#table').find("tr[data-id='" + id + "']");

            // Increase the quantity by one
            const $quantityInput = $tableRow.find('.product_qty');
            const quantityValue = parseInt($quantityInput.val(), 10);

                $quantityInput.val(quantityValue + 1);

        } else {
        var sec = '';
        // console.log(variants[0]);
            for (let index = 0; index<variants.length; index++) {
                // console.log(variants[index]);
                if(variants[index].product_id==id){
                    sec = variants[index].section;
                }
            }


            $('.variants-section').html(
                '<div class="row">\
                       <div class="col-4">\
                            <img src='+image+' class="image" style="width:120px;border-radius:15px;border:0.5px solid black;height:80px;">\
                        </div> \
                        <div class="col-6 mt-2">\
                            <h4 class="m-0 p-0 text-primary" style="latter-spacing:1px;">'+capital(product_name)+'</h4>\
                            <h4 class="my-2 basic-cproduct-price" style="latter-spacing:1px;" >'+price+'</h4>\
                            <input type="hidden" value='+id+' name="product_id" class="product_id">\
                            <input type="hidden" value="'+product_name+'" name="product_name" class="product_name">\
                            <input type="hidden" value='+price+' name="product_price" class="product_price">\
                        </div> \
                </div>\
                <div>'+sec+'</div>\
                '

            );

            $('#variant-total').text(price);
        }




});





function capital(str) {
    return str.slice(0, 1).toUpperCase() + str.slice(1);
}



    $(document).on('click','.minus',function(){
            // var quantity=$(this).closest('td').find('.product_qty').val();
            // $(this).closest('td').find('.product_qty').val(+quantity - 1);
            // $('.qty-span').text(+quantity - 1);
            var quantity=parseInt($(this).closest('.container').find('.cart-qty').text());

            $(this).closest('.container').find('.cart-qty').text(+quantity - 1);

            // $('td .product_qty').val(+quantity - 1);


        qty =  quantity - 1;
        price =  parseInt($(this).closest('.container').find('.cart_item_price').text());

         $(this).closest('.container').find('.cart_item_total').text(price * qty);


            grandTotal();
        });

        $(document).on('click','.plus',function(){

            var quantity=parseInt($(this).closest('.container').find('.cart-qty').text());
            // alert(quantity)
$(this).closest('.container').find('.cart-qty').text(+quantity + 1);

// $('td .product_qty').val(+quantity - 1);


qty =  quantity + 1;

price =  parseInt($(this).closest('.container').find('.cart_item_price').text());

$(this).closest('.container').find('.cart_item_total').text(price * qty);

         grandTotal();


        });




    $(document).on('click','.remove',function(){
        total_item = $('.cart-section').length;
        $(this).closest('.cart-section').remove();

        $('#total-cart').text(total_item - 1);
        grandTotal();
    });



    // JavaScript array to store the loaded product data
 var productData = [];

// Function to load the product data on page load
    function loadProductData() {
        $.ajax({
            url:"{{ url('order-bookers/pos/search_item') }}",
            type: "GET",
            success: function (response) {
                productData= response.productData;

            },
        });
    }

// Function to search for products in the loaded data
    function searchProducts(searchItem) {
        var matchedProducts = [];
        if (searchItem) {
            // Perform the search within the loaded product data

            matchedProducts = productData.filter(function (product) {
                return (
                    product.product_name.toLowerCase().includes(searchItem.toLowerCase()) ||
                    product.product_code.toLowerCase().includes(searchItem.toLowerCase())
                );
            });
        }
        return matchedProducts;
    }

    $('#search_item').on('input', function () {
        var searchItem = $(this).val();

        if (searchItem) {
            var matchedProducts = searchProducts(searchItem);

            // Generate the HTML for the matched products
            var html = "";
            matchedProducts.forEach(function (product) {
                html += "<a href='#' class='bg-primary text-white list-group-item ' data-id='" + product.id + "' data-name='" + product.product_name + "' data-price='" + product.selling_price + "' data-stock='" + product.stock + "' data-qty='" + product.opening_stock + "'>"  + product.product_code + ' - ' + product.product_name + '</span>'+ "</a>";
            });

            // Display the search results
            $('#search_result').html(html);
            $('#search_result').show();
        } else {
            $('#search_result').hide();
        }
    });








// Call the function to load the product data on page load
    loadProductData();


    $('.close').on('click',function(){
        $('.modal').hide();
        $('#finalize_sale').attr('disabled',false).html("Submit");

    });


// function subTotal(){
//     $('#table tr').each(function(v,i){
//        var price= $(this).find('.product_price').val() ;
//        var qty= $(this).find('.product_qty').val() ;
//        var disc= $(this).find('.product_discount').val() ;

//         var subtotal=price*qty;
//         $(this).find('.sub_total').text((subtotal - disc).toFixed(2));


//     });
//     grandTotal();
// }

function grandTotal(){
    var grandTotal=0;
    $('.cart-section').each(function(){

        grandTotal += parseInt($(this).find('.product_subtotal').text());
    });
    $('#grand_total').text(grandTotal);

}







$('.category_btn').click(function() {


    $('.category_btn').removeClass('btn-danger');
    $(this).addClass('btn btn-danger');
  var categoryId = parseInt($(this).attr('data-id'));

  if(categoryId==0){
    loadProducts(1,0);
    $('input[name=category_id]').val(0);
  }else{

      $('input[name=category_id]').val(categoryId);
      loadProducts(1,categoryId);

  // Filter products based on category_id
  var filteredProducts = products.filter(function(product) {
    return product.category_id === categoryId;
  });
var html ="";
   $.each(filteredProducts, function(index, product) {
                var img = '';

                if (product.product_image != '') {
                    img = product.product_image;
                } else {
                    img = 'no_image.jpg';
                }



                html += ' <li class="card-product'+product.id+'">';
                html += '   <input type="hidden" class="id" value="' + product.id + '">';
             html += '      <input type="hidden" class="name" value="' + product.product_name + '">';
             html += '      <input type="hidden" class="price" value="' + product.selling_price + '">';
             html += '      <input type="hidden" class="category_id" value="' + product.category_id + '">';
             html += '      <input type="hidden" class="image-path" value="'+img+'" >';

			html += '   			<div class="product-items">';
			html += '   				<a href="">';
			html += '   					<div class="media media-80 me-2">';
			html += '   						<img class="rounded" src="{{ URL::to('/') }}/img/' + img + '"" alt="">';
			html += '   					</div>';
			html += '   				</a>';
			html += '   				<a href="">';
			html += '   					<div class="product-content" style="color:#fe4487;">';
			html += '   						<h6 style="color:#fe4487;" class="title product_name">'+capital(product.product_name)+'</h6>';
			html += '   						<h6 style="color:black;" class="desc">'+product.selling_price+'</h6>';

			html += '   					</div>';
			html += '   				</a>';
			html += '   				<a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="" class="card dz-icon"><i class="icon feather icon-shopping-cart"></i></a>';
			html += '   			</div>';
			html += '   		</li>'



            });
  }
            $('#product-list').html(html);




});


    // $('#paid_amount').on('keyup',function(){

    //     grandTotal();
    // });









var bill_detail=[];
var addon_total_price = 0;
var extra_total_price = 0;
var varriation_total_price = 0;
var tr = 0
function cash(){
        $('.cart-section').each(function(i,v){
            var varData = {};
            var addons = {}
    var extras = {}
            var id=$(this).closest('.container').find('.product_id').val();
            var price=$(this).closest('.container').find('.product_price').text();
           var qty= $(this).closest('.container').find('.cart-qty').text();
           var net_total= $(this).closest('.container').find('.sub_total').text();
        //    varData[i] = [];
            $(this).find('.varriation_detail').each(function(index,value){
              varriation_total_price +=  parseFloat($(this).find('.selected_varriation_price').val());
              varData[index]={
                    'attibute_id':$(this).closest('.varriation_detail').find('.selected_attribute_id').val(),
                    'attribute_name':$(this).closest('.varriation_detail').find('.selected_attribute_name').val(),
                    'varriation_price':$(this).closest('.varriation_detail').find('.selected_varriation_price').val(),
                    'varriation_id':$(this).closest('.varriation_detail').find('.selected_varriation_id').val(),
                    'varriation_name':$(this).closest('.varriation_detail').find('.selected_varriation_name').val(),
                }


            });

            $(this).closest('.container').find('.addon_detail').each(function(index,value){
               addon_total_price+= parseFloat($(this).closest('.addon_detail').find('.selected_addon_price').val());
                addons[index]={
                    'addon_id':$(this).find('.selected_addon_id').val(),
                    'addon_name':$(this).find('.selected_addon_name').val(),
                    'addon_price':$(this).find('.selected_addon_price').val(),
                }
            });
            $(this).closest('.container').find('.extra_detail').each(function(index,value){
                extra_total_price += parseFloat($(this).closest('.extra_detail').find('.selected_extra_price').val());

                extras[index]={
                    'extra_id':$(this).closest('.extra_detail').find('.selected_extra_id').val(),
                    'extra_name':$(this).closest('.extra_detail').find('.selected_extra_name').val(),
                    'extas_price':$(this).closest('.extra_detail').find('.selected_extra_price').val(),
                }
            });

bill_detail[i]={
'item_id':id,
'item_qty':qty,
'varriants':varData,
'extra':extras,
'addons':addons,
'varriation_total_price':varriation_total_price,
'addon_total_price':addon_total_price,
'extra_total_price':extra_total_price,
'item_price':price,
'net_total':net_total,
};
        });



    }





    $('.cart-section').each(function(){
    var qty = $(this).closest('.container').find('.cart-qty').text();

    if(qty <= 0 || qty == "" ){
        submitForm = false;
        return submitForm; // exit the loop if any invalid value is found
    }else{
        submitForm = true;
        return submitForm;
    }
});
    var bill=[];
    $('#cash-btn').on('click',function(){
        cash();

    var rowCount = $('.cart-section').length;

    if(rowCount==0){
        toastr.error('Please select one product at-leat.', 'Error');

    }else if(submitForm){



        var rem =0;
        var order_type=$('#order_type').val();
        var customer_name=$('#customer_name').val();
        var grand_total=parseInt($('#grand_total').text());


        if(customer_name==""){


            toastr.error('Please enter customer name.', 'Error');

return false;
}


        bill={
        'customer_name':customer_name,
        'order_type':order_type,
        'grand_total':grand_total,
        'net_total':grand_total,

        }

            $(this).attr('disabled',true).text(`Loading...`);
            $.ajax({
                url:"{{ url('order-bookers/order') }}",
                type:"post",
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data:{
                    bill:bill,
                    bill_detail:bill_detail
                },
                success:function(data){



                    if(data.status==2){
                        toastr.error(data.message, 'Error');
                                            $('#cash-btn').attr('disabled',false).text(`Submit`);
                        return false;

                    }

                    if(data.status=='200'){


						    var invoiceNumber = data.id;


// const timeValue = "15";
// const timeInSeconds = timeToSeconds(timeValue);

//                             function timeToSeconds(time) {
//     return time*60;
// }

// localStorage.setItem("timerValue_"+invoiceNumber , timeInSeconds);

var invoiceNumber = data.id;
const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds

localStorage.setItem("currentTime_" + invoiceNumber, currentTime);


// window.location.replace("{{ route('order.booker.invoice', ':id') }}".replace(':id', invoiceNumber));
                       // window.location="/sell/gen_invoice/"+data.id;

                       window.location.replace("{{ route('order-booker.dashboard') }}");

                            }
                            else if(data.status==0){
                                toastr.error("Restorent time is end..!", 'Error');
                                                    $('#cash-btn').attr('disabled',false).text(`Submit`);
                                return false;
                            }
                            else{
                                toastr.error('Some thing went wrong..!')
                    $('#cash-btn').attr('disabled',false).text(`Submit`);
                            }
                }
            });
    }else{
        Swal.fire("Product Quantity and Price must be greater then 0");

    }
    });



$(document).on('change','.variant-selection',function(){
    variant_total();
});
    function variant_total() {

var totalPrice =  parseInt($('.basic-cproduct-price').text()) || 0;

    $(".variant-selection").each(function () {

            var selectedOption = $(this).find(":selected");
            var optionPrice = parseFloat(selectedOption.data("price"));

            if (!isNaN(optionPrice)) {
                totalPrice += optionPrice;
            }
    });
        $(".price-checkbox").each(function(){
    if($(this).prop("checked")){
        var price = $(this).closest('.variation-card').find('.price').text() || 0;
        totalPrice += parseInt(price);
    }
});
$(".variation-price-checkbox").each(function(){
    if($(this).prop("checked")){
        var price = $(this).closest('.variation-card').find('.price').text() || 0;
        totalPrice += parseInt(price);

    }
});
$('.variation-price-radio').each(function(){
    if($(this).prop('checked')){
        var price = $(this).closest('.single-variation-card').find('.price').text() || 0;
        totalPrice += parseInt(price);

    }
});


        $('#variant-total').text(totalPrice);
    }


    $(document).on("click",".variation-card", function() {
        var checkbox = $(this).find("input[type='checkbox']");

        // Toggle the checkbox's checked state
        checkbox.prop("checked", !checkbox.prop("checked"));

        // Toggle a CSS class to handle the background color
        $(this).toggleClass("selected-variants-container");
        var radio = $(this).find("input[type='radio']");

    // Only toggle if the radio is not already checked

        variant_total();
    });

    $(document).on('click', '.single-variation-card', function () {
    var radio = $(this).find("input[type='radio']");

    if (!radio.prop("checked")) {
        // Deselect all other radios in the same group
        $(".single-variation-card input[type='radio']").prop("checked", false);
        $(".single-variation-card").removeClass("selected-variants-container");

        // Toggle the clicked radio as checked
        radio.prop("checked", true);
        $(this).addClass("selected-variants-container");
    } else {
        // Toggle the clicked radio as unchecked
        radio.prop("checked", false);
        $(this).removeClass("selected-variants-container");
    }
    variant_total();
});







$(document).on('DOMNodeInserted', '.js-example-basic-multiple', function () {
    $(this).select2();
});

// product to table
var cart = [];
$('#add-product').click(function () {

    var item_total_price = $(this).closest('.modal').find('#variant-total').text() || 0;
    var product_id = $(this).closest('.modal').find('.product_id').val();
    var product_name = $(this).closest('.modal').find('.product_name').val();
    var product_price = $(this).closest('.modal').find('.product_price').val();
    var image = $(this).closest('.modal').find('.image').attr('src');

    var variantsHtml = "";

    // Create an object to group variants by attribute name
    var attributeVariants = {};


    var selectAttributeVariants = {};
    var addon = {};
    var extras = {};

    //for single selected variables
    var single_attribute_id="";

    var single_attribute_name = "";
    var single_variation_id = "";
    var single_variation_name ="";
    var single_variation_price ="";
    var variantsHtml = '';
$('.variation-price-radio:checked').each(function () {

        var variant_name = $(this).closest('.single-variation-card').find('.variant-name').text();
        var variant_price = parseFloat($(this).closest('.single-variation-card').find('.variant-price').val()) || 0;
        var attribute_name = $(this).closest('.single-variants').find('.single_attribute_name_field').val();
         single_attribute_id = $(this).closest('.single-variants').find('.single_attribute_id_field').val();
         single_attribute_name = $(this).closest('.single-variants').find('.single_attribute_name_field').val();
         single_variation_id = $(this).closest('.single-selection').find('.single_varriantion_id_field').val();
         single_variation_name = $(this).closest('.single-selection').find('.single_varriantion_name_field').val();
         single_variation_price = $(this).closest('.single-selection').find('.single_varriantion_price_field').val();

         variantsHtml +="<span class='varriation_detail'><input type='hidden' class='selected_attribute_id' value="+single_attribute_id+" ><input type='hidden' class='selected_attribute_name' value='"+attribute_name+"' ><input type='hidden' class='selected_varriation_id' value='"+single_variation_id+"'><input type='hidden' class='selected_varriation_name' value='"+single_variation_name+"'><input type='hidden' class='selected_varriation_price' value='"+single_variation_price+"'></span>";

        // Add the variant to the respective attribute in the object

        if (!selectAttributeVariants[attribute_name]) {
            selectAttributeVariants[attribute_name] = [];
        }
        selectAttributeVariants[attribute_name].push(variant_name);
    });

// Build the variantsHtml by iterating over the selectAttributeVariants object


for (var selectAttributeName in selectAttributeVariants) {
    variantsHtml += "<span class=''><input type='hidden' class='selected_attribute_id' name='selected_attribute_id' value='"+single_attribute_id+"'><input type='hidden' class='selected_attribute_nam' name='selected_attribute_nam' value='"+single_attribute_name+"'><input type='hidden' class='selected_varriant_id' name='selected_varriant_id[]' value='"+single_variation_id+"'><input type='hidden' class='selected_varriant_name' name='selected_varriant_name[]' value='"+single_variation_name+"'><input type='hidden' class='selected_varriant_price' name='selected_varriant_price[]' value='"+single_variation_price+"'>" + selectAttributeName + ": " + selectAttributeVariants[selectAttributeName].join(', ') + "</span><br>";
}

// Display the selected variants

    // Build the variantsHtml by iterating over the selectedVariants object

    // for multi  select attributes
    $('.variation-price-checkbox:checked').each(function () {

        var variant_name = $(this).closest('.variation-card').find('.variant-name').text();
        var variant_price = parseFloat($(this).closest('.variation-card').find('.variant-price').val()) || 0;
        var attribute_name = $(this).closest('.row').find('.attribute_name').text();

        attribute_id = $(this).closest('.multi-variants').find('.attribute_id_field').val();
         m_variation_id = $(this).closest('.variant-selection').find('.m_varriantion_id_field').val();
         m_variation_name = $(this).closest('.variant-selection ').find('.m_varriantion_name_field').val();
         m_variation_price = $(this).closest('.variant-selection ').find('.m_varriantion_price_field').val();

         variantsHtml +="<span class='varriation_detail'><input type='hidden' class='selected_attribute_id' value='"+attribute_id+"' name='selected_attribute_id[]'><input type='hidden' class='selected_attribute_name'  value='"+attribute_name+"' ><input type='hidden' class='selected_varriation_id' name='selected_varriation_id[]' value='"+m_variation_id+"'><input type='hidden' class='selected_varriation_name' name='selected_varriation_name[]' value='"+m_variation_name+"'><input type='hidden' class='selected_varriation_price' name='selected_varriation_price[]'  value='"+m_variation_price+"'></span>";


        // Add the variant to the respective attribute in the object

        if (!attributeVariants[attribute_name]) {
            attributeVariants[attribute_name] = [];
        }
        attributeVariants[attribute_name].push(variant_name) ;



    });
    // Build the variantsHtml by iterating over the attributeVariants object
    for (var attribute_name in attributeVariants) {
        variantsHtml += "<span class=''>"+ attribute_name + "</span>: " + attributeVariants[attribute_name].join(', ') + "<br>";
    }

    // <input type='' class='selected_attribute_id' value='"+attribute_id+"'><input type='' class='selected_attribute_nam' value='"+attribute_name+"'><input type='' class='selected_varriant_id' value='"+m_variation_id+"'><input type='' class='selected_varriant_name' value='"+m_variation_name+"'><input type='hidden' class='selected_varriant_price' value='"+m_variation_price+"'>

    // addons
var addons = {};
    $('.addon-check-box:checked').each(function () {

        var addon_name = $(this).closest('.variation-card').find('.variant-name').text();
        var addon_price = parseFloat($(this).closest('.variation-card').find('.variant-price').val()) || 0;
        var attribute_name = $(this).closest('.row').find('.attribute_name').text();

        addon_id = $(this).closest('.addon-click').find('.addon_id_field').val();
        addons_name = $(this).closest('.addon-click').find('.addon_name_field').val();
        addons_price = $(this).closest('.addon-click').find('.addon_price_field').val();
        // Add the variant to the respective attribute in the object



        if (!addon[attribute_name]) {
            addon[attribute_name] = [];
        }
        addon[attribute_name].push(addon_name);
        variantsHtml +="<span class='addon_detail'><input type='hidden' class='selected_addon_id' name='selected_addon_id[]' value='"+addon_id+"' ><input type='hidden' class='selected_addon_name' name='selected_addon_name[]' value='"+addons_name+"' ><input type='hidden' class='selected_addon_price' name='selected_addon_price[]' value='"+addon_price+"'></span>";

    });

    // Build the variantsHtml by iterating over the attributeVariants object
    for (var attribute_name in addon) {
        variantsHtml += "<span>"+ attribute_name + "</span>: " + addon[attribute_name].join(', ') + "<br>";
    }


    // extras
    $('.extras-checkbox:checked').each(function () {

        var extra_name = $(this).closest('.variation-card').find('.variant-name').text();
        var extra_price = parseFloat($(this).closest('.variation-card').find('.variant-price').val()) || 0;
        var attribute_name = $(this).closest('.row').find('.attribute_name').text();
        extras_id = $(this).closest('.btn').find('.extra_id_field').val();
        extras_name = $(this).closest('.btn').find('.extra_name_field').val();
        extras_price = $(this).closest('.btn').find('.extra_price_field').val();
        // Add the variant to the respective attribute in the object

        // variantsHtml +="<span class='extra_detail'><input type='' class='selected_extra_id' value='"+extras_id+"' ><input type='' class='selected_extra_name' value='"+extras_name+"' ><input type='' class='selected_extra_price' value='"+extras_price+"'></span>";



        if (!extras[attribute_name]) {
            extras[attribute_name] = [];
        }
        extras[attribute_name].push(extra_name);
        variantsHtml +="<span class='extra_detail'><input type='hidden' class='selected_extra_id' name='selected_extra_id[]' value='"+extras_id+"' ><input type='hidden' class='selected_extra_name' name='selected_extra_name[]' value='"+extras_name+"' ><input type='hidden' class='selected_extra_price' name='selected_extra_price[]' value='"+extras_price+"'></span>";
    });

    // Build the variantsHtml by iterating over the attributeVariants object
    for (var attribute_name in extras) {
        variantsHtml += "<span>  "+ attribute_name + "</span>: " + extras[attribute_name].join(',') + "<br>";
    }



    $('#table').append(`
    <div class="container bg-white rounded-top cart-section" id="">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12 border-bottom">

            <div class="d-flex flex-row justify-content-between align-items-center   mobile">
                <div class="d-flex flex-row align-items-center">
                    <input type="hidden" class="product_id" name="product_id" value="${product_id}">
                    <div class="d-flex flex-column pl-3 pl-1">
                        <div><h5>${capital(product_name)}</h5></div>
                        <div>${variantsHtml}</div>
                        <div>Rs:<span class="pl-3 product_price cart_item_price">${item_total_price}</span></div>
                    </div>

                </div>
             </div>
            <div class="pl-md-0 pl-2 text-end d-flex justify-content-between">
                <div>
                Total : <span class="cart_item_total sub_total product_subtotal mr-4">${item_total_price}</span>
                    <span class="btn btn-light bg-white border btn-sm rounded-0 bootstrap-touchspin-down minus">-</span><span class="px-md-3 px-1 cart-qty">1</span><span class="btn btn-light bg-white border btn-sm rounded-0 bootstrap-touchspin-down plus">+</span>
                </div>

                    <span class="btn btn-primary float-end btn-sm remove">X</span>

            </div>


        </div>
    </div>
</div>

`);




    grandTotal();
    // cartTable();
   total =  $('.cart-section').length;
$('#total-cart').text(total);



});


function cartTable() {
    const storedData = localStorage.getItem('selectedItems');

    let data = [];
    if (storedData) {
        data = JSON.parse(storedData);
    }

    const table = $('#table');
    table.empty(); // Clear the existing table content

    for (let i = 0; i < data.length; i++) {
        const item = data[i];
        table.append(item.detail);
    }
    if( total_item = localStorage.getItem('selectedItems')){

$('#total-cart').text(data.length);
}
}







function loadProducts(page,category_id , btn=null) {
    $('#product-list').html('<div class="spinner-border text-primary text-center m-auto" role="status">\
  <span class="visually-hidden">Loading...</span>\
</div>');
$.ajax({

        url: '{{ url("order-bookers/sell/products?page=") }}' + page,
    data:{
        category_id:category_id
    },
    dataType: 'json',
    success: function(response) {
        console.log(response);
        variants = response.variants;
         products = response.products;

        var html = '';

        $.each(products, function(index, product) {
            var img = '';


            if (product.product_image != '') {
                img = product.product_image;
            } else {
                img = 'no_image.jpg';
            }



            html += ' <li class="card-product'+product.id+'">';
                html += '   <input type="hidden" class="id" value="' + product.id + '">';
             html += '      <input type="hidden" class="name" value="' + product.product_name + '">';
             html += '      <input type="hidden" class="price" value="' + product.selling_price + '">';
             html += '      <input type="hidden" class="category_id" value="' + product.category_id + '">';
             html += '      <input type="hidden" class="image-path" value="'+img+'" >';

			html += '   			<div class="product-items">';
			html += '   				<a href="javascript:void(0)">';
			html += '   					<div class="media media-80 me-2 px-2">';
			html += '   						<img class="rounded" src="{{ URL::to('/') }}/img/' + img + '"" alt="">';
			html += '   					</div>';
			html += '   				</a>';
			html += '   				<a href="javascript:void(0)">';
			html += '   					<div class="product-content" style="color:#fe4487;">';
			html += '   						<h6 style="color:#fe4487;" class="title product_name">'+capital(product.product_name)+'</h6>';
			html += '   						<h6 style="color:black;" class="desc">'+product.selling_price+'</h6>';

			html += '   					</div>';
			html += '   				</a>';
			html += '   				<a  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="cart.html" class="card dz-icon"><i class="icon feather icon-shopping-cart"></i></a>';
			html += '   			</div>';
			html += '   		</li>'



        });

        $('#product-list').html(html);



        // Display pagination buttons
        var totalPages = response.total_pages;
        var totalEntries = response.total_entries;
        var paginationHtml = '<hr>';

        // Calculate the range of pages to display
        var startPage = Math.max(1, page - 3);
        var endPage = Math.min(totalPages, startPage + 4);


        paginationHtml += '<div class="col-12 text-center mt-2">';
        paginationHtml += 'Total Entries: ' + totalEntries + ' | ';
        paginationHtml += 'Page ' + page + ' of ' + totalPages;
        paginationHtml += '<br>';

        paginationHtml += '<nav aria-label="..." class="mt-2 ">';
        paginationHtml += '<div class="pagination d-flex justify-content-center">';
        if (page > 1) {
            paginationHtml += ' <button type="button" class="rounded-1 btn btn-outline-primary pagination-btn btn-sm" data-page="' + (page - 1) + '">  Prev </button>';
        }
        for (var i = startPage; i <= endPage; i++) {
            var active = (page == i) ? "active text-white" : "";

            paginationHtml += '<button type="button" class="rounded-1 btn btn-outline-primary pagination-btn btn-sm ' + active + '" data-page="' + i + '">' + i + '</button>';
        }
        if (page < totalPages) {
            paginationHtml += '<button type="button" class="rounded-1 btn btn-outline-primary pagination-btn btn-sm" data-page="' + (page + 1) + '">  Next</button>';
        }
        paginationHtml += '</div>';
        paginationHtml += '</nav>';
        paginationHtml += '</div>';

        $('.pagination').html(paginationHtml);
        // $(".pagination").find('.active').css("background-color", "#fe4487");

    }
});





}
});

</script>

</html>
<style>
    .selected-variants-container {
        background-color: #fe4487;
        color: white;
        border-radius: 10px;
    }
</style>
