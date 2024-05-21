<?php

namespace App\Http\Controllers;

use App\Events\OrderAlert;
// use App\Models\User;
use App\Models\Account;
use App\Models\addon;
use App\Models\attribute;
use App\Models\Bill;
// use App\Models\warehouse;
use App\Models\Bill_detail;
use App\Models\Catagery;
use App\Models\OrderBooker;
// use App\Models\item_addon;
// use App\Models\item_attribute;
// use App\Models\item_extras;

use App\Models\Product;
use App\Models\variant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\pos_seting;

class PosController extends Controller
{


public function __construct()
{
    $this->middleware('auth');
}

public function index(){

    $customer=Account::where('account_type','customer')->get();
    $booker    = OrderBooker::all();
    $category = Catagery::all();
    return view('sell.pos',compact('customer','booker','category'));
}

public function products(Request $request)
{

    $products = "";
    if($request->category_id==0){

        $products = Product::paginate(18);
    }else{
        $products = Product::where('category_id',$request->category_id)->paginate(18);
    }

    $items = Product::with([
        'itemAttributes.attribute' => function ($query) {
            $query->orderBy('status','desc'); // Order by status in descending order
        }
    ])->get();




        // $products = Product::paginate(18);
        $arr = [];
        $html = "";

        foreach ($items as $key => $item) {

            // $html = "<div class='row'>";
            $html = "";

            $multiple = "";
            foreach ($item->itemAttributes->groupBy('attribute.name') as $attributeName => $varriant) {

                $firstVariant = $varriant->first();
                $attribute_id = $firstVariant->attribute->id ;
                $attribute_name = $firstVariant->attribute->name ;


                if($firstVariant->attribute->status==1){


             $html .="<div class='variants-container multi-variants '>
                        <div class='row variants-row'>
                        <div class='col'>
                                      <input type='hidden' class='attribute_id_field' value='".$attribute_id."'>
                                      <input type='hidden' class='attribute_name_field' value='".$attribute_name."'>

                                        <h4 class='attribute_name text-capitalize mt-2'> ".ucfirst($attributeName)."</h4>

                                        ";
                    foreach ($varriant as $key => $varriant) {
                        $shortenedName = strlen($varriant->name) > 5 ? substr($varriant->name, 0, ) . '..' : $varriant->name;

                                        // Escape the full name for the tooltip
                                        $escapedName = htmlspecialchars($varriant->name);

                        $html .= "

                                 <span class='m-1   variant-selection btn btn-light btn-sm' style=''>

                                     <a href='javascript:void(0)' data-toggle='tooltip' title='$escapedName'>


                                         <div class='py-1 px-2 variation-card' style='width:100%;'>
                                            <div class=''>
                                            <input type='hidden' class='variant-price' value='".$varriant->price."'>
                                            <input type='hidden' class='variant-name' value='".$varriant->name."'>
                                            <input type='hidden' class='variant-id' value='".$varriant->id."' name='variant_id[]' >
                                            <span class='fs-14 variant-name text-center'>".$varriant->name."</span>

                                            <span class='price text-dark'>+".$varriant->price."</span>
                                            </div>
                                              <input type='hidden' class='m_varriantion_id_field' value='".$varriant->id."'>
                                                <input type='hidden' class='m_varriantion_name_field' value='".$varriant->name."'>
                                                 <input type='hidden' class='m_varriantion_price_field' value='".$varriant->price."'>
                                             <input type='checkbox' class='variation-price-checkbox' value='1' name='variant[]' style='display: none;'>

                                        </div>
                                        </a>
                                </span>
                                        ";
                    }
                    $html .="</div></div>

                    </div>";



                }else{

                $html .="<div class='variants-container single-variants'>
                <div class='row variants-row category-area'>
                <div class='col'>
                              <input type='hidden' class='single_attribute_id_field' value='".$attribute_id."'>
                              <input type='hidden' class='single_attribute_name_field' value='".$attribute_name."'>

                                <h4 class='attribute_name mt-2'> ".ucfirst($attributeName)."</h4>

                                ";
            foreach ($varriant as $key => $varriant) {
                $shortenedName = strlen($varriant->name) > 5 ? substr($varriant->name, 0, ) . '..' : $varriant->name;

                                // Escape the full name for the tooltip
                                $escapedName = htmlspecialchars($varriant->name);

                $html .= "

                             <span class=' m-1 btn btn-light btn-sm variant-selection single-selection' >
                             <a href='javascript:void(0)' data-toggle='tooltip' title='$escapedName'>
                            <input type='hidden' class='single_varriantion_id_field' value='".$varriant->id."'>
                              <input type='hidden' class='single_varriantion_name_field' value='".$varriant->name."'>
                              <input type='hidden' class='single_varriantion_price_field' value='".$varriant->price."'>

                                    <div class=' single-variation-card'>
                                    <div class='px-2 py-1'>
                                    <input type='hidden' class='variant-price' value='".$varriant->price."'>
                                    <input type='hidden' class='variant-name' value='".$varriant->name."'>
                                    <input type='hidden' class='variant-id' value='".$varriant->id."' name='variant_id[]' >
                                    <span class='fs-14 variant-name'>".$varriant->name."</span>
                                    <span class='price'>+".$varriant->price."</span>
                                    </div>
                                    <input type='radio' class='variation-price-radio' value='1' name='variant[]' style='display: none;'>

                                    </div>
                                </a>
                            </span>
                                ";
            }
            $html .="</div></div></div>";

            }

            }
            $html.="";
            if(count($item->itemAddon)>0){
                $html .="<div class='addons-container'>
                <div class='row addon-row'>

                    <div class='col'>
                                <h4 class='attribute_name mt-2'>Addons</h4>
                                ";
            foreach ($item->itemAddon as $key => $addon) {
                $shortenedName = strlen($addon->addon->name) > 5 ? substr($addon->addon->name, 0, ) . '..' : $addon->name;

                                // Escape the full name for the tooltip
                                $escapedName = htmlspecialchars($addon->addon->name);

                $html .= "

                             <span class='btn btn-light btn-sm addon-click m-1' >

                             <a href='javascript:void(0)' data-toggle='tooltip' title='$escapedName'>
                                    <input type='hidden' class='addon_id_field' value='".$addon->addon->id."'>
                                    <input type='hidden' class='addon_name_field' value='".$addon->addon->name."'>
                                    <input type='hidden' class='addon_price_field' value='".$addon->addon->price."'>
                                    <div class=' variation-card'>
                                    <div class='py-1 px-2'>
                                    <input type='hidden' class='variant-price' value='".$addon->addon->price."'>
                                    <span class='variant-name'>".$addon->Addon->name."</span>

                                    <span class='price'>+".$addon->Addon->price."</span>
                                    </div>
                                    <input type='checkbox' class='price-checkbox product-variant addon-check-box' value='1' name='addon[]' style='display: none;'>
                                    </div>
                                </a>
                            </span>
                                ";
            }
            $html .="</div></div>

            </div>";
        }
        if(count($item->itemExtra)>0){
            $html .= "<div class='extra-container'>
            <div class='row extra-row'>
            <div class='col'>
                <h4 class='attribute_name'>Extras</h4>";
                            foreach ($item->itemExtra as $key => $extra) {
                                // Truncate the variant name to 5 characters
                                $shortenedName = strlen($extra->name) > 5 ? substr($extra->name, 0, ) . '.' : $extra->name;

                                // Escape the full name for the tooltip
                                $escapedName = htmlspecialchars($extra->name);

                                $html .= "
                                    <span class='btn btn-light btn-sm m-1'>
                                    <input type='hidden' class='extra_id_field' value='$extra->id'>
                                    <input type='hidden' class='extra_name_field' value='$extra->name'>
                                    <input type='hidden' class='extra_price_field' value='$extra->price'>
                                        <a href='javascript:void(0)' data-toggle='tooltip' title='$escapedName'>
                                            <div class='variation-card'>
                                                <div class='px-2 py-1'>
                                                <input type='hidden' class='variant-price' value='".$extra->price."'>
                                                    <span class='variant-name'>$extra->name</span>

                                                    <span class='price'>+".$extra->price."</span>
                                                </div>
                                                <input type='checkbox' class='price-checkbox extras-checkbox' value='1' name='extra[]' style='display:none;'>
                                            </div>
                                        </a>
                                    </span>
                                ";
                            }

                            $html .= "</div></div></div>";
    }


            $arr[]=array(
                'product_id'=>$item->id,
                'section'=>$html
            );
        }

//
    $response = [
        'products' => [],
        'total_pages' => $products->lastPage(),
        'total_entries' => $products->total(),
        'variants'=>$arr
    ];

    foreach ($products as $product) {
        $stock = $product->getStock($product->id);

        $response['products'][] = [
            'id' => $product->id,
            'product_name' => $product->product_name,
            'category_id' => $product->category_id,

            'selling_price' => $product->selling_price,
            'product_image' => $product->product_image,
            'product_code' => $product->product_code,
            'stock' => $stock,
        ];
    }

    return response()->json($response);

}

