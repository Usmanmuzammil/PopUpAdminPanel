<?php

namespace App\Http\Controllers\KitchenUserController;

use App\Events\OrderAlert;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KitchenHomeController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');

        $orders =   Bill::where('kitchen_status', 'ready')->where('date', $date)->orderBy('id', 'desc')->get();


        return view('kitchen-pannel.index', compact('orders'));
    }


    public function newOrder()
{
    $date = date('Y-m-d');
    $currentDate = Carbon::now();
    $previousDate = $currentDate->copy()->subDay();

    $orders = Bill::where(function ($query) use ($date) {
        $query->where('kitchen_status', 'pending')
              ->orWhere('kitchen_status', 'ready');
    })
    ->orderByRaw("CASE WHEN kitchen_status = 'pending' THEN 0 ELSE 1 END, id ASC")
    ->get();

    $html = "";
    foreach ($orders as $key => $order) {
        $createdAt = $order->created_at;

        // Format the time as a string
        $createdAtString = $createdAt->toTimeString();

        $badge = ($order->kitchen_status == 'pending') ? "badge bg-danger" : "badge bg-info";

        $type = "";
        if ($order->order_type == 'dine-in') {
            $type = '<span><i class="ri-wheelchair-fill h3 bg-primary px-2 text-white rounded "></i><br><b>Dine-in</b></span>';
        } elseif ($order->order_type == 'delivery') {
            $type = '<span><i class="ri-takeaway-fill h3 bg-primary px-2 text-white rounded"></i><br><b>Delivery</b></span>';
        } elseif ($order->order_type == 'car-dine-in') {
            $type = '<span><i class="ri-roadster-fill h3 bg-primary px-2 text-white rounded"></i><br><b>Car Dine-in</b></span>';
        } elseif ($order->order_type == 'take-away') {
            $type = '<span><i class="ri-shopping-bag-line h3 px-2 bg-primary text-white rounded"></i><br><b>Take Away</b></span>';
        }

        $html .= '
            <div class="col-4">
                <div class="card rounded shadow-lg border pending">
                    <input type="hidden" value="' . $createdAtString . '" class="order_time">
                    <div class="card-header text-center">
                        <h2 class="text-primary">' . $order->id . '</h2>
                        <div class="d-flex justify-content-between">
                            <h4>By: ' . Str::ucfirst($order->getBooker->name) . '</h4>
                            <div>
                            <a class="p-2 ' . $badge . '" href="' . route("kitchen.order.status", ['id' => $order->id, 'status' => $order->kitchen_status]) . '">Order ' . $order->kitchen_status . '</a>
                            <a href="'. route('invoice',$order->id) .'" class="p-1 btn btn-warning btn-sm float-end rounded">Print</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>Items</h4>
                            ' . $type . '
                        </div>
                        <ul class="fw-bold">
        ';

        foreach ($order->getBillDetail as $bd) {
            $html .= '
                            <li>
                                <h4> ('.$bd->qty.') '  . Str::ucfirst($bd->getProduct->product_name) . '</h4>
                                ' . $bd->displayVariants() . '
                                ' . $bd->displayExtras() . '
                                ' . $bd->displayAddons() . '
                            </li>
            ';
        }

        $html .= '
                        </ul>
                    </div>
                </div>
            </div>
        ';
    }

    return $html;
}


    public function completeOrders()
    {

        $date = date('Y-m-d');

        $orders =  Bill::where('kitchen_status', 'delevered')->where('date', $date)->Orwhere('date','<',$date)->orderBy('id', 'desc')->get();


        $html = "";
        foreach ($orders as $key => $order) {
            $type = "";
            if ($order->order_type == 'dining') {
                $type = '<i class="  ri-wheelchair-fill"></i>';
            } else if ($order->order_type == 'delevery') {
                $type = '<i class="  ri-takeaway-fill"></i>';
            } else if ($order->order_type == 'car_dinning') {
                $type = '<i class="ri-roadster-fill"></i>';
            } else if ($order->order_type == 'take_away') {
                $type = '<i class=" ri-shopping-bag-line"></i>';
            }

            $html .= '
            <div class="col-4">
                <div class="card rounded shadow-lg border">
                    <div class="card-header text-center">
                        <!-- ... (your existing code for card header) -->
                    </div>
                    <div class="card-body">
                        <h4>Items</h4>
                        <ol class="fw-bold">';

        foreach ($order->getBillDetail as $bd) {
            $html .= '<li><h4>' . Str::ucfirst($bd->getProduct->product_name) . '</h4>';

            $html .= $bd->displayVariants();
            $html .= $bd->displayExtras();
            $html .= $bd->displayAddons();

            $html .= '</li>';
        }

        $html .= '
                        </ol>
                    </div>
                </div>
            </div>';
    }


        return $html;
    }

    public function orderStatus($id, $status)
    {
        try {
            $bill = Bill::find($id);
            $booker_id =  $bill->booker_id;
            $arr[0] = $booker_id;
            if ($status == 'pending') {
            //     $status = 'ready';
            //     $arr[1] = ucfirst($bill->name) . '\'s order is ready';
            //     event(new OrderAlert($arr, 'order-booker-channel', 'order-booker-event'));
            // } else if ($status == 'ready') {
                $status = 'delevered';
                $arr[1] = ucfirst($bill->name) . '\'s order is delevered';

                event(new OrderAlert($arr, 'order-booker-channel', 'order-booker-event'));
            }
            Bill::where('id', $id)->update(['kitchen_status' => $status]);

            return redirect()->back()->with(['message' => 'Order ' . $status . ' successfully..!', 'type' => 'error']);
        } catch (Exception $ex) {
            return redirect()->back()->with(['message' => 'some thing went wrong', 'type' => 'error']);
        }
    }
}
