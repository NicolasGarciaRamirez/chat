@extends('template.template')

@section('content')
    @include("user.contributor.head-profile")
    <div class="body-container">
        <div id="app">
            <profile />
        </div>
    </div>
@endsection