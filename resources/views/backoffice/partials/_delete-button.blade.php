<td>
    <form method="POST" action="{{ $route }}" accept-charset="UTF-8" style="display:inline" class="delete-form">
        <input name="_method" type="hidden" value="DELETE">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar">
            <i class="fa fa-times"></i>
        </button>
    </form>
</td>