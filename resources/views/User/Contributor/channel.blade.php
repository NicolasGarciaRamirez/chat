@extends('template.template')

@section('content')
    @include('user.contributor.channel')
    <div id="app">
        <channel />
    </div>
@endsection