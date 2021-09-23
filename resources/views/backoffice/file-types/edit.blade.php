@extends('backoffice.layouts.master')

@section('content')

<div class="titulo mb-4">
<h4>{{$filetypes->id ? 'Editar' : 'Criar' }} Tipos de Ficheiro</h4>
</div>

<div class="container file-types">

        @open(['model' => $filetypes, 'route' => ['file.types.store', 'id' => $filetypes->id]])
        
        @hidden('id')

        @text('title')
        
        @text('directory')

        <div class="file-types-area">
            <filetypes-component input-name="extensions" data="{{$filetypes}}" errors={{$errors}}></filetypes-component>
        </div>

        @number('max_file_size')

        @submit('Guardar')
        @close

</div>

@endsection