@extends('template.template')

@section('content')
    <div class="container-fluid">
        @include("user.head-profile")
        <profile />
    </div>
@endsection
