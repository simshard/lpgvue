<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the posts
        $posts = Post::paginate(5);
        // dd($posts);
        // Return collection of posts as a resource
        $postres=PostResource::collection($posts);
        //dd($postres);
        return $postres;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  Allow for post update *or* create a new post
        $post        = $request->isMethod('put') ? Post::findOrFail($request->id) : new Post;

        $post->id    = $request->input('id');
        $post->title = $request->input('title');
        $post->body  = $request->input('body');

        if ($post->save()) {
            //$request->session()->flash('message', 'Post was successful!');


            return new PostResource($post);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Get a single post
        //$post = Post::findOrFail($id);

        // Return a single post as a resource
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Get the post
        // $post = Post::findOrFail($id);

        //  Delete the post, return as confirmation
        if ($post->delete()) {
            return new PostResource($post);
        }
    }
}
