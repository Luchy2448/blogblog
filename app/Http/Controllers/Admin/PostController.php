<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {   
        $posts = Post::where('user_id', auth()->id())
                     ->latest()
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
    {   
        // usamos este para saber quien esta intentando editar el post que no le corresponde
        // if(!Gate::allows('author', $post)){
        //     abort(403, 'No eres el autor de este post');
        // }
        // y usamos este para mostrar un mensaje
        $this->authorize('author', $post);
        
        $categories = Category::all();


        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //return  $request->all();

    //    dd($request->all());
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            //si el campo published es true, el campo excerpt es obligatorio sino es opcional
            'excerpt' => $request->published ? 'required' : 'nullable',
            'body' =>  $request->published ? 'required' : 'nullable',
            'published' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'image' => 'nullable|image',
        ]);

   
        $old_images = $post->images()->pluck('path')->toArray();

        $re_extractImages = '/src="["\']([^ ^"^\']*)["\']/ims';

        preg_match_all($re_extractImages, $request->body, $matches);
        $images = $matches[1];

        foreach($images as $key => $image){

            $images[$key] = 'images/' . pathinfo($image, PATHINFO_BASENAME);
        }

        $new_images = array_diff($images, $old_images);
        // dd ($new_images);
        $deleted_images = array_diff($old_images, $images);
// dd ($new_images);
        foreach($new_images as $image){

            $post->images()->create([
                'path' => $image
            ]);
            dd ($image);
        }

        foreach($deleted_images as $image){
            Storage::delete($image);
            Image::where('path', $image)->delete();
            // $post->images()->where('path', $image)->delete();
        }

        $data = $request->all();

        $tags = [];

        foreach($request->tags ?? [] as $name) // ?? [] si no hay tags, el array es vacío
        {
            $tag = Tag::firstOrCreate([
                'name' => $name
            ]);
            $tags[] = $tag->id;
        }

        // return $tags;

        $post->tags()->sync($tags);

        if($request->file('image')){
            if($post->image_path){
                Storage::delete($post->image_path);
            }
           
    $file_name = $request->slug . '.' . $request->file('image')->getClientOriginalExtension();
        //     // return $file_name; 
          
        $data['image_path'] = Storage::putFileAs('posts', $request->image, $file_name);
        // $data['image_path'] = $request->file('image')->storeAs('posts', $file_name);
    }

        $post->update($data);
    
    session()->flash('swal', [
        'icon' => 'success',
        'title' => '¡Bien hecho!',
        'text' => 'El artículo se actualizó correctamente',
    ]);
        return redirect()->route('admin.posts.edit', $post);
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
