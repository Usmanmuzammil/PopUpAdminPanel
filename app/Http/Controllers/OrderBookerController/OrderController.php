<?php

namespace App\Http\Controllers\OrderBookerController;

use App\Events\OrderAlert;
use App\Http\Controllers\Controller;
use App\Models\pos_seting;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\OrderBooker;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;

class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $bills = Bill::where('booker_id', $user->id)->where('kitchen_status', 'pending')->where('panel',0)->orWhere('kitchen_status', 'ready')->orderBY('id', 'desc')->get();

        return view('order-booker-pannel.order.index', compact('bills'));
    }



    public function store(Request $req)
    {
        $user = Auth::user();

        $booker = new OrderBooker();
        try {

            // if( pos_seting::where('created_at','<',date('Y-m-d H:i:s'))->where('closing_date','>',date('Y-m-d H:i:s'))->count() == 0 ){

            //     return response()->json(['status'=>0]);

            //     }
               $pos_seting = pos_seting::latest('id')->first();


                $date = [$pos_seting->created_at,$pos_seting->closing_date];



             $check =  Bill::where('booker_id', $user->id)->where('created_at','>=',$pos_seting->created_at)->where('created_at','<=', $pos_seting->closing_date)->where('kitchen_status', 'pending')->get();
            if ($check->count() >= 5) {
                return response()->json(['status' => 2, 'message' => 'Order limite is full...!']);
            } else if ($booker->getBalance($user->id,$date)  >= 10000) {
                return response()->json(['status' => 2, 'message' => 'Your cash limit is full..!']);
            }

            // return $req->all();

            $user_id = Auth::user()->id;
            $date = date('Y-m-d');


            $bill_id = 0;
            $bill = new Bill();
            $bill->date = $date;
            $bill->order_type = $req->bill['order_type'] ?? 0;
            $bill->booker_id =  $user_id;
            $bill->user_id = $user_id;
            $bill->name = $req->bill['customer_name'];
            $bill->discount = 0;

            $bill->total = $req->bill['grand_total'];
            $bill->paid_amount = $req->bill['grand_total'];
            $bill->remaining = 0;
            $status = 1;
            $bill->bill_type = "sell";
            $bill->bill_status = 1;
            $bill->change = 0;
            $bill->desc = 0;
            $bill->net_total = $req->bill['grand_total'];
            $bill->on_hold = ($req->bill['order_type'] == 'dining') ? "1" : "0";
            $bill->panel = 0;
            $save = $bill->save();
            $bill_id = $bill->id;

            if ($save) {

                $save_bill_detail = "";

                foreach ($req->bill_detail as $key => $value) {
                    $bill_details = new Bill_detail();

                    $bill_details->bill_id = $bill_id;
                    $bill_details->product_id = $value['item_id'];
                    $bill_details->varriantion = json_encode($value['varriants'] ?? "");
                    $bill_details->extras = json_encode($value['extra'] ?? "");
                    $bill_details->addons = json_encode($value['addons'] ?? "");
                    $bill_details->variant_price = $value['varriation_total_price'] ?? 0;
                    $bill_details->extras_price = $value['extra_total_price'] ?? 0;
                    $bill_details->addons_price = $value['addon_total_price'] ?? 0;
                    $bill_details->qty = $value['item_qty'];
                    $bill_details->price = $value['item_price'];
                    $bill_details->total =  $value['item_price'] * $value['item_qty'];
                    $bill_details->discount =  0;
                    $bill_details->net_total = $value['net_total'];
                    $save_bill_detail = $bill_details->save();
                }


                if ($save_bill_detail) {
                    event(new OrderAlert('New Order Revieved..!', 'my-channel', 'my-event'));
                    return response()->json(['status' => '200', 'id' => $bill_id]);
                }
            }
        } catch (Exception $ex) {
            return response()->json(['status' => '0', 'message' => $ex->getMessage()]);
        }
    }


    // public function store(Request $req)
    // {
    //     $user = Auth::user();

    //     $booker = new OrderBooker();
    //     try {

    //         if( pos_seting::where('created_at','<',date('Y-m-d H:i:s'))->where('closing_date','>',date('Y-m-d H:i:s'))->count() == 0 ){

    //             return response()->json(['status'=>0]);

    //             }


    //         $check =  Bill::where('booker_id', $user->id)->where('date', date('Y-m-d'))->where('kitchen_status', 'pending')->get();
    //         if ($check->count() >= 5) {
    //             return response()->json(['status' => 2, 'message' => 'Order limite is full...!']);
    //         } else if ($booker->getBalance($user->id, date('Y-m-d'))  >= 10000) {
    //             return response()->json(['status' => 2, 'message' => 'Your cash limit is full..!']);
    //         }

    //         // return $req->all();

    //         $user_id = Auth::user()->id;
    //         $date = date('Y-m-d');


    //         $bill_id = 0;
    //         $bill = new Bill();
    //         $bill->date = $date;
    //         $bill->order_type = $req->bill['order_type'] ?? 0;
    //         $bill->booker_id =  $user_id;
    //         $bill->user_id = $user_id;
    //         $bill->name = $req->bill['customer_name'];
    //         $bill->discount = 0;

    //         $bill->total = $req->bill['grand_total'];
    //         $bill->paid_amount = $req->bill['grand_total'];
    //         $bill->remaining = 0;
    //         $status = 1;
    //         $bill->bill_type = "sell";
    //         $bill->bill_status = 1;
    //         $bill->change = 0;
    //         $bill->desc = 0;
    //         $bill->net_total = $req->bill['grand_total'];
    //         $bill->on_hold = ($req->bill['order_type'] == 'dining') ? "1" : "0";
    //         $bill->panel = 0;
    //         $save = $bill->save();
    //         $bill_id = $bill->id;

    //         if ($save) {

    //             $save_bill_detail = "";

    //             foreach ($req->bill_detail as $key => $value) {
    //                 $bill_details = new Bill_detail();

    //                 $bill_details->bill_id = $bill_id;
    //                 $bill_details->product_id = $value['item_id'];
    //                 $bill_details->varriantion = json_encode($value['varriants'] ?? "");
    //                 $bill_details->extras = json_encode($value['extra'] ?? "");
    //                 $bill_details->addons = json_encode($value['addons'] ?? "");
    //                 $bill_details->variant_price = $value['varriation_total_price'] ?? 0;
    //                 $bill_details->extras_price = $value['extra_total_price'] ?? 0;
    //                 $bill_details->addons_price = $value['addon_total_price'] ?? 0;
    //                 $bill_details->qty = $value['item_qty'];
    //                 $bill_details->price = $value['item_price'];
    //                 $bill_details->total =  $value['item_price'] * $value['item_qty'];
    //                 $bill_details->discount =  0;
    //                 $bill_details->net_total = $value['net_total'];
    //                 $save_bill_detail = $bill_details->save();
    //             }


    //             if ($save_bill_detail) {
    //                 event(new OrderAlert('New Order Revieved..!', 'my-channel', 'my-event'));
    //                 return response()->json(['status' => '200', 'id' => $bill_id]);
    //             }
    //         }
    //     } catch (Exception $ex) {
    //         return response()->json(['status' => '0', 'message' => $ex->getMessage()]);
    //     }
    // }


    public function invoice($id)
    {
        $bill_detail = Bill_detail::where('bill_id', $id)->get();
        $billData = Bill::with('getBillDetail')->where('id', $id)->first();



        $result = [
            'id' => $billData->id,
            'name' => $billData->name,
            'number' => $billData->phone,
            'date' => $billData->date,
            'order_type' => $billData->order_type,
            'booker_id' => $billData->booker_id,
            'user_id' => $billData->user_id,
            'total' => $billData->total,
            'discount' => $billData->discount,
            'net_total' => $billData->net_total,
            'paid_amount' => $billData->paid_amount,
            'remaining' => $billData->remaining,
            'bill_type' => $billData->bill_type,
            'bill_status' => $billData->bill_status,
            'change' => $billData->change,
            'desc' => $billData->desc,
            'kitchen_status' => $billData->kitchen_status,
            'created_at' => $billData->created_at,
            'get_bill_detail' => $billData->getBillDetail->map(function ($detail) {
        $bd =new Bill_detail();

       return $response = [
                    'id' => $detail->id,
                    'bill_id' => $detail->bill_id,
                    'product_name' => $detail->getProduct->product_name, // Assuming 'product_name' is the name column in your 'Product' model
                    'qty' => $detail->qty,
                    'variants' =>  ($detail->getVariants()== "" )?[]:$detail->getVariants(),
                    'extras' =>  ($detail->getExtras()== "" )?[]:$detail->getExtras(),
                    'addons' => ($detail->getAddons()== "")?[]:$detail->getAddons(),
                    'price' => $detail->price,
                    'total' => $detail->total,
                    'discount' => $detail->discount,
                    'net_total' => $detail->net_total,
                    'created_at' => $detail->created_at,

                ];

            }),
        ];
        // return view('order-booker-pannel.test',compact('result'));






    //     $bill = DB::table('bills')
    // ->select(
    //     'bills.id',
    //     'bills.name',
    //     'bills.total',
    //     'bill_details.bill_id',
    //     'products.product_name',
    //     'bill_details.product_id as product'
    // )
    // ->join('bill_details', 'bills.id', '=', 'bill_details.bill_id')
    // ->join('products', 'bill_details.product_id', '=', 'products.id')
    // ->where('bills.id', $id)
    // ->get();


        return response()->json($result);



        $bill = Bill::where('id', $id)->first();







        $barcode = "<span>" . DNS1D::getBarcodeHTML("Bill No:" . $id, 'C128') . "</span>";
        return view('order-booker-pannel.order.invoice', ['bill_detail' => $bill_detail, 'bill' => $bill, 'barcode' => $barcode]);
    }

    public function order_delevered()
    {
        $orders = Bill::where('kitchen_status', 'delevered')->get();
        return view('order-booker-pannel.order.complete-orders', compact('orders'));
    }




    public function toDaysOrder()
    {
        $pos_seting = pos_seting::where('date',date('Y-m-d'))->latest()->first();


        $currentDate = Carbon::now();
        $previousDate = $currentDate->copy()->subDay();

        $user = Auth::user();

        $bills = Bill::where('booker_id', $user->id)->where('created_at','>=',$pos_seting->created_at)->where('created_at','<=',$pos_seting->closing_date)->where('panel',0)->where('kitchen_status', 'pending')->orWhere('kitchen_status', 'ready')->orderBY('id', 'desc')->get();
        $complete_orders = Bill::where('booker_id', $user->id)->where('kitchen_status', 'delevered')->orderBY('id', 'desc')->get();
        $html = '';
        if (count($bills) == 0) {
            $html .= ' <div class="col alert text-white alert-info">No Order Added Yet</div>';
        }

        foreach ($bills as $key => $bill) {
            $status = 'info';
            if ($bill->kitchen_status == 'pending') {
                $status = 'danger';
            }
            $html .= '
                    <div class="col-12  my-2 sborder rounded shadow-lg  ">
                        <div class="row">
                            <div class="my-2">
                                <span class="badge bg-primary">' . $key + 1 . ' </span>
                            </div>
                            <div class="col-6">
                                <div class="dz-content">
                                        <h6 class="title"><a href="javascript:void(0)">| ' . ucfirst($bill->name) . '</a></h6>
                                        <span class="price">Total : ' . $bill->net_total . '</span>
                                </div>
                            </div>
                             <div class="col-md-4 text-end ">
                                    <div class="">
                                        <a href="" data-bs-toggle="offcanvas" data-bs-target="#' . $bill->id . '" aria-controls="offcanvasRight">View Order</a>
                                              <p class="">
                                                    <span>Order Status : <span class="badge bg-' . $status . '">' . ucfirst($bill->kitchen_status)  . '</span></span>
                                                </p>
                                        </a>
                                        <hr>
                                         <a href="' . route('order.booker.invoice', $bill->id) . '" class="float-start">Print <i class="fa fa-print "></i><a/>
                                        <span class="timer timer_' . $bill->id . '" data-bill-id="' . $bill->id . '">00:00</span>
                                     </div>

                             </div>


                        </div>
                    </div>

                    ';
        }

        foreach ($bills as $key => $v) {
            $html .= '
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="' . $v->id . '"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Order Detail</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close">X</button>
                        </div>
                        <div class="offcanvas-body">';


            foreach ($v->getBillDetail as $key => $bill_d) {
                $html .= '
                            <div class="card p-2 shadow-lg border-primary">

                                <div class="row">
                                    <div class="col-12">


                                        <h6 class="text-primary">' . Str::ucfirst($bill_d->getproduct->product_name) . '
                                        </h6>
                                ';

                $html .= $bill_d->displayVariants($bill_d->displayVariants());
                $html .= $bill_d->displayExtras($bill_d->displayExtras()) . "<br>";
                $html .= $bill_d->displayAddons($bill_d->displayAddons());
                $html .= '
                                    </div>
                                    <div class="col-12">


                                        <label for="" class="text-primary"> Rs &nbsp;</label><b class="text-primary">' .
                    $bill_d->price . 'X



                                            ' . $bill_d->qty . '
                                        </b>
                                        <br>
                                        <span class="float-end border-primary">

                                            <label for="" class="text-primary">Total :</label>
                                            <b class="text-primary">' . $bill_d->net_total . '</b>
                                        </span>


                                    </div>

                                </div>

                            </div>

                            ';
            }

            $html .= '
                            <div class="row border-primary">
                                <div class="col text-end text-primary bg-white shadow-lg py-3">
                                    Total : ' . $bills->sum('net_total') . '
                                </div>
                            </div>

                        </div>
                    </div>
                    ';
        }


        $total_order = $bills->count();
        $complete_orders = $complete_orders->count();

        return [$total_order, $html, $complete_orders];
    }

    public function completeOrders()
    {
        $user = Auth::user();

        $bills = Bill::where('booker_id', $user->id)->where('panel',0)->where('kitchen_status', 'delevered')->orderBY('id', 'desc')->get();



        $html = '';

        if (count($bills) == 0) {
            $html .= ' <div class="col alert text-white alert-info">No Order Added Yet</div>';
        }

        foreach ($bills as $key => $bill) {
            $status = 'info';
            if ($bill->kitchen_status == 'delevered') {
                $status = 'success';
            }
            $html .= '
                     <div class="col-12  border pt-4 rounded shadow-lg my-2 ">
                     <div class="row">
                         <div class="col-1">
                             <span class="badge bg-primary">' . $key + 1 . ' </span>
                         </div>
                         <div class="col-6">

                             <div class="dz-content">
                                 <h6 class="title"><a href="javascript:void(0)">| ' . ucfirst($bill->name) . '</a></h6>
                                 <span class="price">Total : ' . $bill->net_total . '</span>
                             </div>
                         </div>
                         <div class="col-md-4 text-end ">




                             <div class="">

                                 <a href="" data-bs-toggle="offcanvas" data-bs-target="#' . $bill->id . '" aria-controls="offcanvasRight">View Order</a>

                                 <p class="">
                                     <span>Order Status : <span class="badge bg-' . $status . '">' . ucfirst($bill->kitchen_status)  . '</span></span>

                                 </p>
                             </div>

                             <hr>
                             <a href="' . route('order.booker.invoice', $bill->id) . '" class="float-start">Print <i class="fa fa-print "></i><a/>


                         </div>

                     </div>



                 </div>
                     ';
        }

        foreach ($bills as $key => $v) {
            $html .= '
                     <div class="offcanvas offcanvas-end" tabindex="-1" id="' . $v->id . '"
                         aria-labelledby="offcanvasRightLabel">
                         <div class="offcanvas-header">
                             <h5 id="offcanvasRightLabel">Order Detail</h5>
                             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                 aria-label="Close">X</button>
                         </div>
                         <div class="offcanvas-body">';


            foreach ($v->getBillDetail as $key => $bill_d) {
                $html .= '
                             <div class="card p-2 shadow-lg border-primary">

                                 <div class="row">
                                     <div class="col-12">


                                         <h6 class="text-primary">' . Str::ucfirst($bill_d->getproduct->product_name) . '
                                         </h6>
                                 ';

                $html .= $bill_d->displayVariants($bill_d->displayVariants());
                $html .= $bill_d->displayExtras($bill_d->displayExtras()) . "<br>";
                $html .= $bill_d->displayAddons($bill_d->displayAddons());
                $html .= '
                                     </div>
                                     <div class="col-12">


                                         <label for="" class="text-primary"> Rs &nbsp;</label><b class="text-primary">' .
                    $bill_d->price . 'X



                                             ' . $bill_d->qty . '
                                         </b>
                                         <br>
                                         <span class="float-end border-primary">

                                             <label for="" class="text-primary">Total :</label>
                                             <b class="text-primary">' . $bill_d->net_total . '</b>
                                         </span>


                                     </div>

                                 </div>

                             </div>

                             ';
            }

            $html .= '
                             <div class="row border-primary">
                                 <div class="col text-end text-primary bg-white shadow-lg py-3">
                                     Total : ' . $bills->sum('net_total') . '
                                 </div>
                             </div>

                         </div>
                     </div>
                     ';
        }


        $total_order = $bills->count();

        return [$total_order, $html];
    }
    
 public function get_sale_list(){
        $id = Auth::guard('bookers')->user()->id;

        $bills =  Bill::with('getBooker')->select('id','booker_id','order_type','date','total','discount','net_total','paid_amount','remaining','bill_status')
        ->where('bill_type','sell')
        ->where('booker_id',$id)
        ->limit(100)
        ->orderBy('id','desc');
             return  datatables($bills)
             ->addColumn('booker_name', function ($bills) {
                 return $bills->getBooker->name;
             })->addColumn('bill_status', function ($bills) {
     $status = $bills->bill_status == 1 ? "Paid" : "Unpaid";
     $badgeClass = $bills->bill_status == 1 ? "success" : "warning";
     return '<span class="badge bg-'.$badgeClass.'">'.$status.'</span>';
 })->rawColumns(['bill_status','booker_name'])
 ->make(true);
     }
}
