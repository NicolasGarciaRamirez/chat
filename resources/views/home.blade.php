@extends('template.template')

@section('content')
    <div class="container home">
        <home :posts="{{ $posts }}" ref="home"/>
    </div>
@endsection

@section('scripts')
    <script>
        console.log($('.post-type-video').find('wave'))
    </script>
@endsection
