@extends('template.template')

@section('content')
    <div class="container home">
        <home :posts="{{ $posts }}" />
    </div>
@endsection
