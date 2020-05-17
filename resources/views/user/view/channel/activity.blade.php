@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile._header', $user)
        <div>
            <profile-activity :user="{{ $user }}" />
        </div>
    </div>
@endsection
