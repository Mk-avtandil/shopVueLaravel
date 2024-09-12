<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with("category")->paginate(3);

        return new ProductCollection($products);
    }

    public function create()
    {
        $categories = Category::all();
        return new CategoryCollection($categories);
    }

    public function save(ProductCreateRequest $request)
    {
        Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id')
        ]);
        return response()->json(['message' => 'Product created']);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    public function detail(Product $product)
    {
        $product = $product->load(["category:id,name", 'comments']);

        return response()->json($product);
    }

    public function edit(Product $product)
    {
        $product = $product->load(["category:id,name"]);
        return response()->json($product);
    }

    public function update(Product $product, ProductCreateRequest $request)
    {
        try {
            $product->update([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'description' => $request->get('description'),
                'category_id' => $request->get('category_id')
            ]);

            return response()->json([
                "message" => "Product updated successfully",
                "product" => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to update product",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
