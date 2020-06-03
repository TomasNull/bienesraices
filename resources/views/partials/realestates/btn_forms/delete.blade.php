<form action="{{ route('realestates.destroy', $estate->slug) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger text-white" type="submit">
        <i class="fa fa-trash"></i> {{ __("Eliminar publicación") }}
    </button>
</form>