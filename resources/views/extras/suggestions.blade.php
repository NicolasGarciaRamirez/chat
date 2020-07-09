@extends('template.template')

@section('content')
    <div class="help">
        <div class="c-head">
            <div class=" align-items-center pt-5">
                <h1 class="font-weight-bold font-5xl">We would love to hear all of your<br>
                    new ideas! we read them all!
                </h1>
            </div>
        </div>
        <div class="c-body text-center">
            <div class="img-bg-container"></div>
            <div class="container-form">
                <form method="POST" action="/Suggestions/Save" >
                    @csrf
                    <div class="form-input-group d-flex flex-column justify-content-start">
                        <input type="text" class="form-control my-4 p-3" name="name" placeholder="Name or User Name">
                        <input type="text" class="form-control p-3" name="subject" placeholder="Give this feature a name!">
                        <textarea cols="198" rows="30" name="message" class="form-control my-4 p-3" placeholder="What’s the feature that would like Noisesharks to have? Go wild!!"></textarea>
                        <label for="file" class="cursor-pointer">
                            <div class="text-left pl-2 bg-third my-4 p-2 rounded-pill c-fourth w-50" value="Add attachments (e.g. screenshots, or pdfs)" disabled>Add attachments (e.g. screenshots, or pdfs)</div>
                        </label>
                        <input type="file" id="file" name="file" class="form-control my-4 w-25 p-3 d-none">

                        <div class="d-flex justify-content-center my-4">
                            <button type="submit" class="btn bg-fifth text-white">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
