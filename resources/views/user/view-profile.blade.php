@extends('template.template')

@section('content')
    <div class="profile">
        @include('user.head-profile')
    </div>
    <div class="container-fluid">
        <view-profile />
    </div>
@endsection