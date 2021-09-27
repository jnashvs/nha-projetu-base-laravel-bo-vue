@extends('backoffice.layouts.master')

@section('content')
<div class="titulo mb-4">
<h4>{{isset($user->id) ? 'Editar' : 'Criar' }} Utilizador</h4>
</div>

<p class="mb-4">
    @include('backoffice.partials.success', ['status'=> isset($status) ? $status : ''])
</p>

<div class="container-create-user mt-4">

    @open(['model' => $user, 'route' => 'user-manegement.store'])

    @hidden('id')

    @text('name', 'Nome')

    @email('email', 'E-mail')

    @password('password', 'Palavra-passe')

    @password('password_confirmation', 'Confirmação da Palavra-passe')

    @submit('Guardar')
    @close

</div>

@endsection