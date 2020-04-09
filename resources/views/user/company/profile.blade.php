@extends('template.template')

@section('content')
    <div class="container-fluid">
        @include('user.head-profile')
        <company-profile />
    </div>
@endsection