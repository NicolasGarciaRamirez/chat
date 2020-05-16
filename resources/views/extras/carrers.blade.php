@extends('template.template')

@section('content')
<div class="carrers">
        <div class="c-head">
            <h1 class="font-weight-bold">If you want to have an impact on the
                music industry...<br> <label class="c-fifth">Then this is where you belong!</label> 
            </div>
        </h1>
        <div class="c-body">
            <br>
            <div>
                <div class="text-center my-5">
                    <h2 class="font-weight-bold">What we're currently looking for</h2><br>
                </div>
            </div>
            <div class="box">
                <div class="text-center box-shadow">
                    <div class="card-body">
                        <img src="/images/icons/laptop.svg" alt="" class="icon"><br><br>
                        <p>Web Development</p><br>
                        <button class="btn bg-fifth text-white">Learn More</button>
                    </div>
                </div>
                <div class="text-center box-shadow">
                    <div class="card-body">
                        <img src="/images/icons/design.svg" alt="" class="icon"><br><br>
                        <p>UI/IX Design</p><br>
                        <button class="btn bg-fifth text-white">Learn More</button>
                    </div>
                </div>
                <div class="text-center box-shadow">
                    <div class="card-body">
                        <img src="/images/icons/megaphone.svg" alt="" class="icon"><br><br>
                        <p>Marketing</p><br>
                        <button class="btn bg-fifth text-white">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection