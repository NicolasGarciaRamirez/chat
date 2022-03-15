@extends('template.template')

@section('content')
<div class="container-fluid register">

    @if(session()->has('message_danger'))
        <div class="container alert alert-danger alert-dismissible bg-fifth border-0 py-4 my-1 position-fixed w-25" role="alert" style="left: 0; right: 0">
            <p class="text-white text-center m-0">{{ Session::get('message_danger') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('message_danger_provider'))
        <div class="container alert alert-danger alert-dismissible bg-fifth border-0 py-4 my-1 position-fixed w-25" role="alert" style="left: 0; right: 0">
            <p class="text-white text-center m-0">{{ Session::get('message_danger_provider') }} <a href="/login">login </a> to that profile?</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>

    @endif

    <register-index type="{{ $type }}" subscription_type="{{ $subscription_type }}" ref="RegisterIndex"></register-index>
</div>
@endsection
