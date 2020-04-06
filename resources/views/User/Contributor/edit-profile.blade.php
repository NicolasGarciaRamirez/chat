@extends('template.template')

@section('content')
    @include('user.contributor.channel')
    <div id="app">
        <profile />
    </div>
@endsection