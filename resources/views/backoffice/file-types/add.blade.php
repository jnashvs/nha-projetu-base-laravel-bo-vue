@extends('backoffice.layouts.master')

@section('content')

<div class="container file-types-add">

        @open(['route' => 'testpost', 'method' => 'POST', 'id' => 'users-search-form'])
        @text('login')

        <div class="file-types-area">
            <filetypes-component input-name="file_type"></filetypes-component>
        </div>

        @text('text')

        @submit('Submit form')
        @close

</div>

@endsection