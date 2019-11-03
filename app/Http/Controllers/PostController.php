<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(3);
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $name = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'images/'.time() . '.' . ($image->getClientOriginalName());
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        Post::create(['title'=> $request->get('title'),
                      'text'=> $request->get('text'),
                      "image"=> ($name !== "") ? $name : null,
                      'user_id' => Auth::id()
                 ]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $post = Post::with(['comments' => function ($query) {
//                             $query->orderBy('created_at','DESC')->paginate(2);
//                        }])->findOrFail($id);

        $post = Post::query()->find($id);
        $comments = $post->comments()->with(['user'])->orderBy('created_at','DESC')->paginate(3);
        return view('post.post', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $image_path = $post->image;
        if ($post->user_id == Auth::id()){
            if ($request->hasFile('image')) {
                if(\File::exists(public_path($image_path))) {
                    \File::delete(public_path(($image_path)));
                }
                $image = $request->file('image');
                $image_path = 'images/'.time() . '.' . ($image->getClientOriginalName());
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $image_path);
            }
            $post->update(['title'=> $request->get('title'),
                            'text'=> $request->get('text'),
                            "image"=> $image_path,
                        ]);
        }
        return redirect()->route('show-post',['id'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id == Auth::id()){
            if ($post->image != null){
                if(\File::exists(public_path($post->image))) {
                    \File::delete(public_path(($post->image)));
                }
            }
            $post->delete();
        }
        return redirect()->route('home');
    }
}
