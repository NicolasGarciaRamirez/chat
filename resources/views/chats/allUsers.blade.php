@extends('template.template')

@section('content')
    <div>
        <chat :users="{{$users}}"></chat>
    </div>
@endsection