    function show(Request $req){
        $output="";
        $product=Product::where('id',$req->product_id)->get();

        foreach ($product as $key => $value) {
            $output.="
            <tr>
            <td class='name'>".$value->product_name."</td>
            <td>".$value->selling_price."</td>
            <td><input type='number' value='1' class='form-control quantity'></td>
            <td class='subtotal'></td>
            <td><a href='javascript:void(0)' class='btn btn-danger delete_item'>X</a></td>
            </tr>
            ";
        }


        return response()->json(['item'=>$output]);

    }

    function get_search(Request $req){

        $productData = Product::all();

        // Add stock information to each product


        return response()->json(['productData' => $productData]);
    }


    function addSale(Request $req){
        try{
      if( pos_seting::where('created_at','<',date('Y-m-d H:i:s'))->where('closing_date','>',date('Y-m-d H:i:s'))->count() == 0 ){

        return response()->json(['status'=>0]);

        }


        $user_id=Auth::user()->id;
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $number = rand(1000,9999); // generates a random 6-digit number
        $letter1 = $alphabet[rand(0,25)]; // generates a random letter from the alphabet
        $letter2 = $alphabet[rand(0,25)]; // generates another random letter from the alphabet
        $copoun = $letter1 . $number . $letter2;


        $bill_id=0;
        $bill=new Bill();
        $bill->date = $req->bill['date'];
        $bill->order_type = $req->bill['order_type'] ?? 0;
        $bill->booker_id =  $req->bill['booker_id'];
        $bill->user_id = $user_id;
        $bill->discount = ($req->bill['discout']!="")?$req->bill['discout']:"0";
        $bill->total = $req->bill['grand_total'];
        $bill->paid_amount = $req->bill['net_total'];
        $bill->remaining = 0;
        $status = 1;
        $bill->bill_type = "sell";
        $bill->bill_status=$status;
        $bill->change=0;
        $bill->desc = $req->bill['desc'];
        $bill->net_total = $req->bill['net_total'];
        $bill->on_hold=($req->bill['order_type']=='dining')?"1":"0";
        $bill->panel = 1;
        $save = $bill->save();
            $bill_id = $bill->id;

        if ($save) {

            $save_bill_detail = "";

            foreach ($req->bill_detail as $key => $value) {
                $bill_details = new Bill_detail();

                $bill_details->bill_id = $bill_id;
                $bill_details->product_id = $value['item_id'];
                $bill_details->varriantion = json_encode($value['varriants'] ?? "") ;
                $bill_details->extras = json_encode($value['extra'] ?? "") ;
                $bill_details->addons = json_encode($value['addons'] ?? "") ;
                $bill_details->variant_price = $value['varriation_total_price'] ?? 0;
                $bill_details->extras_price = $value['extra_total_price'] ?? 0;
                $bill_details->addons_price = $value['addon_total_price'] ?? 0;
                $bill_details->qty = $value['item_qty'];
                $bill_details->price = $value['item_price'];
                $bill_details->total =  $value['item_price'] * $value['item_qty'];
                $bill_details->discount = $value['discout'] ?? 0;
                $bill_details->net_total = $value['net_total'];
                $save_bill_detail = $bill_details->save();
            }


            if ($save_bill_detail) {
                event(new OrderAlert('New Order Revieved..!', 'my-channel', 'my-event'));
                return response()->json(['status'=>'200','id'=>$bill_id]);
            } else {
                return response()->json(['status'=>'400']);

            }
        } else {
            return response()->json('status', 400);
        }

    }catch(Exception $ex){
        return response()->json(['error'=>404]);
    }

    }

