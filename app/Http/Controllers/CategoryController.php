<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.blog.category',[
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $category           = Category::all();
        // return view('dashboard.category.create', [
        //     'category'      => $category,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name'              => 'required',
            'seo_title'         => 'required',
            'seo_description'   => 'required',
            'seo_tags'          => 'required',
            'slug'              => 'required',
        ]);

        $category                   = new Category();
        $category->name             = $request->name;
        $category->slug             = $request->slug;
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;
        // if ($request->has('image')) {
        //     $category->image            = Self::upload($request);
        // }
        $category->status           = $request->status;
        // if ($category->slug = null) {
        //     $category->slug             = Str::slug($request->name, '-');
        // } else {
        //     $category->slug             = $request->slug;
        // }
        $category->save();
        return back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('backend.blog.category-edit', [
            'category'      => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category->name             = $request->name;
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;
        $category->status           = $request->status;
        $category->slug             = $request->slug;
        $category->save();
        return back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('danger', 'Category deleted!!');
    }

    static function upload($request)
    {
        $imageName = 'dashboards/Theme1/images/category/' . time() . '.' . $request->image->extension();
        $request->image->move(public_path('dashboards/Theme1/images/category'), $imageName);
        return $imageName;
    }
}
