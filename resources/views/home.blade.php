@extends('template.template')

@section('content')
    <div class="container home">
        <home :posts="{{ $posts }}" ref="home"/>
    </div>
@endsection
