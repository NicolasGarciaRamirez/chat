@extends('template.template')

@section('content')
<div class="container-profile">
    @include("user.contributor.head-profile")
    <div class="body-container">

        <div id="app">
            <div class="row mt-2">
                <div class="nav">
                    <h2>
                        <a class=" bg-black text-white" data-toggle="collapse" href="#channel" role="button" aria-expanded="false" aria-controls="channel">Channel</a>
                    </h2>
                    <h2>
                        <a class=" bg-black text-white ml-5 " data-toggle="collapse" href="#profile" role="button" aria-expanded="false" aria-controls="profile">Profile</a>
                    </h2>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="collapse" id="profile">
                        <div class="container-body">
                            <profile :user="{{ $user }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="collapse show" id="channel">
                        <channel />
                    </div>
                </div>
            </div>
            {{-- <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Simple collapsible</button>
            <div id="demo" class="collapse">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div> --}}
            
        </div>
    </div>
    
</div>
@endsection