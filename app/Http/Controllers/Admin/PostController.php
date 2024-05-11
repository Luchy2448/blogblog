<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {   
        $posts = Post::latest()
                     ->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required|exists:categories,id',
        ]);
        $post = Post::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El artículo se creó correctamente',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   $categories = Category::all();
        $tags = Tag::all();


        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        // return  dd($request->all());
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            //si el campo published es true, el campo excerpt es obligatorio sino es opcional
            'excerpt' => $request->published ? 'required' : 'nullable',
            'body' =>  $request->published ? 'required' : 'nullable',
            'published' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);
        $post->tags()->sync($request->tags);

        $post->update($request->all());
    
    session()->flash('swal', [
        'icon' => 'success',
        'title' => '¡Bien hecho!',
        'text' => 'El artículo se actualizó correctamente',
    ]);
        return redirect()->route('admin.posts.index', $post);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se eliminó correctamente',
        ]);
        return redirect()->route('admin.posts.index');
    }
}
