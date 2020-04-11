@extends('template.template')

@section('content')
    <div class="profile">
        @include("user.head-profile")
        <channel-edit />
    </div>
@endsection
