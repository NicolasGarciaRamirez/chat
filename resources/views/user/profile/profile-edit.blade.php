@extends('template.template')

@section('content')
    <div class="profile bg-black">
        <div>
            @include("user._header-profile", $user)
        </div>
        <profile-edit class="bg-black" :user="{{ $user }}" />
    </div>
@endsection
