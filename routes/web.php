<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AddonController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BookerPayment;
use App\Http\Controllers\BookerPaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemAddonController;
use App\Http\Controllers\ItemAttributeController;
use App\Http\Controllers\ItemExtrasController;
use App\Http\Controllers\OrderBookerController;
use App\Http\Controllers\OrderBookerController\OrderBookerHomeController;
use App\Http\Controllers\OrderBookerController\OrderController;
use App\Http\Controllers\OrderBookerController\OrderReportController;
use App\Http\Controllers\OrderBookerController\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductSettingController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellReturnController;
use App\Http\Controllers\SetingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierPaymentController;

use App\Http\Controllers\TaxController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VariantController;

use App\Http\Controllers\warehouseController;
use App\Models\OrderBooker;
use App\Models\pos_seting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::group(['middleware' => 'auth'], function () {


    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // dashboar
    Route::GET('/dashboard', [DashboardController::class, 'getData'])->name('dashboard.period');



    Route::POST('update_account_status/{id}', [AccountsController::class, 'update_account_status'])->name('update_account_status');


    // sale route
    Route::GET('/sell', [SaleController::class, 'index']);
    Route::GET('/sell/create', [SaleController::class, 'create']);
    Route::GET('/sell/get-product', [SaleController::class, 'get_product']);
    Route::GET('/sell/product_detail/{product_id}', [SaleController::class, 'product_detail']);
    Route::POST('/sell/store', [SaleController::class, 'store']);
    Route::GET('sell/list', [SaleController::class, 'salelist']);
    Route::GET('sell/bill_detail', [SaleController::class, 'sale_detail']);
    Route::GET('payment/gen_invoice/{invoice_id}', [CustomerPaymentController::class, 'invoice'])->name('payment.invoice');
    Route::POST('payment/gen_invoice/', [CustomerPaymentController::class, 'invoice'])->name('get.payment.customer');

    Route::GET('sell/gen_invoice/{invoice_id}', [SaleController::class, 'show'])->name('invoice');

    Route::GET('purchase/gen_invoice/{invoice_id}', [PurchaseController::class, 'show'])->name('purchase.invoice');
    Route::GET('/sell/edit/{bill_id}', [SaleController::class, 'edit']);
    Route::post('/sell/update', [SaleController::class, 'update']);
    Route::DELETE('/sell/destroy/{bill_id}', [SaleController::class, 'destroy'])->name('sell.destroy');
    Route::POST('/bill/delete/{id}', [SaleController::class, 'delete'])->name('bill.delete');
    // sale route end

    Route::get('get_sale_list', [SaleController::class, 'get_sale_list'])->name('get_sale_list');

    Route::get('view_sale_list', [SaleController::class, 'view_sale_list'])->name('view_sale_list');


    Route::GET('/home/orders',[HomeController::class,'homeorders'])->name('home.orders');




    // pos rout
    Route::GET('/sell/pos', [PosController::class, 'index'])->name('pos');
    Route::POST('/pos/item', [PosController::class, 'show']);
    Route::GET('/pos/search_item', [PosController::class, 'get_search']);
    Route::POST('/pos/addSale', [PosController::class, 'addSale']);
    Route::POST('/pos/updateSale/', [PosController::class, 'updateSale']);
    Route::get('/sell/products', [PosController::class, 'products']);
    Route::post('/sell/products/barcode', [PosController::class, 'barcode_product'])->name('get.product.barcode');
    Route::post('/sell/pos/add-customer', [PosController::class, 'add_customer']);



    // order booker
    Route::resource('order-booker', OrderBookerController::class);

    // report routes
    Route::controller(ReportController::class)->group(function () {

        // order booker report

        Route::GET('report/summary-report','summary_report')->name('summary_report');
        Route::GET('report/view/summary-report','get_summary_report')->name('get_summary_report');
        Route::GET('report/daily',[ReportController::class,'dateReport'])->name('sell_report');

        // Route::GET('report/daily-report','summary_report')->name('daily_report');
        // Route::GET('report/monthly-report','summary_report')->name('monthly_report');

        // Route::GET('report/order-booker','orderBookerReport');

        // Route::GET('report/all/order-booker','getBookerReport')->name('booker.get.report');

    });



    // report route end

    // expense
    Route::GET('Expense', [ExpenseController::class, 'index'])->name('expense.list');
    Route::GET('Expense/Add', [ExpenseController::class, 'create'])->name('expense.create');
    Route::Post('Expense/Add', [ExpenseController::class, 'store']);
    Route::GET('Expense/{expense_id}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::PUT('Expense/{expense_id}/update', [ExpenseController::class, 'update'])->name('expense.update');
    Route::GET('Expense/{expense_id}/destory', [ExpenseController::class, 'destory']);

    // expense end
    //supplier Payment
    Route::resource('supplier_payment', SupplierPaymentController::class);
    Route::get('supplier-ledger/{id}', [SupplierPaymentController::class, 'invoice'])->name('supplier_payment.invoice');
    // Route::POST('supplier-payment',[SupplierPaymentController::class,'invoice'])->name('get.payment');

    Route::get('get_supplier_ledger_invoices/{id}/{startDate}/{endDate}', [SupplierPaymentController::class, 'get_supplier_ledger_invoices'])->name('get_supplier_ledger_invoices');
    Route::get('get_supplier_ledger_payments/{id}/{startDate}/{endDate}', [SupplierPaymentController::class, 'get_supplier_ledger_payments'])->name('get_supplier_ledger_payments');
    Route::get('print_supplier_ledger/{id}', [SupplierPaymentController::class, 'print_supplier_report'])->name('print_supplier_report');

    // supplier legder end
    // customer legder
    Route::get('get_customer_ledger_invoices/{id}/{startDate}/{endDate}', [CustomerPaymentController::class, 'get_customer_ledger_invoices'])->name('get_customer_ledger_invoices');
    Route::get('get_customer_ledger_payments/{id}/{startDate}/{endDate}', [CustomerPaymentController::class, 'get_customer_ledger_payments'])->name('get_customer_ledger_payments');
    Route::get('print_customer_ledger/{id}/{startDate}/{endDate}', [CustomerPaymentController::class, 'print_customer_report'])->name('print_customer_report');
    Route::get('print_customer_ledger/{id}', [CustomerPaymentController::class, 'print_customer_report'])->name('print_customer_report');


    Route::resource('suppliers', SupplierController::class);


    //customers Payment
    Route::resource('customer_payment', CustomerPaymentController::class);

    Route::resource('customers', CustomerController::class);


    Route::resource('product', ProductController::class);
    Route::get('products/barcode', [ProductController::class, 'bar_code'])->name('product.barcode.view');
    Route::get('products/get_list', [ProductController::class, 'get_list'])->name('get.product.list');
    Route::get('/products/barcode/item', [ProductController::class, 'getItem'])->name('get_item');
    Route::post('/products/barcode/print', [ProductController::class, 'generate_barcode'])->name('generate_barcode');
    Route::GET('/products/detail/{id}', [ProductController::class, 'product_detail'])->name('product.detail');
    Route::resource('account', AccountsController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('warehouse', warehouseController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('currency', CurrencyController::class);
    Route::resource('product-setting', ProductSettingController::class);
    Route::resource('variant', VariantController::class);

    Route::resource('payment', PaymentController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('item-variantion', ItemAttributeController::class);
    Route::resource('item-extras', ItemExtrasController::class);
    Route::resource('addons', AddonController::class);
    Route::resource('item-addons', ItemAddonController::class);
    Route::resource('setings', SetingController::class);

    // order bookers
    Route::GET('/orderbookers/payment',[BookerPaymentController::class,'index'])->name('orderbookers.payment.index');
    Route::GET('/orderbookers/payment/create',[BookerPaymentController::class,'create'])->name('orderbookers.payment.create');
    Route::GET('/orderbookers/payment/edit/{id}',[BookerPaymentController::class,'edit'])->name('ordersbookers.payment.edit');
    Route::GET('/orderbookers/payment/getPayment',[BookerPaymentController::class,'getPayment'])->name('orderbookers.payment.get');
    Route::POST('/orderbookers/payment/store',[BookerPaymentController::class,'store'])->name('orderbookers.payment.store');
    Route::PUT('/orderbookers/payment/update/{id}',[BookerPaymentController::class,'update'])->name('orderbookers.payment.update');
    Route::DELETE('/orderbookers/payment/destroy/{id}',[BookerPaymentController::class,'destroy'])->name('orderbookers.payment.destroy');

});


// order booker routes


Route::group(['prefix' => 'order-bookers','middleware'=>'order-booker.guest'], function () {
    Route::view('/login', 'order-booker-pannel.auth.login')->name('order-booker.login');
    Route::post('/login', [App\Http\Controllers\OrderBookerController\Auth\LoginController::class, 'login'])->name('order-booker.auth');
});
Route::group(['middleware' => 'order-booker.auth','prefix'=>'order-bookers'], function () {
    Route::GET('/', [OrderBookerHomeController::class, 'index'])->name('order-booker.dashboard');
    Route::GET('/pos/search_item', [PosController::class, 'get_search']);
    Route::get('/sell/products', [PosController::class, 'products']);
    Route::POST('/order',[OrderController::class,'store']);
    Route::GET('/my-orders',[OrderController::class,'index'])->name('order-booker.order.index');
    Route::GET('/delevered-orders',[OrderController::class,'order_delevered'])->name('order-booker.delevered.order');
    Route::GET('/order/reports',[OrderReportController::class,'report'])->name('order-booker.order.report');
    Route::POST('/order/report/print',[OrderReportController::class,'get_report'])->name('order-booker.order.get.report');
    Route::GET('/user/profile',[ProfileController::class,'index'])->name('order-booker.profile');
    Route::PUT('/user/profile/update/{id}',[ProfileController::class,'update'])->name('order-booker.profile.update');
    Route::get('/order/to-day',[OrderController::class,'toDaysOrder'])->name('order-booker.today.order');
    Route::get('/order/complete-order',[OrderController::class,'completeOrders'])->name('order-booker.complete.order');
    // payments routes

    Route::get('get_sale_list', [OrderController::class, 'get_sale_list'])->name('get_order_sale_list');

    Route::POST('logout',[App\Http\Controllers\OrderBookerController\Auth\LoginController::class,'logout'])->name('booker.logout');
});
Route::GET('order-bookers/order/invoice/{id}',[OrderController::class,'invoice'])->name('order.booker.invoice');


// kitchen
Route::group(['prefix' => 'kitchen', 'middleware' => 'kitchen.guest'], function () {
    Route::view('/login', 'kitchen-pannel.auth.login')->name('kitchen.login');
    Route::POST('/login', [App\Http\Controllers\KitchenUserController\auth\LoginController::class, 'login'])->name('kitchen.login.auth');

});
Route::group(['middleware' => 'kitchen.auth','prefix'=>'kitchen'], function () {
        Route::GET('/', [App\Http\Controllers\KitchenUserController\KitchenHomeController::class, 'index'])->name('kitchen.home');
        Route::GET('/orders',[App\Http\Controllers\KitchenUserController\KitchenHomeController::class, 'newOrder'])->name('kitchen.order');
        Route::GET('/complete/orders',[App\Http\Controllers\KitchenUserController\KitchenHomeController::class, 'completeOrders'])->name('kitchen.order.complete');
        Route::GET('/order/status/{id}&{status}',[App\Http\Controllers\KitchenUserController\KitchenHomeController::class, 'orderStatus'])->name('kitchen.order.status');
        Route::POST('/logout',[App\Http\Controllers\KitchenUserController\auth\LoginController::class, 'logout'])->name('kitchen.logout');
});

