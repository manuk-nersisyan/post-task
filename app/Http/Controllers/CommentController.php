<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        return view('comment.create',compact('post_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        Comment::create(['text' => $request->get('text'),
                        'post_id' => $request->get('post_id'),
                        'user_id' => Auth::id(),
                        ]);
        return redirect()->route('show-post', ['id' => $request->get('post_id')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == Auth::id())
            $comment->update(['text' => $request->get('text')]);
        return redirect()->route('show-post',['id' => $comment->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post_id = $comment->post_id;
        if ($comment->user_id == Auth::id()){
            $comment->delete();
        }
        return redirect()->route('show-post', ['id' => $post_id]);
    }
}
