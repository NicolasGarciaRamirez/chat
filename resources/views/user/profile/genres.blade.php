@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.profile._header', $user)
        <profile-genres />
    </div>
@endsection
