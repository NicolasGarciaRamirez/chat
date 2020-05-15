@extends('user.profile.template.template')

@section('content')
    <div class="profile">
        <div>
            @include("user.head-profile", $user)
        </div>
        <profile-edit :user="{{ $user }}"/>
    </div>
@endsection