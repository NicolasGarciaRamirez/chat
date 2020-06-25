@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.profile._header', $user)
        <profile-social-media :user="{{ $user }}" />
    </div>
@endsection
