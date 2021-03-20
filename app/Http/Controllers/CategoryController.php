<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.add');
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
            'title' => 'required'
        ]);

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $reImage = '/imgs/'.time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $image->move($dest,$reImage);
        }

        $category = Category::create([
            'title' => $request->title,
            'details' => $request->details,
            'image' => $reImage
        ]);

        return redirect('/admin/categories/create')->with(['success' => 'Data has been saved']);
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
        $category = Category::find($id);
        return view('backend.category.edit', ['category' => $category]);
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
        $request->validate([
            'title' => 'required'
        ]);

        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $reImage = '/imgs/'.time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $image->move($dest,$reImage);

        }else{
            $reImage = $request->old_image;
        }

        $category = Category::find($id);
        $category->update([
            'title' => $request->title,
            'details' => $request->details,
            'image' => $reImage
        ]);


        return redirect('/admin/categories')->with(['success' => 'Data has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(is_null($category)){
            return response()->json(['message' => 'data not found'], 404);
        }
        $category->delete();

        return redirect('/admin/categories')->with(['success' => 'Data has been deleted']);
    }
}
