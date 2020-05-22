@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.profile._header')
        <profile-work-history />
    </div>
@endsection
