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

            <div class="bg-third flex-column mr-5 p-4 text-center content bg-primary" v-if="singupFreeForm">
                <h5 class="text-center">FREE USER SIGNUP</h5><br>
                <form @submit.prevent="verifyCredentials" autocomplete="off">
                    <div class="d-flex justify-content-between">
                        <input  type="text" class="form-control mr-5" placeholder="First Name" v-model="user.first_name" required>
                        <input  type="text" class="form-control" placeholder="Last Name" v-model="user.last_name" required>
                    </div>
                    <input type="email" class="form-control my-3" placeholder="Email Address" v-model="user.email" required>
                    <input type="email" class="form-control " placeholder="Confirm Email Address" v-model="user.confirm_email">
                    <input type="password" class="form-control my-3" placeholder="Password" v-model="user.password"  required>
                    <input type="password" class="form-control" placeholder="Confirm Password" v-model="user.confirm_password" required>
                    <div class="mt-2 p-2 d-flex justify-content-center">
                        <button type="submit" class="btn bg-fifth text-white sign-up ">Sign Up</button>
                    </div>
                </form><br>
                <div><p class="text-center or">OR</p></div><br>
                <div class="d-flex flex-column social-login">
                    <a href="#" class="btn bg-facebook text-white">Facebook Quick Singup</a>
                    <a href="#" class="btn bg-twitter text-white my-3">Twitter Quick Singup</a>
                    <a href="#" class="btn bg-white c-fifth">Google Quick Singup</a>
                </div>
                <p class="c-fourth text-center mt-3 mb-5">By loging in up you are agreeing to Noisesharks’ Terms of Use, Privacy Policy, & Copyright Policy</p>

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
                <div class="d-flex flex-column p-5">
                    <h5 class="text-center">CONTRIBUTOR SIGNUP</h5>
                    <form @submit.prevent="verifyCredentials" autocomplete="off">
                        <div class="d-flex justify-content-between">
                            <input  type="text" class="form-control mr-5" placeholder="First Name" v-model="user.first_name" required>
                            <input  type="text" class="form-control" placeholder="Last Name" v-model="user.last_name" required>
                        </div>
                        <input type="email" class="form-control my-3" placeholder="Email Address" v-model="user.email" required>
                        <input type="email" class="form-control " placeholder="Confirm Email Address" v-model="user.confirm_email">
                        <input type="password" class="form-control my-3" placeholder="Password" v-model="user.password"  required>
                        <input type="password" class="form-control" placeholder="Confirm Password" v-model="user.confirm_password" required>
                    </form>
                    <div><p class="text-center or">OR</p></div>
                    <div class="d-flex flex-column social-login">
                        <a href="#" class="btn bg-facebook text-white rounded-pill">Facebook Quick Singup</a>
                        <a href="#" class="btn bg-twitter text-white my-3 rounded-pill">Twitter Quick Singup</a>
                        <a href="#" class="btn bg-white c-fifth rounded-pill">Google Quick Singup</a>
                    </div>
                    <p class="c-fourth text-center mt-3 mb-5">By loging in up you are agreeing to Noisesharks’ Terms of Use, Privacy Policy, & Copyright Policy</p>
                </div>
                <div class="d-flex flex-column ml-5 p-5">
                    <p>
                        REMEMBER!: You don’t stprt paying until you get
                        financially supported or rewarded by a user
                    </p>
                    <input type="text" class="form-control my-3" placeholder="Name on Bank Account">
                    <input type="text" class="form-control" placeholder="Account Number">
                    <input type="text" class="form-control my-3" placeholder="Sort Code">
                    <span class="c-secondary">
                        To check your bank account, we will send you
                        $1.00. If the account was correct, we will charge
                        you that $1.00 back
                    </span>
                    <button class="btn bg-fifth text-white my-3 rounded-pill">Check Bank Account</button>
                    <button class="btn text-white bg-third rounded-pill">Sing Up</button>
                </div>
            </div>

            <div class=" flex-column align-items-center content">
                <h6 class="for-music"><a>FOR MUSIC COMPANIES ></a></h6>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return {
            singupFree: true,
            singupFreeForm: false,
            singupContributor: true,
            singupContributorForm: false,
            user:{
                first_name:'',
                last_name:'',
                email:'',
                confirm_email:'',
                password: '',
                confirm_password: ''
            },

        }
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