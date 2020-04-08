@extends('template.template')

@section('content')
    <div class="container-fluid">
        @include("user.contributor.head-profile")
        <profile />
    </div>
@endsection
