@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Post
                        <div class="float-right">
                            @if($post->user_id == Auth::id())
                                <div class="btn-group">
                                    <a href="{{route('edit-post',['id'=>$post->id])}}" class="btn btn-primary" role="button" aria-pressed="true">Edit</a>
                                </div>
                                <div class="btn-group ">
                                    @include('__forms.delete-post-form')
                                </div>
                            @endif
                            <div class="btn-group">
                                <a href="{{route('create-comment',['post_id'=>$post->id])}}" class="btn btn-primary" role="button" aria-pressed="true">Create comment</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if($post->image != "")
                                <img src="{{asset($post->image)}}" class="img-thumbnail float-right" width="310"  alt="Cinque Terre"  />
                            @endif
                               <h1>{{$post->title}}</h1>
                               <p>{{$post->text}}</p>
                         </div>
                    </div>
                    @if($comments->count() != 0)
                    <hr>
                    <div class="col-md-12">
                    <h1 class="text-center">Comments</h1>
                        @foreach($comments as $comment)
                        <div class="card-deck">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <h6>{{ucfirst($comment->user->name)." ".ucfirst($comment->user->surname)}}</h6>
                                    <p class="card-text">{{$comment->text}}</p>
                                    @if($comment->user_id == Auth::id())
                                        <div class="float-right">
                                            <div class="btn-group">
                                                <a href="{{route('edit-comment',['id'=>$comment->id])}}" class="btn btn-primary" role="button" aria-pressed="true" >Edit</a>
                                            </div>
                                            <div class="btn-group ">
                                                @include('__forms.delete-comment-form')
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        @endforeach
                        {{ $comments->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
