<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return new CategoryCollection($categories);
    }

    public function save(CategoryCreateRequest $request)
    {
        Category::create(['name' => $request->get('name')]);

        return response()->json(['message' => 'Product created']);
    }

    public function delete($id)
    {
        $category = Category::find($id);

        $category->delete();

        return response()->json(null, 204);
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function update($id, CategoryCreateRequest $request)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update(['name' => $request->get('name')]);
            $category->save();

            return response()->json([
                "message" => "Category updated successfully",
                "category" => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to update category",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
