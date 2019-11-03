<form method="POST" action="{{ route('update-comment',['id' => $comment->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Text') }}</label>

        <div class="col-md-6">
            <textarea class="form-control @error('text') is-invalid @enderror" rows="5" id="text" name="text" required autocomplete="text">{{  (old('text'))? old('text') : $comment->text}}</textarea>

            @error('text')
            <span class="invalid-feedback" role="alert">
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
