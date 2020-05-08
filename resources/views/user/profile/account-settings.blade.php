@extends('user.profile.template.template')

@section('content')
    <div class="profile">
        <account-settings :user="{{ $user }}"/>
    </div>
@endsection