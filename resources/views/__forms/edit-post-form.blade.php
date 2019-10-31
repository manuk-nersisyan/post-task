<form method="post" enctype="multipart/form-data" action="{{ route('update-post',['id'=>$post->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ (old('title'))? old('title') : $post->title}}" required autocomplete="title">

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Text') }}</label>

        <div class="col-md-6">
            <textarea class="form-control @error('text') is-invalid @enderror" rows="5" id="text" name="text" required autocomplete="text">{{  (old('text'))? old('text') : $post->text}}</textarea>

            @error('text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Custom file') }}</label>

        <div class="col-md-6">
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror"
                       id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
            @error('image')
            <span class="invalid-feedback" role="alert" style="display:block;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
    </div>
</form>
