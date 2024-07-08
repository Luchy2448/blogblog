<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke(){

        $categories = Category::all();

        // without GlobalScope $posts = Post::where('published', true)
        //with GlobalScope
        $posts = Post::
               //scopeFilter se define en Post.php
                filter(request()->all())
                ->orderBy('id', 'desc')
                ->paginate(10);
        return view('welcome', compact('posts', 'categories'));
    }
}
