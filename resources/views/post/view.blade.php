@extends('template.template')

@section('metas')
    <meta property="og:url"                content="https://www.noisesharks.com/Post/{{$post->token}}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="🎹🦈Noisesharks {{$post->replace_caption}}" />
    <meta property="og:description"        content="{{$post->description ? $post->description : ''}}" />
    <meta property="og:image"              content="{{$post->resource_type === 'link' ? $post->thumbnail : 'https://www.noisesharks.com'.($post->thumbnail === '/images/default-video.svg' ? $post->user->cover : $post->thumbnail)}}" />

    <meta property="twitter:url"                content="https://www.noisesharks.com/Post/{{$post->token}}" />
    <meta property="twitter:type"               content="article" />
    <meta property="twitter:title"              content="🎹🦈Noisesharks {{$post->replace_caption}}" />
    <meta property="twitter:description"        content="{{$post->description ? $post->description : ''}}" />
    <meta property="twitter:image"              content="{{$post->resource_type === 'link' ? $post->thumbnail : 'https://www.noisesharks.com'.($post->thumbnail === '/images/default-video.svg' ? $post->user->cover : $post->thumbnail)}}"
@endsection

@section('content')
    <div class="container home">
        <div class="posts">
            <post :post="{{ $post }}" :view_comment=true ></post>
        </div>
        <modal-share-post :post="{{ $post }}"></modal-share-post>
        <modal-support ref="supportModal" :user="{{ $user }}" :post="{{ $post }}"></modal-support>
        <modal-reward ref="rewardModal" :user="{{ $user }}" :post="{{ $post }}"></modal-reward>
    </div>
@endsection
