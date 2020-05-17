@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile._header')
        <profile-work-history />
    </div>
@endsection
