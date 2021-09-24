@extends('backoffice.layouts.master')

@section('content')

<div class="files-area">
    <p>
        <h3 class="mb-4">Ficheiros</h3>
    </p>
    <dropzone-component>
        <select class="form-control" onchange="location = this.value;">
            <option value="#" selected="selected">Mudar de ficheiro</option>
            @foreach($filetypes as $item)
            <option value="{{route('files', ['directory'=>$item->directory])}}">{{$item->directory}}</option>
            @endforeach
        </select>
    </dropzone-component>
</div>
@endsection