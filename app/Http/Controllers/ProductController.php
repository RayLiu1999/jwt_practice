<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    function index(Request $request) {
        return response()->json([
            "data" => ProductResource::collection(Product::all()),
            'user' => $request->user()
        ]);

        // return new ProductCollection(Product::all());
    }

    function show(Product $product, Request $request){
        return new ProductResource($product);
    }

    function update(Product $product, ProductRequest $request){

        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);

        return new ProductResource($product);
    }

    function store(ProductRequest $request){
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);

        return new ProductResource($product);
    }


    function destroy(Product $product, Request $request){
        if ($product->delete()){
            return response()->json(null, 200);
        };

        return response()->json(null, 403);
    }
}
