<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $posts = Post::all();
        return view('backend.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.post.add', ['categories' => $categories]);
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
            'title' => 'required',
            'category' => 'required',
            'details' => 'required',
        ]);
        //Post Thumbnail
        if($request->hasFile('thumbnail')){
            $imaget = $request->file('thumbnail');
            $reThumbImage = '/imgs/'.time().'-thumbnail'.'.'.$imaget->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $imaget->move($dest,$reThumbImage);
        }else{
            $reThumbImage = 'na';
        }

        //Post Full Image
        if($request->hasFile('full_image')){
            $imagef = $request->file('full_image');
            $reFullImage = '/imgs/'.time().'-full_image'.'.'.$imagef->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $imagef->move($dest,$reFullImage);
        }else{
            $reFullImage = 'na';
        }

        $post = Post::create([
            'user_id' => 0,
            'category_id' => $request->category,
            'title' => $request->title,
            'thumbnail' => $reThumbImage,
            'full_image' => $reFullImage,
            'details' => $request->details,
            'tags' => $request->tags,
        ]);

        return redirect('/admin/posts/create')->with(['success' => 'Data has been saved']);
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
        $post = Post::find($id);
        $categories = Category::all();
        if(is_null($post)){
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return view('backend.post.edit', ['post' => $post, 'categories' => $categories]);
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
            'title' => 'required',
            'category' => 'required',
            'details' => 'required',
        ]);
        //Post Thumbnail
        if($request->hasFile('thumbnail')){
            $imaget = $request->file('thumbnail');
            $reThumbImage = '/imgs/'.time().'-thumbnail'.'.'.$imaget->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $imaget->move($dest,$reThumbImage);
        }else{
            $reThumbImage = $request->old_thumbnail;
        }

        //Post Full Image
        if($request->hasFile('full_image')){
            $imagef = $request->file('full_image');
            $reFullImage = '/imgs/'.time().'-full_image'.'.'.$imagef->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $imagef->move($dest,$reFullImage);
        }else{
            $reFullImage = $request->old_full_image;
        }

        $post = Post::find($id);
        $post->update([
            'user_id' => 0,
            'category_id' => $request->category,
            'title' => $request->title,
            'thumbnail' => $reThumbImage,
            'full_image' => $reFullImage,
            'details' => $request->details,
            'tags' => $request->tags,
        ]);
        

        return redirect('/admin/posts/'.$id.'/edit')->with(['success' => 'Data has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(is_null($post)){
            return response()->json(['message' => 'data not found'], 404);
        }
        $post->delete();

        return redirect('/admin/posts')->with(['success' => 'Data has been deleted']);
    }
}
