<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(3);
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mm_name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $file = $request->file('image');
        $file_name = $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        Category::create([
            'slug' => Str::slug($request->name) . uniqid(),
            'name' => $request->name,
            'mm_name' => $request->mm_name,
            'image' => $file_name
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
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
        $cat = Category::where('slug', $id)->first();

        if (!$cat) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        return view('admin.category.edit', compact('cat'));
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
        $cat = Category::where('slug', $id);

        if (!$cat->first()) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        if ($request->image) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        } else {
            $file_name = $cat->first()->image;
        }

        $cat->update([
            'name' => $request->name,
            'mm_name' => $request->mm_name,
            'image' => $file_name
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::where('slug', $id);

        if (!$cat->first()) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        $cat->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
