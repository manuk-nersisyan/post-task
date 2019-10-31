@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Post
                    </div>
                    <div class="card-body">
                        @include('__forms.edit-post-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
