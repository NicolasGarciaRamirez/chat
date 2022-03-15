<template>
    <div class="modal fade modal-same-email" role="dialog" aria-labelledby="ModalSameEmail" aria-hidden="true" id="ModalSameEmail">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <h4 class="c-mustard font-weight-bold">Same Email, Different Method!</h4>
                </div>
                <div class="modal-body justify-content-center align-items-center p-4">
                    <div class="d-flex flex-column justify-content-start">
                        <p>
                            You've created your Noisesharks account
                            <b class="text-white">[Insert email]</b> using
                            <b class="text-white">{{dataProvider.provider_name}}!</b>
                        </p>
                        <div class="d-flex flex-column social-login px-5">
                            <a href="/auth/facebook" class="btn bg-facebook rounded-pill text-white" v-if="dataProvider.provider_name === 'FacebookProvider'">Facebook Quick Login</a>
                            <a href="/auth/twitter" class="btn bg-twitter rounded-pill text-white my-3" v-if="dataProvider.provider_name === 'TwitterProvider'">Twitter Quick Login</a>
                            <a href="/auth/google" class="btn bg-google rounded-pill c-fifth" v-if="dataProvider.provider_name === 'GoogleProvider'">Google Quick Login</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4">
                    <p>If you need any more help regarding this matter please don't hesitate to
                        <a href="/help" class="underline">contact support!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalSameEmail",
        props: ['message'],
        computed:{
            dataProvider() {
                if (this.message !== null && this.message !== undefined) {
                    return this.message
                }else{
                    return {
                        provider_name:''
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
