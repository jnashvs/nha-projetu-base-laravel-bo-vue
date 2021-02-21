@extends('backoffice.layouts.master')

@section('content')
    <div class="file-types-area">
        <filetypes-component cancelurl="{{ route('file-types') }}"></filetypes-component>
    </div>
@endsection