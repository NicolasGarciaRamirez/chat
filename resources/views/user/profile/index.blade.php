@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.profile._header', $user)
        <profile-index :user="{{ $user }}" />
    </div>
@endsection
