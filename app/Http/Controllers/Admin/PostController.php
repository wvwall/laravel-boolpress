<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
Use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


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
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
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
            'category_id'=> 'exists:categories,id|nullable',
            'title'=> 'required|string|max:255',
            'content'=>'required|string',
            'cover'=>'image|max:500|nullable'
        ]);

        $data = $request->all();
        $cover = NULL;
        $cover = Storage::put('uplouds', $data['cover']);

        $post = new Post();
        $post->fill($data);

        $slug = Str::slug($post->title. '-' );
        $slug_base = $slug;
        $contatore = 1;
        $post_slug = Post::where('slug', '=', $slug)->first();
        while($post_slug) {
            $slug = $slug_base . '-' .$contatore;
            $contatore++;

            $post_slug = Post::where('slug', '=', $slug)->first();
        }
        $post->slug = $slug;
        $post->cover = 'storage/' . $cover;
        $post->save();

        Mail::to('mail@mail.it')->send(new SendNewMail());
        
        return redirect()->route('admin.posts.index');
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'exists:categories,id|nullable',
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            
            
        ]);

        $data = $request->all();

        /* $post = new Post(); */
        /* $post->fill($data); */

        /* $slug = Str::slug($post->title. '-' );
        $slug_base = $slug;
        $contatore = 1;
        $post_slug = Post::where('slug', '=', $slug)->first();
        while($post_slug) {
            $slug = $slug_base . '-' .$contatore;
            $contatore++;

            $post_slug = Post::where('slug', '=', $slug)->first();
        }
        $post->slug=$slug; */
        $post->update($data);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
