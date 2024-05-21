<?php

namespace App\Http\Controllers;

use App\Models\addon;
use App\Models\attribute;
use App\Models\tax;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Catagery;
use App\Models\category;
use App\Models\item_attribute;
use App\Models\item_extras;
use App\Models\unit;
use App\Models\Product;
use Milon\Barcode\DNS1D;
use App\Models\warehouse;
use Illuminate\Http\Request;

use App\Models\ProductSeting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $check_item = array();

    public function index()
    {


        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = unit::all();
        $category = Catagery::all();

        return view('product.create', ['unit' => $unit , 'category'=>$category]);
    }


    public function get_list()
    {

        $product =  Product::with('getCategory')->orderBy('id', 'desc');
        return  datatables($product)
        ->addColumn('unit_name', function ($product) {
            return $product->getUnit->unit_name;
        })
        ->addColumn('catagery_name', function ($product) {
            return $product->getCategory->catagery_name;
        })
            ->addColumn('stock', function ($product) {
                return $product->getStock($product->id) ."-". $product->getUnit->unit_name;
            })
            ->addColumn('actions', function ($product) {
                return '
               <div class="dropdown d-inline-block"><button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                   <i class="ri-more-fill align-middle"></i>
               </button>
               <ul class="dropdown-menu dropdown-menu-end">
               <li><a href="'.route('product.detail',$product->id).'"   class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>View</a></li>

               <li><a href="' . route('product.edit', $product->id) . '" class="dropdown-item edit-item-btn"><i class="ri-edit-box-line"></i> &nbsp; Edit</a></li>

               </ul>
           </div>

           <div class="modal fade" id="delete-' . $product->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                 </button>
               </div>
               <div class="modal-body">
                 Do you really want to delete this product?
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <form action="' . route('product.destroy', $product->id) . '" method="post">
                 ' . csrf_field() . '
                 ' . method_field("DELETE") . '
                   <input type="submit" name="" id="" value="DELETE" class="btn btn-danger">
               </form></div>
             </div>
           </div>
         </div>

         <div class="modal fade" id="detail-'.$product->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Prodcut Detail</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

               </button>
             </div>
             <div class="modal-body">
                 <div class="container">
                     <div class="row">
                 <div class="col-4">

                  <img class="my-2 w-100" src="' . asset('img/' . $product->product_image ) . '">

                 </div>
                    <div class="col-1">
                    </div>
                 <div class="col-7">


                    <table class="table table-bordered table-nowrap align-middle mb-0">
                    <tr>
                    <th>Name</th>
                    <td>'. $product->product_name.'</td>
                    </tr>
                    <tr>
                    <th>Code</th>
                    <td>'. $product->product_code.'</td>
                    </tr>
                     <tr>
                    <th>Purchase Price</th>
                    <td>'. $product->purchase_price.'</td>
                    </tr>
                    <tr>
                    <th>Sale Price</th>
                    <td>'. $product->selling_price.'</td>
                    </tr>
                    <tr>
                    <th>Unit</th>
                    <td>'. $product->getUnit->unit_name .'</td>
                    </tr>

                    </table>


                 </div>
             </div>
             </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>
';

            })


            ->rawColumns(['actions','unit_name','catagery_name','stock'])
            ->make(true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validate = $req->validate([
            'product_name' => 'required | max:200',
            'category'=>'required',
            // 'unit' => "required",
            'selling_price' => 'required | numeric',
        ]);
        if ($validate) {

            $product = new Product();
            $user_id = Auth::user()->id;
            $product->product_name = $req->product_name;
            $product->unit_id = 1;
            $product->product_code = $req->product_code ?? 0;
            $product->selling_price = $req->selling_price;
            $product->purchase_price = $req->purchase_price ?? 0;
            $product->category_id=$req->category;
            $product->opening_stock = 0;
            $product->status = 1;
            $product->user_id = Auth::user()->id;
            if ($req->hasFile('image')) {
                $product->product_image = $imageName = $req->file('image')->getClientOriginalName();
                $path = $req->file('image')->move(public_path('img'), $imageName);
            } else {
                $product->product_image = "no_image.jpg";
            }
            $product->save();
            // return "save";

            return redirect()->route('product.index')->with('success', 'Product Added Successfully..!');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->get();

        //  $category=catagery::all();
        $unit = unit::all();
        $category=Catagery::all();
        return view('product.edit', ['product' => $product, 'unit' => $unit,'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        // return $req->all();
        $validate = $req->validate([
            'product_name' => 'required | max:200',
            // 'product_code' => 'max:5 | unique:products,product_code,' . $id,
            'unit' => "required",
            'category'=>'required',
            'purchase_price' => 'required | numeric',
            'selling_price' => 'required | numeric',
        ]);
        if ($validate) {

            $product = Product::find($id);
            $user_id = Auth::user()->id;
            $product->product_name = $req->product_name;
            $product->unit_id = $req->unit;
            $product->product_code = $req->product_code;
            $product->selling_price = $req->selling_price;
            $product->purchase_price = $req->purchase_price;
            $product->category_id=$req->category;

            $product->opening_stock = 0;
            $product->status = 1;
            $product->user_id = Auth::user()->id;
            if ($req->hasFile('image')) {
                $product->product_image = $imageName = $req->file('image')->getClientOriginalName();
                $path = $req->file('image')->move(public_path('img'), $imageName);
            }
            $product->save();
            // return "save";

            return redirect()->route('product.index')->with(['success'=>'Product Update Successfully..!','type'=>'success']);
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
      $count= Bill_detail::where('product_id',$id)->count();
      if($count>0){
        return redirect()->back()->with(['message'=>'this product has many bills so we cant delete this...!','type'=>'danger']);
      }
        $product = Product::where('id', $id)->delete();
        if ($product) {
            return redirect()->route('product.index')->with(['message'=>'Product Deleted Successfully','type'=>'success']);
        }
    }

    public function bar_code()
    {
        $product = Product::all();
        return view('product.barcode', compact('product'));
    }

    public function getItem(Request $req)
    {
        if (in_array($req->product_id, $this->check_item)) {
            return back()->with('have', "Duplicate Item Are Not Allowed");
        } else {


            if ($req->ajax()) {
                // $count=0;
                $count = $req->count;
                $item = Product::where('id', $req->product_id)->get();



                $output = "";

                $num = 0;
                foreach ($item as $index => $item) {

                    $output .= "<tr class='border bg-white tr' >
                            <td >" . $item->product_name . "</td>
                            <input type='hidden' name='item_id[]' id='item_id_" . $count . "' value='" . $item->id . "' class='item_id' />
                            <input type='hidden' name='item_code[]' id='item_code_" . $count . "' value='" . $item->product_code . "' class='item_code' />
                            <input type='hidden' name='item_name[]' id='item_name_" . $count . "' value='" . $item->product_name . "' class='item_name'>
                            <td>" . $item->product_code . "</td>
                            <td class='q'>
                                <input type='number' name='item_qty[]' class='form-control bg-transparent outline-none quantity item_quantity'  id='item_qty_" . $count . "' value='1' required/></td>
                            <td>
                                <a href='javascript:void(0)' class='remove_item' data-id=" . $item->id . " ><i class='mx-3 ri-delete-bin-fill'></i></a></td>
                        </tr>
                ";
                    $num++;
                }
                // $this->check_item=$req->product_id;
                array_push($this->check_item, $req->product_id);

                return $output;
            }
        }
    }

    public function generate_barcode(Request $req)
    {
        $productId =  $req->product_id;
   $product = Product::find($productId); // Assuming you have a Product model


        $barcode = DNS1D::getBarcodeSVG($product->product_code, 'C128' , '1','25' , 'black',false);

        $data = [
            'product' => $product,
            'barcode' => ($barcode),
            'companyName' => 'JUGNO GSM',
        ];

    return view('product.print_barcode', $data);
    }


    public function product_detail($id){
        $product = Product::with('getAddon')->where('id',$id)->get();

      $attr = attribute::whereNull('deleted_at')->get();


    //    $i  = Product::with('itemAttributes.attribute')->findOrFail($id);


    //      $i = attribute::with('getItemAttr')->whereNull('deleted_at')->get();


    $i = Product::with(['itemAttributes.attribute'])->findOrFail($id);

    $attributesWithVariants = $i->itemAttributes->groupBy('attribute.name');


        $extra = item_extras::where('item_id',$id)->whereNull('deleted_at')->get();

       $addon = addon::whereNull('deleted_at')->get();
     $item_addon =   DB::table('item_addons')->select('item_addons.id','addons.name','addons.price')->join('addons','item_addons.addon_id','addons.id')->where('item_addons.item_id',$id)->get();

        return view('product.detail',compact('attributesWithVariants','product','attr','i','extra','addon','item_addon'));
    }

}
