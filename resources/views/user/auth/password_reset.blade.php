@extends('template.template')

@section('content')
    <div class="container">
        <password-reset :user="{{ $user }}" />
    </div>
@endsection
