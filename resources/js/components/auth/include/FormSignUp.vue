<template>
    <div class="p-2">
        <div class="alert bg-fifth text-white" v-if="backend_errors != null">
            <ul class="p-0 m-0 list-style-none">
                <li v-for="(error, index) in backend_errors" :key="index">{{ error[0] }}</li>
            </ul>
        </div>
        <form @submit.prevent="save" autocomplete="off" class="c-fifth">
            <div class="form-group row mx-0">
                <div class="col mr-1 p-0">
                    <span>{{ errors.first('first_name') }}</span>
                    <input type="text" class="form-control"  name="first_name"  placeholder="First Name" v-model="user.first_name" v-validate="'required|alpha'" required/>
                </div>
                <div class="col ml-1 p-0">
                    <span>{{ errors.first('last_name') }}</span>
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" v-model="user.last_name" v-validate="'required|alpha'" required/>
                </div>
            </div>
            <div class="form-group">
                <span>{{ errors.first('email') }}</span>
                <input type="email" class="form-control mb-3" name="email" placeholder="Email Address" v-model="user.email" v-validate="'required|email'" ref="email" required>
                <span>{{ errors.first('email_confirmation') }}</span>
                <input type="email" class="form-control mb-3" name="email_confirmation" placeholder="Confirm Email Address" v-model="user.email_confirmation" v-validate="'required|email|confirmed:email'" data-vv-as="email" required>
                <span>{{ errors.first('password') }}</span>
                <input type="password" class="form-control mb-3" name="password" placeholder="Password" v-model="user.password" v-validate="'required|verify_password'" ref="password" required>
                <span>{{ errors.first('password_confirmation') }}</span>
                <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="Confirm Password" v-model="user.password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" required>
            </div>
            <div class="m-2 p-0 d-flex justify-content-center">
                <button type="submit" class="btn bg-fifth text-white sign-up font-weight-bold rounded-pill w-100 sign-up">Sign Up</button>
            </div>
            <div class="py-3">
                <p class="text-center or text-white">OR</p>
            </div>
            <div class="d-flex flex-column social-login">
                <a href="#" class="btn bg-facebook text-white">Facebook Quick Signup</a>
                <a href="#" class="btn bg-twitter text-white my-3">Twitter Quick Signup</a>
                <a href="#" class="btn bg-white c-fifth">Google Quick Signup</a>
            </div>
        </form>
        <p class="c-fourth text-center mt-3 mb-5">By logging in up you are agreeing to Noisesharks’ <a href="/terms" class="c-fourth"><b>Terms of Use</b></a>, <a href="#" class="c-fourth"><b>Privacy Policy</b></a> , & <a href="#" class="c-fourth"><b>Copyright Policy</b></a></p>
    </div>
</template>

<script>
    import { Validator } from 'vee-validate'
    import Auth from '../../../helpers/Auth'
    Validator.extend('verify_password', {
        validate: value => {
            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");
            return strongRegex.test(value);
        },
        getMessage: 'The password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number'
    })

    const dictionary = {
        en: {
            attributes: {
                first_name: 'first name',
                last_name: 'last name',
                email_confirmation: 'email confirmation',
                password_confirmation: 'password'
            }
        }
    };
    Validator.localize(dictionary);

    export default {
        props: ['type'],
        data() {
            return {
                user: {
                    avatar: "Profile/default.png",
                    first_name: "",
                    last_name: "",
                    email: "",
                    email_confirmation: "",
                    password: "",
                    password_confirmation: "",
                    personal_information: {
                        profile_type: 'N/A',
                        title: 'N/A',
                        artistic_name: 'N/A',
                        about_you: 'N/A',
                        members: {
                            current_members: {
                                member_name_1: 'N/A',
                                role_instrument_1: 'N/A',
                                link_noisesharks_profile_1: 'N/A',
                                member_name_2: 'N/A',
                                role_instrument_2: 'N/A',
                                link_noisesharks_profile_2: 'N/A',
                                member_name_3: 'N/A',
                                role_instrument_3: 'N/A',
                                link_noisesharks_profile_3: 'N/A',
                                member_name_4: 'N/A',
                                role_instrument_4: 'N/A',
                                link_noisesharks_profile_4: 'N/A'
                            },
                            former_members: {
                                member_name_1: 'N/A',
                                role_instrument_1: 'N/A',
                                link_noisesharks_profile_1: 'N/A',
                                member_name_2: 'N/A',
                                role_instrument_2: 'N/A',
                                link_noisesharks_profile_2: 'N/A',
                                member_name_3: 'N/A',
                                role_instrument_3: 'N/A',
                                link_noisesharks_profile_3: 'N/A',
                                member_name_4: 'N/A',
                                role_instrument_4: 'N/A',
                                link_noisesharks_profile_4: 'N/A'
                            }
                        },
                        releases: {
                            image: '/images/profile/default.png',
                            artist_name: 'N/A',
                            album_name: 'N/A',
                            genre: 'N/A',
                            release_date: 'N/A',
                            label: 'N/A',
                            // credits: 'N/A'
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
                },
                backend_errors: null
            }
        },
        methods: {
            save() {
                this.$validator.validate().then(valid => {
                    if (!valid) {
                       return false
                    }
                    this.user.subscription_type = this.type
                    axios.post(`/Register`, this.user).then(res => {
                        if (res.data.saved) {
                            Auth.setAuthUser(res.data.user.username)
                            alert('user create successfull')
                            window.location.replace(`/${res.data.user.username}/Profile/Releases`)
                        }
                    }).catch(err => {
                        this.backend_errors = err.response.data.errors
                    })
                });
            }
        }
    }
</script>
