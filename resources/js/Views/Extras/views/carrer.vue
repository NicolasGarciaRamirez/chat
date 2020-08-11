<template>
    <div class="carrers">
        <div class="c-head">
            <h1 class="font-weight-bold">If you want to have an impact on the
                music industry...<br><span class="c-fifth m-0">Then this is where you belong!</span>
            </h1>
        </div>
        <div class="c-body">
            <img src="/images/icons/sharks.svg" class="sharks text-center">
            <br>
            <div>
                <div class="text-center">
                    <h2 class="font-weight-bold">What we're currently looking for</h2><br>
                </div>
            </div>
            <div class="box">
                <div class="text-center box-shadow p-2 m-auto">
                    <div class="card-body">
                        <img src="/images/icons/laptop.svg" alt="" class="icon"><br><br>
                        <p class="font-weight-bold">Web Development</p><br>
                        <button class="btn rounded-pill bg-fifth text-white font-weight-bold" @click="alert()">Learn More</button>
                    </div>
                </div>
                <div class="text-center box-shadow p-2 m-auto">
                    <div class="card-body">
                        <img src="/images/icons/design.svg" alt="" class="icon"><br><br>
                        <p class="font-weight-bold">UI/IX Design</p><br>
                        <button class="btn rounded-pill bg-fifth text-white font-weight-bold" @click="alert()">Learn More</button>
                    </div>
                </div>
                <div class="text-center box-shadow p-2 m-auto">
                    <div class="card-body">
                        <img src="/images/icons/megaphone.svg" alt="" class="icon"><br><br>
                        <p class="font-weight-bold">Marketing</p><br>
                        <button type="button" class="btn rounded-pill bg-fifth text-white font-weight-bold" @click="alert()" >Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "carrer",
        methods:{
            alert(){
                swal({
                    text:   'Are you an expert web developer? Please send us why would you like to be a part of Noisesharks in addidtion to your CV here: Carrers@noisesharks.com',
                    className: 'swal-alert',
                    buttons: [false,'Ok'],
                    dangerMode: true,
                })
            }
        }

    }
</script>
