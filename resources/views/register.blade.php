@extends('template.template')

@section('content')
    <div class="container-fluid register">
        <div class="d-flex flex-row align-items-start contain">
            <div class="bg-third flex-column mr-5 border-danger p-4 text-center content">
                <h4 class="mt-5">FREE USER</h4><bR>
                <div class="divider"></div>
                <p class="my-5 text-left">
                    Full access to the stream and all social
                    activities such as live streaming, posting
                    content, interacting with users, and 
                    financially supporting Contributors.
                </p>
                <p class="my-5 text-left">
                    Free users are unable to get financially
                    supported or rewarded by other users.
                </p>
                <button class="btn bg-fifth text-white">COUNT ME IN</button>
            </div>
            <div class="bg-third flex-column mr-5 text-white border-danger p-4 text-center content">
                <h4 class="mt-5">CONTRIBUTOR</h4><br>
                <h2 class="c-fifth">FREE</h2>
                <h5 class="c-fifth">UNTIL YOU START EARNING MONEY FROM USERS</h5>
                <small class="c-fifth my-3">(You don’t pay until you earn)</small><br>
                <small>It will be $6.99/m thereafter </small>
                <div class="divider my-3"></div>
                <p class="text-left">
                    Full access to the stream and all social
                    activities such as live streaming, posting
                    content, interacting with users, and 
                    financially supporting Contributors.
                </p>
                <p class="text-left my-3">
                    Unlock the SUPPORT & REWARD buttons 
                    so that users can financially support you
                </p>
                <p class="text-left">
                    0% Commision (Noisesharks doesn’t take
                    a cut when you get supported or rewarded)
                </p>
                <button class="btn bg-fifth text-white my-3">BECOME A CONTRIBUTOR</button>
            </div>
            <div class=" flex-column align-items-center content">
                <h6 class="for-music"><a>FOR MUSIC COMPANIES</a></h6>
            </div>
        </div>
    </div>
@endsection