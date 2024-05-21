<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    {{--
    <link rel="shortcut icon" href="{{ asset('assets/') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- aos css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/aos/aos.css') }}" />

    <!-- Layout config Js -->

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- new bootstrap --}}
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    --}}
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    {{-- font awesome --}}
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    {{-- jquery --}}



    {{-- csrf --}}
    {{-- datable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

    {{-- sweet alerts --}}
    <link rel="stylesheet" href="sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    {{-- --}}
    {{--
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}


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

        .card:hover {
            cursor: pointer;
            border-color: #7c5cc4 !important;
        }

        .addons-container , .extra-container {
            margin-top: 10px;
        }

        .addon-row , .extra-row {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            padding: 5px;
        }

        .variation-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 3px 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .single-variation-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 3px 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .variant-name {
            font-weight: bold;

        }

        .variants-container {
            margin-top: 10px;
            padding: 5px;
        }

        .variants-row {
            margin-bottom: 10px;

            padding: 5px;
        }

        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #e9bcbc63;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* .pagination-btn.active {
    background-color: gray;
    color: #fff;
} */
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>POS</title>
</head>

<body>
    <div class="loader-container" id="loaderContainer">
        <div class="loader"></div>
    </div>
    <div class="container-fluid" style="">
        <div class="row">
            {{-- right side --}}

            <div class="col-md-6 bg-white">

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="">Order Booker</label>
                        <select name="booker_id" id="booker_id" class="form-control" required>
                            @foreach ($booker as $booker)
                            <option value="{{ $booker->id }}">{{ $booker->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">

                        <label for="">Select Order Type</label>
                        <div class="input-group">
                            <select class="form-select customer" name="order_type" id="order_type"
                                aria-label="Example select with button addon" required>

                                <option value="dine-in">Dine-in</option>
                                <option value="delivery">Delivery</option>
                                <option value="car-dine-in">Car Dine-in</option>
                                <option value="take-away">Take Away</option>

                            </select>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Date</label>

                        <input type="date" disabled class="form-control " value="<?php echo date('Y-m-d'); ?>" id="date" required>
                    </div>

                </div>

                <br>
                <div class="row">
                    <div class="col bg-white" style="height:67vh;overflow-y: auto;">
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

                                                    <th colspan="3" class="col-sm-3">Product</th>
                                                    <th class="col-sm-2 text-center">Price</th>
                                                    <th class="col-sm-2 text-center">Quantity</th>
                                                    <th class="col-sm-1 text-center">Discount</th>
                                                    <th class="col-sm-2 text-center">SubTotal</th>
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

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="rounded payment-amount bg-primary">
                            <h4 class="text-white mx-2 py-2">Grand Total : <strong id="grand_total"
                                    class="net_total">00</strong></h4>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <input type="text" name="" id="discount" class="form-control" placeholder="Enter Discount">
                    </div>
                    <div class="col-md-4">
                        <div class="rounded payment-amount bg-primary">
                            <h4 class="text-white mx-2 py-2">NetTotal : <span id="net_total">00</span></h4>
                        </div>
                    </div>

                </div>

            </div>

            {{-- category portion --}}

            <div class="col-md-1" style="overflow: auto;">

                {{-- <h5 class="text-center my-2 bordered">Categories</h5> --}}
                <button style="width: 100%" class="btn btn-primary category_btn" data-id="0">All Items</button>

                @foreach ($category as $category)

                <div class="d-flex justify-content-center my-2">
                    <button style="width: 100%" class="btn btn-success category_btn" data-id="{{ $category->id }}">{{
                        $category->catagery_name }}</button>
                </div>
                @endforeach
            </div>

            {{-- Right side --}}
            <div class="col-md-5 ">
                <header class="bg-white p-2">
                    <div class="d-flex justify-content-between">

                        <button type="button" id="finalize_sale" class="btn btn-primary  payment-btn text-white float-end"><i class="las la-money-bill-wave"></i>
                            Cash Bill</button>

                        <div class="dropdown d-inline-block">
                            <button class="menu-btn btn btn-outline-primary dropdown" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class=" ri-menu-fill"> </i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="{{url('/')}}" class="dropdown-item"><i
                                            class="ri-printer-cloud-fill align-bottom me-2 text-muted"></i> Back To
                                        Dashboard</a></li>
                                <li><a href="{{ route('logout') }}" class="dropdown-item edit-item-btn" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                                            class="ri-lock-fill align-bottom me-2 text-muted"></i> {{ __('Logout') }}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </a></li>
                            </ul>
                        </div>









                    </div>
                </header>

                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control mt-3 p-2" id="search_item"
                            placeholder="Search Item Here">
                        <div id="search_result" class="bg-primary position-absolute"
                            style="width:95%; display: none!important; z-index: 9999;">
                            <!-- Search suggestions will be displayed here -->
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="card-group"></div>

                    <hr>
                    <div class="pagination"></div>
                </div>
            </div>

        </div>
    </div>


    {{-- category id input --}}
    <input type="hidden" name="category_id" id="" value="0">


    {{-- sale finalize modal --}}
    <div class="modal fade  bd-example-modal-lg" id="add-payment" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="number" name="paying_amount" id="paying_amount"
                                placeholder="Enter paying amount" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="totalamount">Total Amount</label>
                            <input type="number" name="totalamount" id="modal_total" placeholder="Total Amount"
                                class="form-control" readonly required>
                        </div>
                    </div>
                    <div class="row mt-2 d-none">
                        <div class="col-3">
                            <label for="change">Change</label>
                            <p name='change' class="ml-2" id="change">0.0</p>
                        </div>
                        <div class="col-3">
                            <label for="remaining">Remaining</label>
                            <p name='remaining' class="ml-2" id="remaining">0.0</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="sale_desc"></label>
                            <textarea name="sale_desc" id="sale_desc" class="form-control" rows="5"
                                placeholder="Sale Description"></textarea>
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

    <!--   ADD CUSTOMER  -->

    <div class="modal fade" id="add-customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="add-customer-form" method="POST" action="{{ url('/sell/pos/add-customer') }}">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div id="name-error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="number">Number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                            <div id="number-error" class="invalid-feedback"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- add customer end -->

    {{-- product variants modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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


</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
     window.addEventListener('load', function() {
            // Hide the loader and show the content
            document.getElementById('loaderContainer').style.display = 'none';
            document.getElementById('content').style.display = 'block';
        });
    $(document).ready(function(){



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



$('#add-customer-form').submit(function(event) {
                event.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            $('select').append($('<option>', {
                                value: response.customer.id,
                                text: response.customer.name
                            }));
                            $('.modal').modal('hide');
                            $('#add-customer-form').trigger('reset');
                            $('#success-message').html(response.success).show();
                            $('#name-error').hide();
                            $('#number-error').hide();
                        } else {
                            // display validation errors in the form
                            if (response.errors) {
                                if (response.errors.name) {
                                    $('#name').addClass('is-invalid');
                                    $('#name-error').text(response.errors.name[0]);
                                }
                                if (response.errors.phone) {
                                    $('#phone').addClass('is-invalid');
                                    $('#number-error').text(response.errors.phone[0]);
                                }
                                // add any other error handling you need
                            }
                        }
                    }
                });
            });


            var productData = [];
            var products = [];








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





  });


// varint selectboxs

$(document).on('click','.card',function(){

    var id=$(this).find('.id').val();
    var product_name=$(this).find('.name').val();
    var price=$(this).find('.price').val();
    var stock=$(this).find('.stock').val();
    var image=$(this).find('img').attr('src');

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
                       <div class="col-2">\
                            <img src='+image+' style="width:120px;border-radius:15px;border:0.5px solid black;height:100px;">\
                        </div> \
                        <div class="col-3 mt-2">\
                            <h4 class="m-0 p-0" style="latter-spacing:1px;">'+capital(product_name)+'</h4>\
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

    $(document).on('click','.new_product',function(){
        $('#search_item').val('');
        var id=$(this).attr('data-id');
        var name=$(this).attr('data-name');
        var price=$(this).attr('data-price');
        var image=$(this).attr('data-image');


            if (selected_item.includes(id)) {
                // Find the table row with the matching product id
                const $tableRow = $('#table').find("tr[data-id='" + id + "']");

                // Increase the quantity by one
                const $quantityInput = $tableRow.find('.product_qty');
                const quantityValue = parseInt($quantityInput.val(), 10);

                    $quantityInput.val(quantityValue + 1);

            } else {
        //         $('#table').append(
        //             "<tr class='' data-id='" + id + "' data-stock='" + stock + "'><th class='px-0 sr'></th>\
        //     <th overflow:hidden;' class='w-auto'>" + name + "</td>\
        //     <td><input type='number' class='product_price form-control text-center' value=" + price + "></td>\
        //      <td class='w-auto'><div class='text-center'><div class='input-step step-danger text-center'><button type='button' class='minus'>–</button><input type='number' class='product_qty' value='1'><button type='button' style='background:#42ba96;' class='plus'>+</button></div></div></td>\ <td class='w-auto'><input type='number' class='product_disc form-control ' value='0'></td>\
        //    <th class='sub_total text-center'></th>\
        //     <td ><a href='#' data-id=" + id + " class='remove_btn btn btn-danger btn-sm'>X</td>\
        //     </tr>"
        //         );

        var sec = '';
        // console.log(variants[0]);
            for (let index = 0; index<variants.length; index++) {
                // console.log(variants[index]);
                if(variants[index].product_id==id){
                    sec = variants[index].section;
                }
            }

                path ="{{ asset('img/') }}";
            $('.variants-section').html(
                `<div class="row">
                       <div class="col-2">
                            <img src="${path}/${image}" style="width:120px;border-radius:15px;border:0.5px solid black;height:100px;">
                        </div>
                        <div class="col-3 mt-2">
                            <h4 class="m-0 p-0" style="latter-spacing:1px;">`+capital(name)+`</h4>
                            <h4 class="my-2 basic-cproduct-price" style="latter-spacing:1px;" >${price}</h4>
                            <input type="hidden" value='${id}' name="product_id" class="product_id">
                            <input type="hidden" value="${name}" name="product_name" class="product_name">
                            <input type="hidden" value='${price}' name="product_price" class="product_price">
                        </div>
                </div>
                <div>${sec}</div>
                `

            );

            $('#variant-total').text(price);

            }

                subTotal();
        selected_item.push(id);

        $('#search_result').hide();
    });

    $(document).on('click','.minus',function(){
            var quantity=$(this).closest('td').find('.product_qty').val();
            $(this).closest('td').find('.product_qty').val(+quantity - 1);
            subTotal();
        });

        $(document).on('click','.plus',function(){
             var quantity=$(this).closest('td').find('.product_qty').val();
            var $tableRow = $(this).closest('tr');
            var stock = parseInt($tableRow.attr('data-stock'), 10);

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


        subTotal();
    });




    // JavaScript array to store the loaded product data
 var productData = [];

// Function to load the product data on page load
    function loadProductData() {
        $.ajax({
            url:"{{ url('pos/search_item') }}",
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
        console.log(matchedProducts);
        return matchedProducts;
    }

    $('#search_item').on('input', function () {
        var searchItem = $(this).val();


        if (searchItem) {
            var matchedProducts = searchProducts(searchItem);

            // Generate the HTML for the matched products
            var html = "";
            matchedProducts.forEach(function (product) {
                html += "<a href='js:void(0)' data-bs-toggle='modal' data-bs-target='#exampleModal' class='bg-primary text-white list-group-item new_product'   data-id='" + product.id + "' data-name='" + product.product_name + "' data-price='" + product.selling_price + "' data-stock='" + product.stock + "' data-image='" + product.product_image + "'>"  + product.product_name + '</span>'+ "</a>";
            });

            // Display the search results
            $('#search_result').html(html);
            $('#search_result').show();
        } else {
            $('#search_result').hide();
        }
    });
$(document).on('click','.new_product',function(){
    $('#search_result').hide();

    // var id=$(this).find('.id').val();
    // var product_name=$(this).find('.name').val();
    // var price=$(this).find('.price').val();
    // var image=$(this).find('img').attr('src');

    //     if (selected_item.includes(id)) {
    //         // Find the table row with the matching product id
    //         const $tableRow = $('#table').find("tr[data-id='" + id + "']");

    //         // Increase the quantity by one
    //         const $quantityInput = $tableRow.find('.product_qty');
    //         const quantityValue = parseInt($quantityInput.val(), 10);

    //             $quantityInput.val(quantityValue + 1);

    //     } else {
    //     var sec = '';
    //     // console.log(variants[0]);
    //         for (let index = 0; index<variants.length; index++) {
    //             // console.log(variants[index]);
    //             if(variants[index].product_id==id){
    //                 sec = variants[index].section;
    //             }
    //         }


            // $('.variants-section').html(
            //     '<div class="row">\
            //            <div class="col-2">\
            //                 <img src='+image+' style="width:120px;border-radius:15px;border:0.5px solid black;height:100px;">\
            //             </div> \
            //             <div class="col-3 mt-2">\
            //                 <h4 class="m-0 p-0" style="latter-spacing:1px;">'+capital(product_name)+'</h4>\
            //                 <h4 class="my-2 basic-cproduct-price" style="latter-spacing:1px;" >'+price+'</h4>\
            //                 <input type="hidden" value='+id+' name="product_id" class="product_id">\
            //                 <input type="hidden" value="'+product_name+'" name="product_name" class="product_name">\
            //                 <input type="hidden" value='+price+' name="product_price" class="product_price">\
            //             </div> \
            //     </div>\
            //     <div>'+sec+'</div>\
            //     '

            // );

            // $('#variant-total').text(price);
        // }
});




    $('#barcode').on('input', function() {
        var search_item = $(this).val();
        if (search_item){
            var matchedProduct = productData.find(function (product) {
                return product.product_code === search_item;
            });
            if (matchedProduct) {
                if (matchedProduct.stock > 0) {
                    $(this).val('');
                    $('#search_barcode').hide();

                    if (selected_item.includes(matchedProduct.id)) {
                        // Find the table row with the matching product id
                        const $tableRow = $('#table').find("tr[data-id='" + matchedProduct.id + "']");

                        // Increase the quantity by one
                        const $quantityInput = $tableRow.find('.product_qty');
                        const quantityValue = parseInt($quantityInput.val(), 10);

                        if (matchedProduct.stock > quantityValue) {
                            $quantityInput.val(quantityValue + 1);
                        } else {
                            $('#search_barcode').html("<h4 class='mb-3 text-danger'>Not Enough Stock </h4>");
                            $('#search_barcode').show();
                        }


                    } else {
                        $('#table').append(
                            "<tr class='' data-id='" + matchedProduct.id + "' data-stock='" + matchedProduct.stock + "'><th class='px-0 sr'></th>\
            <th overflow:hidden;' class='w-auto'>" + matchedProduct.product_name + "</td>\
            <td ><input type='number' class='product_price form-control text-center' value=" + matchedProduct.selling_price + "></td>\
             <td class='w-auto'><div class='text-center'><div class='input-step step-danger text-center'><button type='button' class='minus'>–</button><input type='number' class='product_qty' value='1'><button type='button' style='background:#42ba96;' class='plus'>+</button></div></div></td>\ <td class='w-auto'><input type='number' class='product_disc form-control ' value='0'></td>\
           <th class='sub_total text-center'></th>\
            <td ><a href='#' data-id=" + matchedProduct.id + " class='remove_btn btn btn-danger btn-sm'>X</td>\
            </tr>"
                        );


                    }


                    subTotal();
                    selected_item.push(matchedProduct.id);
                    console.log(selected_item);
                } else {
                    $('#search_barcode').html("<h4 class='mb-3 text-danger'>This Product is Out Of Stock </h4>");
                    $('#search_barcode').show();

                }
            } else {
                $('#search_barcode').html("<h4 class='mb-3 text-danger'>No Product Found For This Code </h4>");
                $('#search_barcode').show();

            }
        }
    });



// Call the function to load the product data on page load
    loadProductData();


    $('.close').on('click',function(){
        $('.modal').hide();
        $('#finalize_sale').attr('disabled',false).html("Submit");

    });


function subTotal(){
    $('tbody tr').each(function(v,i){
       var price= $(this).find('.product_price').val() ;
       var qty= $(this).find('.product_qty').val() ;
       var disc= $(this).find('.product_discount').val() ;

        var subtotal=price*qty;
        $(this).find('.sub_total').text((subtotal - disc).toFixed(2));

    });
    grandTotal();
}

function grandTotal(){
    var grandTotal=0;
    $('tbody tr').each(function(){

        grandTotal += parseInt($(this).find('.sub_total').text());
    });

    $('#grand_total').text(grandTotal.toFixed(2));
    var disc = $('#product_discount ').val() || 0;
   net_total = grandTotal - disc;
    $('#net_total').text(net_total .toFixed(2));

    $('#modal_total').val( net_total  .toFixed(2));

}




$(document).on('keyup', '.product_price,  .product_qty ,.product_discount', function() {

    var quantity=$(this).closest('td').find('.product_qty').val();
    var $tableRow = $(this).closest('tr');
    var stock = parseInt($tableRow.attr('data-stock'), 10);

    if (stock < quantity) {
        swal.fire("Not Enough Stock");

    }else{
        subTotal();
    }

});


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


                html += '<div class="col-lg-2 col-md-2 " style="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"  >';
                html += '<div class="card ribbon-box border shadow-none">';

                html += '<input type="hidden" class="id" value="' + product.id + '">';
                html += '<input type="hidden" class="name" value="' + product.product_name + '">';
                html += '<input type="hidden" class="price" value="' + product.selling_price + '">';
                html += '<input type="hidden" class="stock" value="' + product.stock + '">';
                html += '<input type="hidden" class="category_id" value="' + product.category_id + '">';
                html += '<div class="card-body">';

                html += '<img src="{{ URL::to('/') }}/img/' + img + '" width="100%" height="50px">';
                html += '</div>';
                html += '<div class="text-center text-primary fs-8 product_name">';
                html += '<p>' + product.product_name + '</p>';
                html += '</div>';
                html += '</div>';

                html += '</div>';


            });
  }
            $('.card-group').html(html);
});


    $('#paying_amount').on('keyup',function(){
        var paying=parseInt($('#paying_amount').val()) || 0;
        var total=parseInt($('#modal_total').val()) || 0;

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
var addon_total_price = 0;
var extra_total_price = 0;
var varriation_total_price = 0;
var tr = 0
function cash(){
        $('tbody tr').each(function(i,v){
            var varData = {};
            var addons = {}
    var extras = {}
            var id=$(this).closest('tr').find('.remove_btn').attr('data-product_id');
            var price=$(this).closest('tr').find('.product_price').val();
           var qty= $(this).closest('tr').find('.product_qty').val();
           var disc= $(this).closest('tr').find('.product_discount').val();
           var net_total= $(this).closest('tr').find('.product_subtotal').text();
        //    varData[i] = [];
            $(this).find('.varriation_detail').each(function(index,value){
              varriation_total_price +=  parseFloat($(this).find('.selected_varriation_price').val());
              varData[index]={
                    'attibute_id':$(this).closest('.varriation_detail').find('.selected_attribute_id').val(),
                    'attribute_name':$(this).closest('.varriation_detail').find('.selected_attribute_name').val(),
                    'varriation_price':$(this).closest('.varriation_detail').find('.selected_varriation_price').val(),
                    'varriation_id':$(this).val(),
                    'varriation_name':$(this).closest('.varriation_detail').find('.selected_varriation_name').val(),
                }


            });

            $(this).closest('tr').find('.addon_detail').each(function(index,value){
               addon_total_price+= parseFloat($(this).closest('.addon_detail').find('.selected_addon_price').val());
                addons[index]={
                    'addon_id':$(this).closest('.addon_detail').find('.selected_addon_id').val(),
                    'addon_name':$(this).closest('.addon_detail').find('.selected_addon_name').val(),
                    'addon_price':$(this).closest('.addon_detail').find('.selected_addon_price').val(),
                }
            });
            $(this).closest('tr').find('.extra_detail').each(function(index,value){
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
        $(this).attr('disabled',true);
        $(this).html('<span class="spinner-border"></span>')
        cash();
    var rowCount = $('tbody tr').length;
    if(rowCount==0){
        Swal.fire("Please select item to sell")
        $('#finalize_sale').html('Submit');
        $(this).attr('disabled',false);

    }else if(submitForm){


        var date=$('#date').val();
        var rem =0;
        var order_type=$('#order_type').val();
        var booker_id=$('#booker_id').val();
        var discout=$('#discount').val();
        var grand_total=$('#grand_total').text();
        var tax=$('#tax').val();
        var change=$('#change').text();
       // var rem=$('#remaining').text();
        var paid=parseInt($('#paying_amount').val()) || 0;
        var desc=$('#sale_desc').val();
        var net_total=parseInt($('#net_total').text());


        if(paid>net_total){



              Swal.fire("Paid Amount is Greater");
              $('#finalize_sale').html('Submit');
        $(this).attr('disabled',false);

              return false;
        }

        if(net_total>paid){
            rem = net_total-paid;

        }

        bill={
        'date':date,
        'booker_id':booker_id,
        'order_type':order_type,
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

                    $('#finalize_sale').html('Submit');
                    $('tbody').html('');
                    $('#finalize_sale').attr('disabled',false);


                    if(data.status=='200'){
						    var invoiceNumber = data.id;
    window.location.href = "{{ route('invoice', ':id') }}".replace(':id', invoiceNumber);

                       // window.location="/sell/gen_invoice/"+data.id;
                            }else if(data.status==404){
                                Swal.fire('record not inserted please check all fields and try again');

                            }else
                            if(data.status==0){
                    Swal.fire('Restorent Time Is End..!');
                }

                            else{
                                Swal.fire('record not inserted please check all fields and try again');
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
$('#add-product').click(function () {
    var item_total_price = $(this).closest('.modal').find('#variant-total').text() || 0;
    var product_id = $(this).closest('.modal').find('.product_id').val();
    var product_name = $(this).closest('.modal').find('.product_name').val();
    var product_price = $(this).closest('.modal').find('.product_price').val();
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

         variantsHtml +="<span class='varriation_detail'><input type='hidden' class='selected_attribute_id' value="+single_attribute_id+" ><input type='hidden' class='selected_attribute_name' value="+attribute_name+" ><input type='hidden' class='selected_varriation_id' value='"+single_variation_id+"'><input type='hidden' class='selected_varriation_name' value='"+single_variation_name+"'><input type='hidden' class='selected_varriation_price' value='"+single_variation_price+"'></span>";


        // Add the variant to the respective attribute in the object

        if (!selectAttributeVariants[attribute_name]) {
            selectAttributeVariants[attribute_name] = [];
        }
        selectAttributeVariants[attribute_name].push(variant_name);
    });

// Build the variantsHtml by iterating over the selectAttributeVariants object


for (var selectAttributeName in selectAttributeVariants) {
    variantsHtml += "<span class=''><input type='hidden' class='selected_attribute_id' value='"+single_attribute_id+"'><input type='hidden' class='selected_attribute_nam' value='"+single_attribute_name+"'><input type='hidden' class='selected_varriant_id' value='"+single_variation_id+"'><input type='hidden' class='selected_varriant_name' value='"+single_variation_name+"'><input type='hidden' class='selected_varriant_price' value='"+single_variation_price+"'>" + selectAttributeName + ": " + selectAttributeVariants[selectAttributeName].join(', ') + "</span><br>";
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

         variantsHtml +="<span class='varriation_detail'><input type='hidden' class='selected_attribute_id' value="+attribute_id+" ><input type='hidden' class='selected_attribute_name' value="+attribute_name+" ><input type='hidden' class='selected_varriation_id' value='"+m_variation_id+"'><input type='hidden' class='selected_varriation_name' value='"+m_variation_name+"'><input type='hidden' class='selected_varriation_price' value='"+m_variation_price+"'></span>";

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

        addon_id = $(this).closest('.col').find('.addon_id_field').val();
        addons_name = $(this).closest('.col').find('.addon_name_field').val();
        addons_price = $(this).closest('.col').find('.addon_price_field').val();
        // Add the variant to the respective attribute in the object
        variantsHtml +="<span class='addon_detail'><input type='hidden' class='selected_addon_id' value='"+addon_id+"' ><input type='hidden' class='selected_addon_name' value='"+addons_name+"' ><input type='hidden' class='selected_addon_price' value='"+addon_price+"'></span>";



        if (!addon[attribute_name]) {
            addon[attribute_name] = [];
        }
        addon[attribute_name].push(addon_name);
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
        extras_id = $(this).closest('.col').find('.extra_id_field').val();
        extras_name = $(this).closest('.col').find('.extra_name_field').val();
        extras_price = $(this).closest('.col').find('.extra_price_field').val();
        // Add the variant to the respective attribute in the object
        // variantsHtml +="<span class='extra_detail'><input type='hidden' class='selected_extra_id' value='"+extras_id+"' ><input type='hidden' class='selected_extra_name' value='"+extras_name+"' ><input type='hidden' class='selected_extra_price' value='"+extras_price+"'></span>";



        if (!extras[attribute_name]) {
            extras[attribute_name] = [];
        }
        extras[attribute_name].push(extra_name);
        variantsHtml +="<span class='extra_detail'><input type='hidden' class='selected_extra_id' value='"+extras_id+"' ><input type='hidden' class='selected_extra_name' value='"+extras_name+"' ><input type='hidden' class='selected_extra_price' value='"+extras_price+"'></span>";
    });

    // Build the variantsHtml by iterating over the attributeVariants object
    for (var attribute_name in extras) {
        variantsHtml += "<span>  "+ attribute_name + "</span>: " + extras[attribute_name].join(', ') + "<br>";
    }


    $('#table').append(
        "<tr class='' data-id='" + product_id + "' >\
        <td overflow:hidden;' class='w-100 ' colspan='3' ><span class='fw-bold'>" + product_name + "</span><br>\
        " + variantsHtml + "</td>\
        <td><input type='number' class='product_price form-control text-center' value=" + item_total_price + "></td>\
        <td class='w-auto'><div class='text-center'><div class='input-step step-danger text-center'><button type='button' class='minus'>–</button><input type='number' class='product_qty' value='1'><button type='button' style='background:#42ba96;' class='plus'>+</button></div></div></td>\
        <td class='w-auto'><input type='number' class='product_discount form-control ' value='0'></td>\
        <th class='sub_total product_subtotal text-center'>"+item_total_price+"</th>\
        <td ><a href='#' data-product_id=" + product_id + " class='remove_btn btn btn-danger btn-sm'>X</td>\
        </tr>"
    );
    grandTotal();

    var total_item = $('#table tr').length;

});







function loadProducts(page,category_id) {

$.ajax({

        url: '{{ url("sell/products?page=") }}' + page,
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


            html += '<div id="" class="col-lg-2 col-md-2 card-product'+product.id+'" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"  >';
            html += '<div class="card ribbon-box border shadow-none">';

            html += '<input type="hidden" class="id" value="' + product.id + '">';
            html += '<input type="hidden" class="name" value="' + product.product_name + '">';
            html += '<input type="hidden" class="price" value="' + product.selling_price + '">';
            html += '<input type="hidden" class="stock" value="' + product.stock + '">';
            html += '<input type="hidden" class="category_id" value="' + product.category_id + '">';

            html += '<input type="hidden" class="image-path" value="'+img+'" >';
            html += '<div class="card-body">';
            html += '<img src="{{ URL::to('/') }}/img/' + img + '" width="100%" height="50px">';
            html += '</div>';
            html += '<div class="text-center text-primary fs-8 product_name">';
            html += '<p>' + product.product_name + '</p>';
            html += '</div>';
            html += '</div>';

            html += '</div>';



        });

        $('.card-group').html(html);



        // Display pagination buttons
        var totalPages = response.total_pages;
        var totalEntries = response.total_entries;
        var paginationHtml = '<hr>';

        // Calculate the range of pages to display
        var startPage = Math.max(1, page - 3);
        var endPage = Math.min(totalPages, startPage + 4);


        paginationHtml += '<div class="col-md-12 text-center">';
        paginationHtml += 'Total Entries: ' + totalEntries + ' | ';
        paginationHtml += 'Page ' + page + ' of ' + totalPages;
        paginationHtml += '<br>';

        paginationHtml += '<nav aria-label="..." class="mt-2 ">';
        paginationHtml += '<ul class="pagination justify-content-center">';
        if (page > 1) {
            paginationHtml += ' <li class="page-item"><button  class="page-link pagination-btn" data-page="' + (page - 1) + '"> <i class="mdi mdi-chevron-left"></i> Prev </button></li>';
        }
        for (var i = startPage; i <= endPage; i++) {
            var active = (page == i) ? "active btn btn-primary" : "btn btn-secondary";
            paginationHtml += '<li class="page-item"><button class="page-link pagination-btn ' + active + '" data-page="' + i + '">' + i + '</button></li>';
        }
        if (page < totalPages) {
            paginationHtml += '<li class="page-item"><button area-label="Next" class="page-link pagination-btn" data-page="' + (page + 1) + '">  Next <i class="mdi mdi-chevron-right"></i>  </button></li>';
        }
        paginationHtml += '</ul>';
        paginationHtml += '</nav>';
        paginationHtml += '</div>';

        $('.pagination').html(paginationHtml);

    }
});





}
});

</script>

</html>
<style>
    .selected-variants-container {
    background-color:#405189;
    color: white;
}
</style>