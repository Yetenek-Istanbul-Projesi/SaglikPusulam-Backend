<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    // Blog sayfalarını görüntüleme
    public function index()
    {
        $posts = Post::all();
        return view('pages.blog', compact('posts'));
    }

    // Blog sayfasını görüntüleme
    public function show(string $slug) 
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        // Diğer 11 yazıyı al
        $otherPosts = Post::where('slug', '!=', $slug)->take(11)->get();
        
        return view('pages.blog-page', compact('post', 'otherPosts'));
    }
}
