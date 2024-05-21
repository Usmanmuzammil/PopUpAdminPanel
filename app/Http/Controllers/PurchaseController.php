<?php

namespace App\Http\Controllers;

use App\Models\tax;
use App\Models\Bill;
use App\Models\User;
use App\Models\Account;
use App\Models\Product;
use App\Models\Catagery;
use Milon\Barcode\DNS1D;
use App\Models\warehouse;
use App\Models\Bill_detail;
use App\Models\Purchase;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseController extends Controller
{



public function __construct()
{
    $this->middleware('auth');
}

    public $check_item = array();
    public function index()
    {

      $purchase = Purchase::all();
        return view('purchase.index',compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaser = Account::where('account_type','purchaser')->get();
        $account = Account::where('account_type','shop-account')->get();
     

        return view('purchase.create', compact('purchaser',
            'account'
        ));
    }

    public function load_products()
    {
        $products = Product::with('getUnit')->get(); // Retrieve all products from the database

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
      $validate =  $req->validate([
            'supplier'=>'required',
            'account'=>'required',
            'date'=>'required',
            'total_amount'=>'required'
        ]);
        if($validate){
            $purchase =new Purchase();
            $purchase->supplier_id=$req->supplier;
            $purchase->account_id=$req->account;
            $purchase->date=$req->date;
            $purchase->total_amount=$req->total_amount ?? 0;
            $purchase->paid_amount=$req->paid_amount ?? 0;
            $purchase->remaining=$req->remaining ?? 0;
            $purchase->note=$req->note;
            if($purchase->save()){
                return redirect()->route('purchase.index')->with(['type'=>'success','message'=>'purchase added successfully..!']);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       $purchase=Purchase::where('id',$id)->get();
       $supplier = Account::where('account_type','purchaser')->get();
        return view('purchase.invoice',['purchase'=>$purchase,'supplier'=>$supplier]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $purchase=Purchase::where('id',$id)->get();
        $supplier = Account::where('account_type','purchaser')->get();
        $account = Account::where('account_type','shop-account')->get();
        return view('purchase.edit',['purchase'=>$purchase,'supplier'=>$supplier,'account'=>$account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,$id)
    {
        $validate =  $req->validate([
            'supplier'=>'required',
            'account'=>'required',
            'date'=>'required',
            'total_amount'=>'required'
        ]);
        if($validate){
            $purchase =Purchase::find($id);
            $purchase->supplier_id=$req->supplier;
            $purchase->account_id=$req->account;
            $purchase->date=$req->date;
            $purchase->total_amount=$req->total_amount ?? 0;
            $purchase->paid_amount=$req->paid_amount ?? 0;
            $purchase->remaining=$req->remaining ?? 0;
            $purchase->note=$req->note;
            if($purchase->save()){
                return redirect()->route('purchase.index')->with(['type'=>'success','message'=>'purchase added successfully..!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Purchase::find($id)->delete()){
            return redirect()->back()->with('success','purchase invoice deleted successfully...!');
        }
    }
    public function get_product(Request $req)
    {
        $output = "";
        if ($req->product!="") {

$product = Product::where('product_name', 'LIKE', "%{$req->product}%")->orwhere('product_code', 'LIKE', "%{$req->product}%")->get();
            if ($product) {
                foreach ($product as $value) {
                    $output .= '<li class="list-group my-1"><div id="ui-id-48" tabindex="-1" class=" ui-menu-item-wrapper"><a href="javascript:void(0);" data-id=' . $value->id . ' class="text-light product">' . $value->product_name .'</a>
                        <input type="hidden" class="product_id" value="'.$value->id.'">
                        <input type="hidden" class="product_price" value="'.$value->selling_price.'">
                        <input type="hidden" class="product_unit" value="'.$value->getUnit->code.'">
                    </div></li>';
                }
                return $output;
            } else {
                return "";

            }
        }
    }
    public function product_detail(Request $req, $id)
{


    // return "work";
    $product = Product::where('id', $id)->get();
    if (!empty($product)) {
        $output = "";

        foreach ($product as $key => $v) {
            $taxRate = 0;
            if ($v->gettax) {
                $taxRate = $v->gettax->rate ?? 0;
            }
            $output .= '
                <tr>
                    <td>' . $v->product_name . '<input type="hidden" value=' . $v->id . ' class="product_id"></td>
                    <td style="width:130px;"><input type="number" class="product_price form-control" id="product_price"   value="'.$v->selling_price.'"></td>\
                    <td style="width:130px;"><input type="number" class="product_qty form-control" id="item_quantity"  value="1"></td>\
                    <td style="width:130px;"><input type="number" class="item_disc form-control" id="item_quantity"  value="0"></td>\
                    <td class="fw-bold "><span class="sub_total">'.$v->selling_price.'</span></td>

                    <th><a href="javascript:void(0)" class="remove_item"><i class="ri-delete-bin-line remove_item"></i></a></th>
                </tr>
            ';
        }

        return response()->json(['product' => $output]);
    }
}

    // detail modal
    public function salelist(){
         $bill=Bill::where('bill_type','sell')->orderBy('bill_status','ASC')->orderBy('id','desc')->get();

        return view('sell.sale_list',compact('bill'));
    }


    public function sale_detail(Request $req){

        $bill_detail=Bill_detail::where('bill_id',$req->bill_id)->get();
	 	$bill = Bill::where('id',$req->bill_id)->get();
        if(count($bill_detail)==0){
            return "<h4>No Record Found</h4>";
        }



        $output="";
          foreach($bill as $bill_data){
        $output='
        <div id="bill_detail_print" class="px-3 mt-4">
        <div class="row">
          <div class="col md-6 px-4">
              <div class="fs-14"> Date Time :<strong> '.$bill_data->date . ' &nbsp;&nbsp;' . $bill_data->created_at->format('g:i A') .' </strong></div>
              <div class="fs-14"> Invoice # : <strong> '.$bill_data->id.' </strong></div>
          </div>

          <div class="col md-6 px-4">
              <div class="fs-14" >Customer Name : <strong> '.$bill_data->name.' </strong></div>
              <div class="fs-14" >Phone : <strong>'.$bill_data->number.' </strong></div>
          </div>


        </div>

        <div class="row">
        <div class="col mt-4">
            <table class="table striped">
                <thead>
                  <tr class="bg-light">
                    <th scope="col">Qty</th>
                    <th scope="col">Item Name</th>
                     <th scope="col">Price</th>
                    <th scope="col">Disc</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
        ';

        foreach($bill_detail as $key => $value){

            $output.='

                      <tr>
                        <td>'.$value->qty.'</td>
                        <td>'.$value->getproduct->product_name.'</td>
                        <td>'.$value->price.'</td>
                        <td>'.$value->discount.'</td>
                        <td>'.$value->net_total.'</td>


                      </tr>


                ';
        }
        $output.='
   </tbody>
   <tfoot class="bg-light">
        <tr>
        <th colspan="4">
            Total
        </th>
        <th >'.$bill_data->total.'</th>
      </tr>
        <tr>
        <th colspan="4">
            Discount
        </th>
        <th >'.$bill_data->discount.'</th>
      </tr>
       <tr>
        <th colspan="4">
            Net Total
        </th>
        <th >'.$bill_data->net_total.'</th>
      </tr>


      <tr>
        <th colspan="4">Paid Amount </td>
        <th>'.$bill_data->paid_amount.'</th>
      </tr>

      <tr>
        <th colspan="4">Return </th>
        <th>'.$bill_data->change.'</th>
      </tr>
   </tfoot>
      </table>
</div>
</div>

      </div>
      ';
    }
        return $output;
    }
}
