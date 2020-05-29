@extends('template.template')

@section('content')
    <div class="profile">
        <div>
            @include("user._header-profile", $user)
        </div>
        <channel-activity :user="{{ $user }}" />
    </div>
@endsection
