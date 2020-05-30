@extends('template.template')

@section('content')
    <div class="container home">
        <validate-login :user="{{ $user }}" />
    </div>
@endsection
