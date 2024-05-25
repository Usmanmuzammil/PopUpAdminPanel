<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catagery;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Collection;
use App\Models\addon;
use App\Models\attribute;
use App\Models\item_extras;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $perPage = $request->input('per_page', 18); // Default per page to 18, can be overridden in request

        $productsQuery = Product::query();

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        } else {
            // If category_id is not provided, return an empty result
            return response()->json([
                'products' => [],
                'total_pages' => 0,
                'total_entries' => 0,
            ]);
        }

        $products = $productsQuery->paginate($perPage);

        $formattedProducts = [];

        foreach ($products as $product) {
            $formattedProducts[] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'category_id' => $product->category_id,
                'selling_price' => $product->selling_price,
                'product_image' => $product->product_image,
                'product_code' => $product->product_code,
                'stock' => $product->getStock($product->id),
            ];
        }

        return response()->json([
            'products' => $formattedProducts,
            'total_pages' => $products->lastPage(),
            'total_entries' => $products->total(),
        ]);
    }


    public function category()
    {
        $category = Catagery::all();
        return response()->json(['category' => $category]);
    }

    // Get product details by product ID
    // public function getProductDetails($id)
    // {
    //     $product = Product::where('id', $id)->get();

    //     $attr = attribute::whereNull('deleted_at')->get();

    //     // $i = Product::with(['itemAttributes.attribute'])->findOrFail($id);
    //     // $attributesWithVariants = $i->itemAttributes->groupBy('attribute.name');

    //     $extra = item_extras::where('item_id', $id)->whereNull('deleted_at')->get();

    //     // $addon = Addon::whereNull('deleted_at')->get();

    //     $item_addon = DB::table('item_addons')
    //         ->select('item_addons.id', 'addons.name', 'addons.price')
    //         ->join('addons', 'item_addons.addon_id', 'addons.id')
    //         ->where('item_addons.item_id', $id)
    //         ->get();

    //     return response()->json([
    //         // 'attributesWithVariants' => $attributesWithVariants,
    //         'product' => $product,
    //         'attr' => $attr,
    //         // 'i' => $i,
    //         'extra' => $extra,
    //         // 'addon' => $addon,
    //         'item_addon' => $item_addon
    //     ]);
    // }

    public function getProductDetails($id)
    {
        $product = Product::where('id', $id)->get();

        $attr = Attribute::whereNull('deleted_at')->get();

        $i = Product::with(['itemAttributes.attribute'])->findOrFail($id);
        $attributesWithVariants = $i->itemAttributes->groupBy('attribute.name');

        $extra = item_extras::where('item_id', $id)->whereNull('deleted_at')->get();

        // $addon = Addon::whereNull('deleted_at')->get();

        $item_addon = DB::table('item_addons')
            ->select('item_addons.id', 'addons.name', 'addons.price')
            ->join('addons', 'item_addons.addon_id', 'addons.id')
            ->where('item_addons.item_id', $id)
            ->get();

        return response()->json([
            'product' => $product,
            'attributesWithVariants' => $attributesWithVariants,
            // 'attr' => $attr,
            // 'i' => $i,
            'extra' => $extra,
            // 'addon' => $addon,
            'item_addon' => $item_addon
        ]);
    }

   
}
