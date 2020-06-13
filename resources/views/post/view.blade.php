@extends('template.template')
@section('content')
<div class="container home">
    <div class="posts">
        <post :post="{{ $post }}" :view_comment=true />
    </div>
</div>
@endsection
