@extends('template.template')

@section('content')
    <div class="container-fluid">
        @include("user.contributor.head-profile")
            {{-- <div class="row m-3 border-butom">
                <div class="nav">
                    <h2 class="bg-black text-white nav-link active" data-toggle="collapse" href="#channel" aria-expanded="false" aria-controls="channel">Channel</h2>

                    <h2 class="bg-black text-white ml-5 nav-link" data-toggle="collapse" href="#profile" aria-expanded="false" aria-controls="profile">Profile</h2>
                </div>
            </div>
            <div class="collapse mt-5" id="profile">
                <profile  />
            </div>
            <div class="collapse show" id="channel">
                <channel />
            </div> --}}
            <profile />
    </div>
@endsection
