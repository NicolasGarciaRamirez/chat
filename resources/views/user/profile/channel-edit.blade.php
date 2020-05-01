@extends('template.template')

@section('content')
    <div class="profile">
        @include("user.head-profile", $user)
        <channel-edit :user="{{ $user }}" />
    </div>
@endsection
