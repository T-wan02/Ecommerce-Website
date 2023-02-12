<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class HomeApi extends Controller
{
    public function home()
    {
        $category = Category::withCount('product')->get();

        try {
            $featuredProduct = Product::all()->random(2);
        } catch (Exception $e) {
            $featuredProduct = [];
        }

        $productByCategory = Category::has('product')->take(2)->get();
        foreach ($productByCategory as $k => $v) {
            $productByCategory[$k]->product = Product::where('category_id', $v->id)->take(6)->get();
        }

        return response()->json([
            'success' => true,
            'category' => $category,
            'featuredProduct' => $featuredProduct,
            'productByCategory' => $productByCategory
        ]);
    }
}
