@extends('template.template')

@section('content')
    <div class="profile">
        @include("user.head-profile")
        <channel-activity />
    </div>
@endsection
