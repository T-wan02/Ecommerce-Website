<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewApi extends Controller
{
    public function review(Request $request, $slug)
    {
        // return $request->all();
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response([
                'message' => false,
                'data' => 'product_not_found'
            ]);
        }

        $review = ProductReview::create([
            'user_id' => $request->user_id,
            'review' => $request->comment,
            'rating' => $request->rating,
            'product_id' => $product->id
        ]);

        $review = ProductReview::where('id', $review->id)->with('user')->first();

        return response()->json([
            'message' => true,
            'data' => $review
        ]);
    }
}
