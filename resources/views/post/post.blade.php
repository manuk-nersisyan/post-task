@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Show Post
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
                                <a href="#" class="btn btn-primary" role="button" aria-pressed="true">Create comment</a>
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
                </div>
            </div>
        </div>
    </div>
@endsection
