@extends('backoffice.layouts.master')

@section('content')

<h3>Tipos de Ficheiro</h3>

<p class="my-4">
    <a class="btn btn-primary float-right my-2" href="{{route('edit-file-types')}}">Criar</a>
</p>

<p class="mb-4">
    @include('backoffice.partials.success', ['status'=> isset($status) ? $status : ''])
</p>

<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Título</th>
        <th>Directorio</th>
        <th>Extensão</th>
        <th>Tamanho max.</th>
        <th>Criado Em</th>
        <th class="w-10px"></th>
        <th class="w-10px"></th>
    </thead>
    <tbody>
        @if ($fileTypes->count() == 0)
        <tr>
            <td colspan="8">No records.</td>
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
            <td><a class="btn btn-primary" href="{{route('edit-file-types', $item->id)}}"><i class="fa fa-pen" aria-hidden="true"></i></a></td>

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


