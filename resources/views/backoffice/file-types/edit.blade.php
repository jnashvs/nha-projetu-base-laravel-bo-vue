@extends('backoffice.layouts.master')

@section('content')
    <div class="file-types-area">
        {{$result ?? ''}}
        <filetypes-component data="{{$result}}" cancelurl="{{ route('file-types') }}"></filetypes-component>
    </div>
@endsection