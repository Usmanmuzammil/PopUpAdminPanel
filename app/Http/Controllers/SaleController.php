<?php

namespace App\Http\Controllers;
//
// use src/Milon/Barcode/Datamatrix.php;
// src/Milon/Barcode/DNS1D.php (tcpdf_barcodes_1d.php)
// src/Milon/Barcode/DNS2D.php (tcpdf_barcodes_2d.php)
// src/Milon/Barcode/PDF417.php (include/barcodes/pdf417.php)
// src/Milon/Barcode/QRcode.php (include/barcodes/qrcode.php)
//
use datatables;
use App\Models\tax;
use App\Models\Bill;
use App\Models\User;
use App\Models\Account;
use App\Models\Product;
use App\Models\Catagery;
use Milon\Barcode\DNS1D;
use App\Models\warehouse;
use App\Models\Bill_detail;
use App\Models\category;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\OrderBooker;

class SaleController extends Controller
{



public function __construct()
{
    $this->middleware('auth');
}

    public $check_item = array();
    public function index()
    {
        return view('sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Account::where('account_type','customer')->get();
        $tax = tax::all();
        $biller = User::all();
        $warehouse = warehouse::all();
        $product = Product::all();
        return view('sell.create', [
            'customer' => $customer, 'warehouse' => $warehouse, 'product' => $product, 'biller' => $biller,
            'tax' => $tax
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        if(Bill::where('reference_no',$req->bill_detail['reference_no'])->first()){
            return response()->json(['status'=>'0','message'=>'reference number is already taken']);
        }else{


        $bill_id=0;
        $status=0;
        $bill = new Bill();
        $bill->date = $req->bill_detail['date'];
        $bill->reference_no = $req->bill_detail['reference_no'];
        $bill->account_id = $req->bill_detail['account_id'];
        $bill->user_id = $req->bill_detail['user_id'];
        $bill->tax_ammount = $req->bill_detail['ordertax'];
        $bill->discount = $req->bill_detail['orderdiscount'];
        $bill->shipping = $req->bill_detail['shippingCost'];
        $bill->total = $req->bill_detail['finalGrandTotal'];
        $bill->paid_ammount = $req->bill_detail['paying_ammount'];
        $bill->remaining = $req->bill_detail['remaining'];
        $status = ($req->bill_detail['paying_ammount']<$req->bill_detail['finalGrandTotal'] ) ? '0' : '1';

        $bill->bill_type = "sell";
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
                $bill_details->meter = $value['item_meter'];
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $bill_detail=Bill_detail::where('bill_id',$id)->get();
        $bill=Bill::where('id',$id)->get();
        $barcode="<span>".DNS1D::getBarcodeHTML("Bill No:".$id, 'C128')."</span>";
        return view('sell.invoice',['bill_detail'=>$bill_detail,'bill'=>$bill,'barcode'=>$barcode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $customer = Account::where('account_type','customer')->get();
        // $tax = tax::all();
        // $biller = User::all();
        // $warehouse = warehouse::all();
        // $product = Product::all();
        // $bill_detail=Bill_detail::where('bill_id',$id)->get();
        // return view('sell.edit', ['product' => $product, 'biller' => $biller,
        //     'tax' => $tax,'bill_detail'=>$bill_detail
        // ]);
       $category =  Catagery::all();
       $bill= Bill::with('getBillDetail')->where('id',$id)->get();

       $booker = OrderBooker::get();
       return view('sell.edit-pos',compact('bill','booker','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {


 $bill_id = $req->bill['bill_id'];

        $account=  Account::where('status','default')->first();
        $bill=Bill::find($bill_id);
        $bill->date = $req->bill['date'];
        $bill->booker_id = $req->bill['booker_id'];
        $bill->order_type = $req->bill['order_type'];
        $bill->user_id = Auth::user()->id;
        $bill->discount = $req->bill['discount'];
        $bill->total = $req->bill['grand_total'];
        $bill->net_total = $req->bill['net_total'];
        $bill->desc = $req->bill['desc'];
        $bill->change=$req->bill['change'];

        $bill->paid_amount =$req->bill['net_total'] ;
        $bill->remaining = 0;
        $bill->bill_status=1;


        $save = $bill->save();
        if ($save) {


             Bill_detail::where('bill_id',$bill_id)->delete();
            $save_bill_detail = "";

            foreach ($req->bill_detail as $key => $value) {
                $bill_details = new Bill_detail();
                $bill_details->bill_id = $bill_id;
                $bill_details->product_id = $value['item_id'];
                $bill_details->qty = $value['item_qty'];
                $bill_details->price = $value['item_price'];
                $bill_details->total = $value['item_price'] * $value['item_qty'];
                $bill_details->net_total = $value['net_total'];
                $bill_details->discount = $value['item_discount'];
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        return $id;
    }

    public function destroy($id)
    {
        // return $id;
    $delete=Bill_detail::where('bill_id',$id)->delete();
    if($delete){
        Bill::find($id)->delete();
        return redirect()->back()->with(['message'=>'bill deleted','type'=>'success']);
    }
    }
    public function get_product(Request $req)
    {
        $output = "";
        if (!empty($req->product_name)) {


            $product = Product::where('product_name', 'LIKE', "%{$req->product_name}%")->orwhere('product_code', 'LIKE', "%{$req->product_name}%")->get();
            if (!empty($product)) {



                foreach ($product as $value) {
                    $output .= '<li class="list-group my-1"><div id="ui-id-48" tabindex="-1" class=" ui-menu-item-wrapper"><a href="javascript:void(0);" data-id=' . $value->id . ' class="text-light product">' . $value->product_name . '( ' . $value->product_code . ')</a></div></li>';
                }
                return $output;
            } else {
                return "";

            }
        }
    }
    public function product_detail(Request $req, $id)
{
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
                    <td>' . $v->product_name . '<input type="hidden" value=' . $v->id . ' class="item_id"></td>
                    <td style="width:130px;"><input type="number" class="item_price form-control" id="item_quantity"   value="'.$v->selling_price.'"></td>\
                    <td style="width:130px;"><input type="number" class="item_qty form-control" id="item_quantity"  value="1"></td>\
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
         $bill=Bill::where('bill_type','sell')->orderBy('id','desc')->get();

        return view('sell.sale_list',compact('bill'));
    }



    public function view_sale_list(){

        return view('sell.sale_list_update');
    }

   public function get_sale_list(){

       $bills =  Bill::with('getBooker')->select('id','booker_id','order_type','date','total','discount','net_total','paid_amount','remaining','bill_status')->where('bill_type','sell')->orderBy('id','desc');
            return  datatables($bills)
            ->addColumn('booker_name', function ($bills) {
                return $bills->getBooker->name;
            })
            ->addColumn('actions', function ($bills) {
                return '
                    <div class="dropdown d-inline-block"><button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">

                      <li><a href="'.url('/sell/gen_invoice',$bills->id).'" class="dropdown-item edit-item-btn"><i class="ri-edit-box-line"></i> &nbsp; Generate Invoice</a></li>
                      <li><a href="'.url('/sell/edit',$bills->id).'" class="dropdown-item edit-item-btn"><i class="ri-edit-box-line"></i>&nbsp; Edit</a></li>
                    </ul>
                </div>

                <div class="modal fade" id="delete'.$bills->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Bill</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Do you really want to delete this bill?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="'. route('sell.destroy', $bills->id).'" method="post">
                      '. csrf_field() .'
                      '. method_field("DELETE") .'
                        <input type="submit" name="" id="" value="DELETE" class="btn btn-danger">
                    </form></div>
                  </div>
                </div>
              </div>


               <div class="modal fade" id="invoice/'.$bills->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Bill Detail</h5>
  <a href="'.url('/sell/gen_invoice', $bills->id).'" class="btn btn-outline-primary">Print Invoice</a>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">

                       <hr>
                       <div class="row px-3">
                           <center>
                               <div style="display: none"
                                    class="spinner-border text-primary sale-modal-loading"
                                    role="status">
                                   <span class="sr-only">Loading...</span>
                               </div>
                           </center>
                           <div class="sale_detail_table"></div>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">Close</button>
                   </div>
               </div>
           </div>
       </div>';
            })->addColumn('bill_status', function ($bills) {
    $status = $bills->bill_status == 1 ? "Paid" : "Unpaid";
    $badgeClass = $bills->bill_status == 1 ? "success" : "warning";
    return '<span class="badge bg-'.$badgeClass.'">'.$status.'</span>';
})->rawColumns(['actions', 'bill_status','booker_name'])
->make(true);
    }





    public function sale_detail(Request $req){

        $bill_detail=Bill_detail::where('bill_id',$req->bill_id)->get();
	 	$bill = Bill::where('id',$req->bill_id)->get();
        if(count($bill_detail)==0){
            return "<h4>No Record Found</h4>";
        }



        $output="";
          foreach($bill as $bill_data){


            if($bill_data->bill_type=='sell'){

                $output='
                <div id="bill_detail_print" class="px-3 mt-4">
                <div class="row">
          <div class="col md-6 px-4">
          <div class="fs-14"> Date Time :<strong> '.$bill_data->date . ' &nbsp;&nbsp;' . $bill_data->created_at->format('g:i A') .' </strong></div>
              <div class="fs-14"> Invoice # : <strong> '.$bill_data->id.' </strong></div>
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
                }else{
                    $output='
                <div id="bill_detail_print" class="px-3 mt-4">
                <div class="row">
          <div class="col md-6 px-4">
          <div class="fs-14"> Date Time :<strong> '.$bill_data->date . ' &nbsp;&nbsp;' . $bill_data->created_at->format('g:i A') .' </strong></div>
              <div class="fs-14"> Invoice # : <strong> '.$bill_data->id.' </strong></div>
              </div>

              <div class="col md-6 px-4">
              <div class="fs-14" >Purchaser Name : <strong> '.$bill_data->getAccount->name.' </strong></div>
              <div class="fs-14" >Phone : <strong>'.$bill_data->getAccount->phone.' </strong></div>
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

                }

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

