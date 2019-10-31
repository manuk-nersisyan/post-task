<form method="post" action="{{ route('delete-post',['id'=>$post->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn  btn-danger ">
        {{ __('Delete') }}
    </button>
</form>
