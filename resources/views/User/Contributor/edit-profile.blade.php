@extends('template.template')

@section('content')
    @include("user.contributor.head-profile")
    <div class="body-container">
        <profile />
    </div>
@endsection