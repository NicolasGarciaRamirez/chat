@extends('template.template')

@section('section')
    <div class="container">
        <password-reset :user={{ $user }} />
    </div>
@endsection