@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile.header', $user)
        <div>
            <profile-activity :user="{{ $user }}" />
        </div>
    </div>
@endsection