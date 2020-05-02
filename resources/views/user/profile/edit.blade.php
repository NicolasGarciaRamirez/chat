@extends('template.template')

@section('content')
    <div class="profile">
        @include("user.head-profile", $user)
        <profile-edit :user="{{ $user }}"/>
    </div>
@endsection
