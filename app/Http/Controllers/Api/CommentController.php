<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    public function save(CommentCreateRequest $request, Product $product)
    {
        $product->comments()->create([
            'body' => $request->get('body'),
        ]);
        return response()->json($product);
    }
}
