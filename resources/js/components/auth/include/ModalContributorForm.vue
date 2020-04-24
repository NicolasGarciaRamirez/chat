<template>
    <div class="modal fade modal-contributor-form" role="dialog" aria-labelledby="ModalContributorForm" aria-hidden="true" id="ModalContributorForm">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-body pt-4">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="d-flex flex-column p-4">
                            <h5 class="text-center">FREE USER SIGNUP</h5>
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
                        <div class="d-flex flex-column ml-5 p-4">
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            user:{
                first_name:'',
                last_name:'',
                email:'',
                confirm_email:'',
                password: '',
                confirm_password: ''
            }
        }
    }
}
</script>