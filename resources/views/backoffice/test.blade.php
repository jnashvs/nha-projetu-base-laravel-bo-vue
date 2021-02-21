@extends('backoffice.layouts.master')

@section('content')
<div class="container">
    <div class="row">
    @open(['route' => 'testpost', 'method' => 'POST', 'id' => 'users-search-form'])
        @text('login')
        @email('email')
        @php($options = ['foo' => 'Foo', 'bar' => 'Bar', 'baz' => 'Baz'])

        <!-- Simple input -->
        @select('select', null, $options, null, ['custom' => true])

        vue select

        <filetypes-component></filetypes-component>

        @textarea('text')
        @checkbox('remember_me', null, 1, null, ['switch' => true, 'inline' => true])
        @submit('Login')
        @close

    </div>
</div>
@endsection