    public function barcode_product(Request $req){

      $product=  Product::where('product_type','sell')->where('product_code',$req->search_item)->first();

            $output=["id"=>$product->id,"name"=>$product->product_name,"price"=>$product->selling_price];

    return response()->json($output);
    }


    public function add_customer(Request $req){
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|numeric|digits:11'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }




           $account=new Account();
            $user_id= Auth::user()->id;
             $account->account_type="customer";
             $account->name=ucfirst($req->name);
             $account->phone=$req->phone;
             $account->opening_balance=0;
             $account->user_id=$user_id;
             $save=$account->save();


        return response()->json([
            'success' => true,
            'customer' => [
                'id' => $account->id,
                'name' => $account->name,
                // include any other fields you want to return
            ],
        ]);


    }
    function updateSale(Request $req){
        // return $req->all();

                $account=  Account::where('account_type','shop-account')->first();
                $user_id=Auth::user()->id;
                $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $number = rand(1000,9999); // generates a random 6-digit number
                $letter1 = $alphabet[rand(0,25)]; // generates a random letter from the alphabet
                $letter2 = $alphabet[rand(0,25)]; // generates another random letter from the alphabet
                $copoun = $letter1 . $number . $letter2;


                $bill_id=0;
                $bill=Bill::find($req->update_bill_id);
                $bill->date = $req->bill['date'];
                $bill->order_type = $req->bill['order_type'] ?? 0;
                $bill->booker_id = $req->bill['booker_id'];
                $bill->user_id = $user_id;
                $bill->discount = ($req->bill['discout']!="")?$req->bill['discout']:"0";
                $bill->total = $req->bill['grand_total'];
                $bill->paid_amount = $req->bill['net_total'];
                $bill->remaining = 0;
                $status = 1;
                $bill->bill_type = "sell";
                $bill->bill_status=$status;
                $bill->change=$req->bill['change'];
                $bill->desc = $req->bill['desc'];
                $bill->net_total = $req->bill['net_total'];

                $save = $bill->save();
                    $bill_id = $bill->id;

                if ($save) {

                    Bill_detail::where('bill_id',$req->update_bill_id)->delete();

                    $save_bill_detail = "";

                    foreach ($req->bill_detail as $key => $value) {
                        $bill_details = new Bill_detail();

                        $bill_details->bill_id = $bill_id;
                        $bill_details->product_id = $value['item_id'];
                        $bill_details->varriantion = json_encode($value['varriants'] ?? "") ;
                        $bill_details->extras = json_encode($value['extra'] ?? "") ;
                        $bill_details->addons = json_encode($value['addons'] ?? "") ;
                        $bill_details->variant_price = $value['varriation_total_price'] ?? 0;
                        $bill_details->extras_price = $value['extra_total_price'] ?? 0;
                        $bill_details->addons_price = $value['addon_total_price'] ?? 0;
                        $bill_details->qty = $value['item_qty'];
                        $bill_details->price = $value['item_price'];
                        $bill_details->total =  $value['item_price'] * $value['item_qty'];
                        $bill_details->discount = $value['discout'] ?? 0;
                        $bill_details->net_total = $value['net_total'];
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



            public function order(Request $req){
                return $req->all();
            }
}
