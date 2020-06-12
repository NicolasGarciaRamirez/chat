@extends('template.template')
@section('content')
<div class="container home">
    <post-view  :post="{{ $post }}">    
</div>
@endsection