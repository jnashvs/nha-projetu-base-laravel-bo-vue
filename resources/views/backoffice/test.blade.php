@extends('backoffice.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        @open(['route' => 'testpost', 'method' => 'POST', 'id' => 'users-search-form'])
        @text('login')

        <!-- <filetypes-component></filetypes-component> -->

        <!-- <my-input init-postcode="" select-value=""></my-input> -->

<div class="row">
            <bo-file-input bo-file-input="" placeholder="Imagem candidato" input-name="candidatos_img" directory="candidatos" />

</div>
<br>
        @textarea('text')

        @submit('Submit form')
        @close

    </div>
</div>
@endsection