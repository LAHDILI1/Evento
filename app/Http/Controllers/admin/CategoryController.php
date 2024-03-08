<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        //dd($categories);
        return view('admin.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => "required",
        ]);

        $category = Category::create($data);
        return redirect()->route("categories.index");


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, Request $request)
    {
        //
        // $category = Category::findOrFail($id);
        $data = $request->validate([
            'name' => "required",
        ]);

        $category->update($data);

        return redirect()->route("categories.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete(); 
        return redirect()->route("categories.index");
    }

}
