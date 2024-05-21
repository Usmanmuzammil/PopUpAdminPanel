<?php

namespace App\Http\Controllers;

use App\Models\tax;
use App\Models\Bill;
use App\Models\User;
use App\Models\Account;
use App\Models\Product;
use App\Models\warehouse;
use App\Models\Bill_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseReturnController extends Controller
{

    function index(){
        $bill=Bill::where('bill_type','purchasereturn')->get();

        return view('purchase_return.index',compact('bill'));
    }
    function create(){
        $customer = Account::where('account_type','Purchaser')->get();
        $tax = tax::all();
        $biller = User::all();
        $warehouse = warehouse::all();
        $product = Product::all();
        return view('purchase_return.create', [
            'customer' => $customer, 'warehouse' => $warehouse, 'product' => $product, 'biller' => $biller,
            'tax' => $tax
        ]);
    }
    public function store(Request $req)
    {
        // return $req->bill_detail;
        if(Bill::where('reference_no',$req->bill_detail['reference_no'])->first()){
            return response()->json(['status'=>'0','message'=>'reference number is already taken']);
        }else{

        
        $bill_id=0;
        $status=0;
        $bill = new Bill();
        $bill->date = $req->bill_detail['date'];
        $bill->reference_no = $req->bill_detail['reference_no'];
        $bill->account_id = $req->bill_detail['account_id'];
        $bill->warehouse_id = $req->bill_detail['warehouse_id'];
        $bill->user_id = $req->bill_detail['user_id'];
        $bill->tax_ammount = $req->bill_detail['ordertax'];
        $bill->discount = $req->bill_detail['orderdiscount'];
        $bill->shipping = $req->bill_detail['shippingCost'];
        $bill->total = $req->bill_detail['finalGrandTotal'];
        $bill->paid_ammount = $req->bill_detail['paying_ammount'];
        $bill->remaining = $req->bill_detail['remaining'];
        $status = ($req->bill_detail['paying_ammount']<$req->bill_detail['finalGrandTotal'] ) ? '0' : '1';

        $bill->bill_type = "purchasereturn";
        $bill->bill_status=$status;
        $bill->returned_ammount=$req->bill_detail['change'];
        $bill->total_bill_item = $req->bill_detail['total_item'];
        $bill->total_qty = $req->bill_detail['item_quantity'];
        $bill->desc = $req->bill_detail['orderdescription'];
        $save = $bill->save();

        if ($save) {
            $id = Bill::get()->last();
            $bill_id = $id->id;
            $save_bill_detail = "";


            foreach ($req->bill as $key => $value) {
                $bill_details = new Bill_detail();

                $bill_details->bill_id = $bill_id;
                $bill_details->product_id = $value['item_id'];
                $bill_details->qty = $value['item_quantity'];
                $bill_details->price = $value['item_price'];
                $bill_details->tax = $value['item_tax'];
                $bill_details->discount = $value['item_discount'];
                $bill_details->total = $value['item_subtotal'];
                $save_bill_detail = $bill_details->save();
            }

            if ($save_bill_detail) {
                return response()->json(['status'=>'200','id'=>$bill_id]);
            } else {
                return response()->json(['status'=>'400']);

            }
        } else {
            return response()->json('status', 400);
        }
    }
    }
    
    function edit($id){
        $customer = Account::where('account_type','purchaser')->get();
        $tax = tax::all();
        $biller = User::all();
        $warehouse = warehouse::all();
        $product = Product::all();
        $bill_detail=Bill_detail::where('bill_id',$id)->get();
        return view('purchase_return.edit', [
            'customer' => $customer, 'warehouse' => $warehouse, 'product' => $product, 'biller' => $biller,
            'tax' => $tax,'bill_detail'=>$bill_detail
        ]);
    }  

    public function update(Request $req)
    {
       // return $req->bill;



       $id = $req->bill_detail['bill_id'];

      // return $req->all();

        $bill=Bill::find($id);
        
        
        $bill_id=0;
        $status=0;
        $save_bill_detail="";
        // $bill = new Bill();
        $bill->date = $req->bill_detail['date'];
        $bill->reference_no = $req->bill_detail['reference_no'];
        $bill->account_id = $req->bill_detail['account_id'];
        $bill->warehouse_id = $req->bill_detail['warehouse_id'];
        $bill->user_id = $req->bill_detail['user_id'];
        $bill->tax_ammount = $req->bill_detail['ordertax'];
        $bill->discount = $req->bill_detail['orderdiscount'];
        $bill->shipping = $req->bill_detail['shippingCost'];
        $bill->total = $req->bill_detail['finalGrandTotal'];
        $bill->paid_ammount = $req->bill_detail['paying_ammount'];
        $bill->remaining = $req->bill_detail['remaining'];
        $status = ($req->bill_detail['paying_ammount']<$req->bill_detail['finalGrandTotal'] ) ? '0' : '1';

        $bill->bill_type = "purchasereturn";
        $bill->bill_status=$status;
        $bill->returned_ammount=$req->bill_detail['change'];
        $bill->total_bill_item = $req->bill_detail['total_item'];
        $bill->total_qty = $req->bill_detail['item_quantity'];
        $bill->desc = $req->bill_detail['orderdescription'];
        $save = $bill->save();   
        if ($save) {
            DB::table('bill_details')->where('bill_id', $id)->delete();
            
            $save_bill_detail = "";


            foreach ($req->bill as $key => $value) {
                $bill_details = new Bill_detail();

                $bill_details->bill_id = $id;
                $bill_details->product_id = $value['item_id'];
                $bill_details->qty = $value['item_quantity'];
                $bill_details->price = $value['item_price'];
                $bill_details->tax = $value['item_tax'];
                $bill_details->discount = $value['item_discount'];
                $bill_details->total = $value['item_subtotal'];
                $save_bill_detail = $bill_details->save();
            }


            if ($save_bill_detail) {
                return response()->json(['status'=>'200','id'=>$bill_id]);
            } else {
                return response()->json(['status'=>'400']);

            }
        } else {
            return response()->json('status', 400);
        }
    }
}
