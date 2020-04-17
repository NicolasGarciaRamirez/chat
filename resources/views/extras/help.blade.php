@extends('template.template')

@section('content')
    <div class="help">
        <div class="c-head">
            <div class=" align-items-center">
                <h1>We would love to hear <br>
                    how we can <b class="c-fifth">help</b>!
                </h1>
            </div>
        </div>
        <div class="c-body text-center">
            <div class="img-bg-container">
            </div>
            <div class="container-form">
                <form action="/" >
                    <div class="form-input-group">
                        <input type="text" class="form-control my-5" placeholder="Name or User Name">
                        <input type="text" class="form-control my-5" placeholder="Subject">
                        <textarea cols="198" rows="8" class="form-control my-5"></textarea>
                        <input type="file" class="form-control my-5">
                        
                        <div class="d-flex justify-content-center my-4">
                            <button type="submit" class="btn bg-fifth text-white">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection