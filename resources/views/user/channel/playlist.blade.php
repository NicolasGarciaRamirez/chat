@extends('template.template')

@section('content')
    <div class="profile">
        <div>
            @include("user._header-profile", $user)
        </div>
    </div>
    <div>
        <playlist :playlist="{{ $playlist }}">
    </div>
@endsection