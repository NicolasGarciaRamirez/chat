@extends('template.template')

@section('content')
    <div class=" home">
        <home :posts="{{ $posts }}" />
    </div>
@endsection
