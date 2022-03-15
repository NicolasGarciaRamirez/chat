@extends('template.template')

@section('content')
    <div class="profile">
        <account-settings :user="{{ $user }}" ref="AccountSettings"></account-settings>
    </div>
@endsection
