@extends('backoffice.layouts.master')

@section('content')
<h3>Utilizadores</h3>

<p class="my-4">
    <a class="btn btn-primary float-right my-2" href="{{route('user-manegement.create')}}">Criar</a>
</p>

<p class="mb-4">
    @include('backoffice.partials.success', ['status'=> isset($status) ? $status : ''])
</p>

@foreach ($errors->all() as $error)
   <li>{{ $error }}</li>
@endforeach

<table class="table table-striped">
    <thead>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Criado Em</th>
        <th class="w-10px"></th>
        <th class="w-10px"></th>
    </thead>
    <tbody>
        @if ($users->count() == 0)
        <tr>
            <td colspan="5">No records.</td>
        </tr>
        @endif

        @foreach ($users as $user)
        <tr>
            <td>{{ $user->getName() }}</td>
            <td>{{ $user->getEmail() }}</td>
            <td>{{ $user->getCreatedAt() }}</td>
            <td><a class="btn btn-primary" href="{{route('user-manegement.edit', $user->getId() )}}"><i class="fa fa-pen" aria-hidden="true"></i></a></td>
            @include('backoffice.partials._delete-button', ['route'=> route('user-manegement.destroy', $user->getId())])
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}

<p>
    Displaying {{$users->count()}} of {{ $users->total() }}
</p>

@endsection


