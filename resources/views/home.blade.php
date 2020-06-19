@extends('template.template')

@section('content')
    <div class="container home">
        <home :posts="{{ $posts }}" :user="{{ $user }}"/>
    </div>
@endsection
