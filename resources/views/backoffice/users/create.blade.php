@extends('backoffice.layouts.master')

@section('content')
<h3>Utilizadores</h3>

<p class="mb-4">
    @include('backoffice.partials.success', ['status'=> isset($status) ? $status : ''])
</p>

<div class="container-create-user mt-4">

    @open(['model' => $user, 'route' => 'user-manegement.store'])

    @text('name', 'Nome')

    @email('email', 'E-mail')

    @password('password', 'Palavra-passe')

    @password('password_confirmation', 'Confirmação da Palavra-passe')

    @submit('Guardar')
    @close

</div>

@endsection