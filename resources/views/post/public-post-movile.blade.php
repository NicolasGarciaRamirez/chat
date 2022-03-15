@extends('template.template')

@section('content')
    <div class="nav-post-movile" id="nav-post-movile" style="position: static; display: inline">
        <div class="text-center">
            <public-post-movile user="{{\Auth::check() ? \Auth::user() : '{}'}}" type="{{$type}}" menuPublicPostMovile ref="publicPostMovile"></public-post-movile>
        </div>
        <!-- <div class="cap-close" v-on:click="close()"> </div> -->
    </div>
@endsection
