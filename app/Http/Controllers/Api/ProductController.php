<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catagery;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Collection;


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $category = Catagery::all();
        return response()->json(['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
