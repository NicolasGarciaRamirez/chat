@extends('template.template')

@section('content')
    <div class="help">
        <div class="c-head">
            <div class=" align-items-center p-1">
                <h1 class="font-weight-bold">We would love to hear all of your
                    new ideas! we read them all!
                </h1>
            </div>
        </div>
        <div class="c-body text-center">
            <div class="img-bg-container"></div>
            <div class="container-form">
                @if(Session::get('error') !== null)
                    <div class="alert">
                        {{Session::get('error')}}
                    </div>
                @endif
                @if(Session::get('success') !== null)
                    <div class="alert bg-gradient-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <form method="POST" action="/Suggestions/Save" accept-charset="UTF-8" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-input-group d-flex flex-column justify-content-start c-fifth">
                        <div class="d-flex flex-row align-items-center">
                            <input type="text" class="form-control p-3 m-0" name="name" placeholder="Name or User Name" /> <span class="ml-1">*</span>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <input type="text" class="form-control my-4 p-3" name="subject" placeholder="Give this feature a name!" /> <span class="ml-1">*</span>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <textarea name="message" class="form-control p-3 m-0" placeholder="What’s the feature that would like Noisesharks to have? Go wild!!"></textarea> <span class="ml-1">*</span>
                        </div>
                        <label for="file" class="cursor-pointer">
                            <div class="text-left pl-2 bg-third my-4 p-2 rounded-pill c-fourth file" value="Add attachments (e.g. screenshots, or pdfs)" disabled>Add attachments (e.g. screenshots, or pdfs)</div>
                        </label>
                        <input type="file" id="file" name="file" class="d-none">

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn rounded-pill bg-fifth text-white font-weight-bold">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
