<form method="post" action="{{ route('delete-comment',['id'=>$comment->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn  btn-danger ">
        {{ __('Delete') }}
    </button>
</form>
