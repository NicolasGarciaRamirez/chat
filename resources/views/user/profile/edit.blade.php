@extends('template.template')

@section('content')
    <div class="profile">
        @include("user.head-profile")
        <profile-edit />
    </div>
@endsection
