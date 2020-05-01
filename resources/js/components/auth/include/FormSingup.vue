<template>
  <div class="p-2">
    <h5 class="text-center">FREE USER SIGNUP</h5>
      <form @submit.prevent="valdationForm" autocomplete="off" class="c-fifth">
        <div class="d-flex justify-content-between">
            <validation-provider rules="required" v-slot="{ errors }" class=" mr-3">
                <input  type="text" class="form-control" placeholder="First Name" v-model="user.first_name"  />
                <span>{{ errors[0] }}</span>
            </validation-provider>
            <validation-provider rules="required" v-slot="{ errors }" class="">
                <input  name="last_name" type="text" class="form-control" placeholder="Last Name" v-model="user.last_name" />
                <span>{{ errors[0] }}</span>
            </validation-provider>
        </div>
        <ValidationObserver>
            <ValidationProvider rules="required|email" v-slot={errors}>
                <input  type="email" class="form-control my-3" placeholder="Email Address" name="email" v-model="user.email" > 
                <span>{{ errors[0] }}</span>
            </ValidationProvider>
            <ValidationProvider rules="required|email" v-slot={errors}> 
                <input  type="email" class="form-control " placeholder="Confirm Email Address" name="confirm_email" v-model="user.confirm_email" >
                <span>{{ errors[0] }}</span>
            </ValidationProvider>
        </ValidationObserver>
        <ValidationProvider v-slot="{errors}" rules="required">
            <input  type="password" class="form-control my-3" placeholder="Password" v-model="user.password" >    
            <span>{{ errors[0] }}</span>            
        </ValidationProvider>
        <ValidationProvider v-slot="{errors}" rules="required">
            <input  type="password" class="form-control" placeholder="Confirm Password" v-model="user.confirm_password" >
            <span>{{ errors[0] }}</span>
        </ValidationProvider>
        
        <div class="mt-2 p-2 d-flex justify-content-center">
            <button type="submit" class="btn bg-fifth text-white sign-up ">Sign Up</button>
        </div>
    </form>
    <div><p class="text-center or">OR</p></div>
    <div class="d-flex flex-column social-login">
        <a href="#" class="btn bg-facebook text-white">Facebook Quick Singup</a>
        <a href="#" class="btn bg-twitter text-white my-3">Twitter Quick Singup</a>
        <a href="#" class="btn bg-white c-fifth">Google Quick Singup</a>
    </div>
    <p class="c-fourth text-center mt-3 mb-5">By loging in up you are agreeing to Noisesharks’ Terms of Use, Privacy Policy, & Copyright Policy</p>
  </div>
</template>

<script>

import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules'

extend('required', {
  ...required,
  message: 'the field is required'
});
extend('email', {
    ...email,
    message: 'the email is not valid'
});
export default {
    data(){
        return {
            user:{
                first_name:"",
                last_name:"",
                email:"",
                confirm_email:"",
                password: "",
                confirm_password: "",
                vemail: false,
                vpassword: false,
                personal_information:{
                    profile_type: 'N/A',
                    title: 'N/A',
                    artistic_name: 'N/A',
                    about_you: 'N/A',
                    members: {
                        current_members:{
                            member_name_1: 'N/A',
                            role_instrument_1:'N/A',
                            link_noisesharks_profile_1:'N/A',
                            member_name_2: 'N/A',
                            role_instrument_2:'N/A',
                            link_noisesharks_profile_2:'N/A',
                            member_name_3: 'N/A',
                            role_instrument_3:'N/A',
                            link_noisesharks_profile_3:'N/A',
                            member_name_4: 'N/A',
                            role_instrument_4:'N/A',
                            link_noisesharks_profile_4:'N/A'
                        },
                        former_members:{
                            member_name_1: 'N/A',
                            role_instrument_1:'N/A',
                            link_noisesharks_profile_1:'N/A',
                            member_name_2: 'N/A',
                            role_instrument_2:'N/A',
                            link_noisesharks_profile_2:'N/A',
                            member_name_3: 'N/A',
                            role_instrument_3:'N/A',
                            link_noisesharks_profile_3:'N/A',
                            member_name_4: 'N/A',
                            role_instrument_4:'N/A',
                            link_noisesharks_profile_4:'N/A'
                        }
                    },
                    releases: {
                        artist:'N/A',
                        album:'N/A',
                        genre:'N/A',
                        release_date: 'N/A',
                        label:'N/A',
                        credits:'N/A'
                    },
                    worked_with: 'N/A',
                    genre: 'N/A',
                    services: 'N/A',
                    social_media: {
                        Youtube: 'N/A',
                        Twitch: 'N/A',
                        Instagram: 'N/A',
                        Facebook: 'N/A',
                        TikTok: 'N/A',
                        LinkedIn: 'N/A',
                        SnapChat: 'N/A',
                        SoundCloud: 'N/A',
                        Bandcamp: 'N/A',
                        Spotify: 'N/A',
                    }
                }
            }
        }
    },
    components:{
        ValidationProvider,
        ValidationObserver
    },
    methods:{
        valdationForm(){
            if (this.user.email == this.user.confirm_email){
                this.user.vemail = true
            }
            if (this.user.password == this.user.confirm_password) {
                this.user.vpassword = true                
            }  
            
            if (!this.user.vemail) {
                alert("the emails not match")
                // return;
            }
            if (!this.user.vpassword){
                alert('the passwords not match')
                // return;
            }
            if (this.user.vemail && this.user.vpassword) {
                this.save()
            }
        },
        save(){
            axios.post(`/Register`, this.user).then(res => {
                if (res.data.saved) {   
                    alert('user create successfull')
                    window.location.replace('/Profile/Edit')
                }else{
                    alert('ERROR 500')
                }
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>