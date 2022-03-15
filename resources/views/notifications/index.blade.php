@extends('template.template')
@section('content')
    <div class="container home">
        <notifications :user_movile="{{\Auth::user()}}"></notifications>
    </div>
@endsection
