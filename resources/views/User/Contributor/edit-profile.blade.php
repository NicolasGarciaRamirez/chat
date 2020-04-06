@extends('template.template')

@section('content')
    @include('user.contributor.head-profile')
    <div id="app">
        <profile />
    </div>
@endsection