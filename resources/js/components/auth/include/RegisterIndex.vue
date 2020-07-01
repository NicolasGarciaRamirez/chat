<template>
    <section class="d-xl-flex justify-content-between pt-5">
        <div class="bg-third mr-5 border-danger p-4 text-center w-100 auth-type" v-if="type === 'Index'">
            <h4 class="mt-5 font-weight-bold">FREE USER</h4><br>
            <div class="divider free"></div>
            <div class="my-5">
                <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                <p class="text-left pl-5">Full access to the stream and all social activities such as live streaming, posting content, interacting with users, and financially supporting Contributors.</p>
            </div>
            <div>
                <img src="/images/icons/cancel.svg" alt="" class="float-left m-3 ">
                <p class="text-left c-fourth pl-5">Free users are unable to get financially supported or rewarded by other users.</p>
            </div>
            <button class="btn bg-fifth my-5 rounded-pill"><a href="/Register/Free" class="text-white no-underline rounded-pill">COUNT ME IN</a> </button>
        </div>
        <div class="mr-5 p-4 text-center content bg-primary w-100 auth-type" v-if="type === 'Free'">
            <div class="p-2 text-center">
                <h5 class="font-weight-bold">Free User Signup</h5>
                <form-sign-up :type="type"/>
            </div>
        </div>

        <div class="bg-third mr-5 border-danger p-4 text-center w-100 auth-type" v-if="type === 'Index' || type === 'Free'">
            <h3 class="mt-5 font-weight-bold">CONTRIBUTOR</h3><br>
            <h2 class="c-fifth font-weight-bold">FREE</h2>
            <h5 class="c-fifth font-weight-bold">UNTIL YOU START EARNING MONEY FROM USERS</h5>
            <small class="c-fifth my-3">(You don’t pay until you earn)</small><br>
            <small>It will be $6.99/m thereafter </small>
            <div class="divider my-3"></div>
            <div>
                <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                <p class="text-left pl-5">Full access to the stream and all social activities such as live streaming, posting content, interacting with users, and financially supporting Contributors.</p>
            </div>
            <div class="my-3">
                <img src="/images/icons/success.svg" alt="" class="float-left m-3">
                <p class="text-left pl-5">Unlock the SUPPORT & REWARD buttons so that users can financially support you</p>
            </div>
            <div>
                <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                <p class="text-left pl-5">0% Commision (Noisesharks doesn’t take a cut when you get supported or rewarded)</p>
            </div>
            <button class="btn bg-fifth text-white my-5 rounded-pill"><a href="/Register/Contributor" class="text-white no-underline">Become a Contributor</a></button>
        </div>
        <div class="justify-content-between bg-primary mr-3 ml-3 contributor-form w-100" v-if="type === 'Contributor'">
            <div class="p-3 text-center">
                <h5 class="font-weight-bold">Contributor User Signup</h5>
                <form-sign-up :type="type"/>
            </div>
            <div class="p-3">
                <form-sign-up-contributor :type="type"/>
            </div>
        </div>

        <div :class="[type === 'Contributor' ? 'w-50' : 'w-100', 'd-flex justify-content-center align-items-center auth-type for-music-company']">
            <h6 @click="showModalForMusicCompany"><a>FOR MUSIC COMPANIES ></a></h6>
        </div>
    </section>
</template>

<script>
    import FormSignUp from './FormSignUp'
    import FormSignUpContributor from './FormSignUpContributor'
    import ModalForMusicCompany from '../../ModalsCommingSoon/ModalForMusic'

    export default {
        props: ['type'],
        components: {
            FormSignUp,
            FormSignUpContributor,
            ModalForMusicCompany
        },
        methods:{
            showModalForMusicCompany(){
                $('#ModalForMusic').modal('show')
            }
        }
    }
</script>
