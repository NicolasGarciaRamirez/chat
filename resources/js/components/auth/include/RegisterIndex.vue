<template>
    <section>
        <div class="d-flex flex-row align-items-start contain">
            <div class="bg-third flex-column mr-5 border-danger p-4 text-center content" v-if="singupFree">
                <h4 class="mt-5  font-weigh-bold">FREE USER</h4><br>
                <div class="divider free"></div>
                <div>
                    <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                    <p class="my-5 text-left pl-5">
                        Full access to the stream and all social
                        activities such as live streaming, posting
                        content, interacting with users, and 
                        financially supporting Contributors.
                    </p>
                </div>
                <div>
                    <img src="/images/icons/cancel.svg" alt="" class="float-left m-3 ">
                    <p class="my-5 text-left c-fourth">
                        Free users are unable to get financially
                        supported or rewarded by other users.
                    </p>
                </div>
                <button class="btn bg-fifth text-white my-4" @click="showComponents('free')">COUNT ME IN</button>
            </div>

            <div class="flex-column mr-5 p-4 text-center content bg-primary" v-if="singupFreeForm">
                <form-singup />
            </div>

            <div class="bg-third flex-column mr-5 text-white border-danger p-4 text-center content" v-if="singupContributor">
                <h4 class="mt-5">CONTRIBUTOR</h4><br>
                <h2 class="c-fifth">FREE</h2>
                <h5 class="c-fifth">UNTIL YOU START EARNING MONEY FROM USERS</h5>
                <small class="c-fifth my-3">(You don’t pay until you earn)</small><br>
                <small>It will be $6.99/m thereafter </small>
                <div class="divider my-3"></div>
                <div>
                    <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                    <p class="text-left pl-5">
                        Full access to the stream and all social
                        activities such as live streaming, posting
                        content, interacting with users, and 
                        financially supporting Contributors.
                    </p>
                </div>
                <div>
                    <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                    <p class="text-left my-3">
                        Unlock the SUPPORT & REWARD buttons 
                        so that users can financially support you
                    </p>
                </div>
                <div>
                    <img src="/images/icons/success.svg" alt="" class="float-left m-3 ">
                    <p class="text-left">
                        0% Commision (Noisesharks doesn’t take
                        a cut when you get supported or rewarded)
                    </p>
                </div>
                <button class="btn bg-fifth text-white my-5"  @click="showComponents('contributor')">BECOME A CONTRIBUTOR</button>
            </div>

            <div class="d-flex flex-row justify-content-between bg-primary mr-3 ml-3" v-if="singupContributorForm">
                <form-singup />
                <form-singup-contributor />
            </div>

            <div class=" flex-column align-items-center content">
                <h6 class="for-music"><a>FOR MUSIC COMPANIES ></a></h6>
            </div>
        </div>
    </section>
</template>

<script>
import FormSingup from './FormSingup'
import FormSingupContributor from './FormSingupContributor' 
export default {
    data(){
        return {
            singupFree: true,
            singupFreeForm: false,
            singupContributor: true,
            singupContributorForm: false,
        }
    },
    components:{
        FormSingup,
        FormSingupContributor
    },
    methods:{
        showComponents(name){
            if (name == 'free') {
                this.singupFreeForm = true
                this.singupFree = false
            }else if(name == 'contributor'){
                this.singupContributorForm = true
                this.singupContributor = false
                this.singupFreeForm = false
                this.singupFree = false
            }
        }
    }
}
</script>