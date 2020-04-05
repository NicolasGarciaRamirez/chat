@extends('template.template')

@section('content')
    @include("user.contributor.head-profile")
    <div id="app">
        <div class="row mt-5">
            <div class="col">
                <div class="collapse multi-collapse" id="profile">
                    <profile :user="{{ $user }}" />
                </div>
            </div>
        </div>
        
        <div class="row container mt-2">
            <div class="col">
                <a class="btn bg-black text-white border-bottom" data-toggle="collapse" href="#channel" role="button" aria-expanded="false" aria-controls="channel">channel</a>
                <a class="btn bg-black text-white border-bottom active" data-toggle="collapse" href="#profile" role="button" aria-expanded="false" aria-controls="profile">profile</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse .show" id="channel">
                    <channel />
                </div>
            </div>
        </div>
        
        
    </div>
@endsection

