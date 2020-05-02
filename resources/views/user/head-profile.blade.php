<div class="img-container">
    <img src="/images/portada.jpg" alt="ImagePortada" class="img-portada img-fluid">
    <img src="/images/profile.jpg" alt="ImagePortada" class="img-profile rounded-circle">
</div>
<div class="head-container align-items-center">
    <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2">
        <a href="/Profile/Edit" class="btn bg-black rounded-pill mr-2 text-white">Edit Profile <i class="cil-pencil ml-2"></i></a>
        <a href="#" class="btn bg-black rounded-pill mr-2 text-white">Share Profile <i class="cil-share  ml-2"></i></a>
        <a href="/View/Profile/Releases" class="btn bg-black rounded-pill text-white">Preview Profile</a>
    </div>
    <div>
        <h2 class="font-weight-bold">{{ $user->personal_information->full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
        <div class="d-flex">
            <a href="#" class="btn bg-danger text-white mr-3">{{ $user->personal_information->title }}</a>
            @if ($user->suscription_type  == 'CONTRIBUTOR')
                <a href="#" class="btn bg-white c-fifth">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" ></a>
            @endif
        </div>
    </div>
</div>
