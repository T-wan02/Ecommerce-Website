<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug)
    {
        // return $slug;
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect('/')->with('error', 'Product not found');
        }
        $category = Category::withCount('product')->get();
        // return $category;

        return view('product-detail', compact('category', 'slug'));
    }
}
