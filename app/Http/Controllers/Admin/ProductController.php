<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;
use App\Models\Supplier;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Str;
use PDO;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->select('slug', 'name', 'image', 'total_quantity')->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $color = Color::all();
        $brand = Brand::all();

        return view('admin.product.create', compact('supplier', 'color', 'category', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->color_slug;
        // return $request->all();

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'total_quantity' => 'required|integer',
            'buy_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'discount_price' => 'required|integer',
            'supplier_slug' => 'required|integer',
            'category_slug' => 'required|string',
            'brand_slug' => 'required|string',
            'color_slug.*' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        //image upload
        $image = $request->file('image');
        $image_name = uniqid() .  $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        //product store
        $category = Category::where('slug', $request->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $supplier = Supplier::where('id', $request->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found.');
        }

        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }

        $colors = [];
        foreach ($request->color_slug as $c) {
            $color = Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'Color not found.');
            }

            $colors[] = $color->id;
        }

        // return $colors;

        $product = Product::create([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' => uniqid() . Str::slug($request->name),
            'name' => $request->name,
            'image' => $image_name,
            'discount_price' => $request->discount_price,
            'buy_price' => $request->buy_price,
            'sale_price' => $request->sale_price,
            'total_quantity' => $request->total_quantity,
            'like_count' => 0,
            'view_count' => 0,
            'description' => $request->description
        ]);

        // return $supplier->id;

        //add to transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'total_quantity' => $request->total_quantity
        ]);

        //store to product color
        $p = Product::find($product->id);
        $p->color()->sync($colors);

        return redirect()->back()->with('success', 'Product created successfully.');
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
        $supplier = Supplier::all();
        $category = Category::all();
        $color = Color::all();
        $brand = Brand::all();

        $p = Product::where('slug', $id)
            ->with('supplier', 'color', 'brand', 'category')
            ->first();
        if (!$p) {
            return redirect()->back()->with('error', 'Product Not found.');
        }

        // return $p;

        return view('admin.product.edit', compact('supplier', 'category', 'color', 'brand', 'p'));
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
        $find_product = Product::where('slug', $id);

        if (!$find_product) {
            return redirect()->back()->with('error', 'PRodcut Not found');
        }

        $product_id = $find_product->first()->id;

        if ($file = $request->file('image')) {
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('/images/' . $file_name));
        } else {
            $file_name = $find_product->first()->image;
        }

        //product store
        $category = Category::where('slug', $request->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $supplier = Supplier::where('id', $request->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found.');
        }

        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }

        $colors = [];
        foreach ($request->color_slug as $c) {
            $color = Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'Color not found.');
            }

            $colors[] = $color->id;
        }

        // return $colors;

        $slug = uniqid() . Str::slug($request->name);

        $find_product->update([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' => $slug,
            'name' => $request->name,
            'image' => $file_name,
            'discount_price' => $request->discount_price,
            'buy_price' => $request->buy_price,
            'sale_price' => $request->sale_price,
            'total_quantity' => $request->total_quantity,
            'like_count' => 0,
            'view_count' => 0,
            'description' => $request->description
        ]);

        $product = Product::find($product_id);
        $product->color()->sync($colors);

        return redirect(route('product.edit', $slug))->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find product
        $p = Product::where('slug', $id);
        if (!$p->first()) {
            return redirect()->back()->with('error', 'Product not found');
        }

        //remove image
        FacadesFile::delete(public_path('/images/' . $p->first()->image));

        //product color remove
        Product::find($p->first()->id)->color()->sync([]);

        //remove product
        $p->delete();

        return redirect()->back()->with('success', 'Product deleted Successfully.');
    }

    public function upload()
    {
        $file = request()->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();

        $file->move(public_path('/images'), $file_name);

        return asset('/images/' . $file_name);

        // return $file->getClientOriginalName();
    }

    public function createProductAdd($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not Founcd.');
        }

        $supplier = Supplier::all();

        return view('admin.product.create-product-add', compact('product', 'supplier'));
    }

    public function storeProductAdd(Request $request, $slug)
    {
        // return $request->all();

        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found.');
        }

        //add to transaction
        ProductAddTransaction::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $product->id,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description
        ]);

        //update to product total quantity
        $product->update([
            'total_quantity' => DB::raw('total_quantity+' . $request->total_quantity)
        ]);

        return redirect()->back()->with('success', $request->total_quantity . ' have been added to product total quantity.');
    }

    public function productTransaction()
    {
        $transactions = ProductAddTransaction::with('product')->paginate(2);
        // return $transactions->all();

        return view('admin.product.product_transaction', compact('transactions'));
    }

    public function createProductRemove($slug)
    {
        // return $slug;

        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        return view('admin.product.create-product-remove', compact('product'));
    }

    public function storeProductRemove(Request $request, $slug)
    {
        // return $request->all();
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        //add to remove table
        ProductRemoveTransaction::create([
            'product_id' => $product->id,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description
        ]);

        //update to product 
        $product->update([
            'total_quantity' => DB::raw('total_quantity-' . $request->total_quantity)
        ]);

        return redirect()->back()->with('success', $request->total_quantity . ' have been reduced from total_quantity of product.');
    }
}
