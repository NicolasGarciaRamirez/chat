@extends('template.template')

@section('content')
    <div class="cross-center flex-column" style="min-height: 80vh">
        <p>Please verify your email address</p>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                A new verification link has been sent to your email address.
            </div>
        @endif
        Before continuing, please check your email for a verification link. If you didn't receive the email,
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline c-fifth">Click here to request another</button>.
        </form>
    </div>
@endsection
