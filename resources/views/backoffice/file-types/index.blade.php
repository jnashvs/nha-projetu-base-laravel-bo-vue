@extends('backoffice.layouts.master')

@section('content')

<h4>Tipos de Ficheiro</h4>
<h5>
    <a class="btn btn-primary float-right my-2" href="{{route('edit-file-types')}}">Criar</a>
</h5>

<br>
<p>
    @include('backoffice.partials.success', ['status'=> isset($status) ? $status : ''])
</p>
<br>

<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Título</th>
        <th>Directorio</th>
        <th>Extensão</th>
        <th>Tamanho max.</th>
        <th>Criado Em</th>
        <th>Acção</th>
    </thead>
    <tbody>
        @if ($fileTypes->count() == 0)
        <tr>
            <td colspan="5">No records.</td>
        </tr>
        @endif

        @foreach ($fileTypes as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->directory }}</td>
            <td>{{ $item->getTypes() }}</td>
            <td>{{ $item->max_file_size }}</td>
            <td>{{ $item->created_at }}</td>
            <td><a href="{{route('edit-file-types', $item->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i>edit</a></td>

            @include('backoffice.partials._delete-button', ['route'=> route('delete-file-types', ['id'=>$item->id, 'directory'=>$item->directory])])
        </tr>
        @endforeach
    </tbody>
</table>

{{ $fileTypes->links() }}

<p>
    Displaying {{$fileTypes->count()}} of {{ $fileTypes->total() }}
</p>

@endsection


