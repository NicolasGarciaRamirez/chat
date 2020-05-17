@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile._header', $user)
        <profile-releases v-bind:user="{{ $user }}" />
    </div>
@endsection
