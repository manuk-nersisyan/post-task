@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Home
                    <div class="float-right">
                        <div class="btn-group">
                            <a href="{{route('create-post')}}" class="btn btn-primary" role="button" aria-pressed="true">Create Post</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($posts as $post)
                        <div class="col-md-12">
                            <a href="{{route('show-post', ['id' => $post->id])}}" class="list-group-item  btn ">
                                {{$post->title}}
                                @if($post->image != "")
                                    <img src="{{asset($post->image)}}" class="img-thumbnail" width="37" alt="Cinque Terre"  />
                                @endif
                            </a>
                        </div>
                        <br/>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
