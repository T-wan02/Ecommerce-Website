<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApi extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('category', 'brand', 'color', 'review.user')
            ->first();
        if (!$product) {
            return response()->json([
                'message' => false,
                'data' => "Data Not Found"
            ]);
        }

        return response()->json([
            'message' => true,
            'data' => $product
        ]);
    }
}
