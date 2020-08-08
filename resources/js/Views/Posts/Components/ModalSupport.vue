<template>
    <div class="modal fade modal-support" role="dialog" aria-labelledby="modalSupport" aria-hidden="true" id="modalSupport">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content modal-border-white" v-if="user">
                <div class="modal-header border-0 p-0">
                    <img :src="`${user.cover}`" class="img-fluid support-brand-header ">
                    <div class="head-content d-flex">
                        <img :src="`${user.avatar}`" alt="" class="support-img-profile rounded-pill">
                        <div class="d-flex flex-column p-md-3">
                            <a href="/View/Profile/Releases" class="text-white support-user-name">{{user.profile_information && user.profile_information.artistic_name ? user.profile_information.artistic_name : user.personal_information.full_name }}<img src="/images/icons/check.svg" alt="" class="check-icon mx-2" v-if="user.verification_date"></a>
                            <div class="d-flex flex-row justify-content-center align-items-center support-user-type">
                                <button class="btn bg-fifth text-white mr-2 font-weigh-bold">{{user.profile_information && user.profile_information.title ? user.profile_information.title : 'title profile not choseen'}}</button>
                                <button class="btn bg-white c-fifth d-flex align-items-center justify-content-center font-weigh-bold" v-if="user.subscription_type === 'CONTRIBUTOR'">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column my-5">
                            <h4 class="font-weigh-bold text-center">Monthly Support</h4>
                            <p>
                                By selecting one of the teirs below, you will directly support <b class="text-white font-weigh-bold"> {{user.profile_information && user.profile_information.artistic_name ? user.profile_information.artistic_name : user.personal_information.full_name }}</b>  ﬁnancially.
                                This support will auto renew once every month. Noisesharks DOES NOT take any cut from
                                this support.
                            </p>
                        </div>
                        <div class="divider"></div>
                        <div class="d-flex text-center flex-column my-5">
                            <h4 class="font-weigh-bold">Why Support Channel?</h4>
                            <p>I help msuic enthusiasts to ﬁnd financial settelment or growth</p>
                        </div>
                        <div class="divider"></div>
                        <div class="d-flex flex-column my-5 text-center align-items-center">
                            <h4>What Will Supporters Get?</h4><br>
                            <b>The Nickels</b><br>
                            <p>
                                For the $1 supporters I will send give you  a
                                shoutout and mentions when you comment
                                on my content
                            </p><br>
                            <button class="btn bg-fifth rounded-pill text-white font-weigh-bold">$1</button><br>
                        </div>
                        <div class="divider"></div>
                        <div class="d-flex flex-column text-center my-5 align-items-center">
                            <h4 class="font-weigh-bold">The Platinums</h4><br>
                            <p>
                                For the $1 supporters I will send give you  a
                                shoutout and mentions when you comment
                                on my content
                            </p><br>
                            <button class="btn bg-fifth rounded-pill text-white font-weigh-bold">$4.99</button><br>
                        </div>
                        <div class="divider"></div>
                        <div class="d-flex flex-column text-center my-5 align-items-center">
                            <h4 class="font-weigh-bold">The Golds</h4><br>
                            <p>
                                For the $1 supporters I will send give you  a
                                shoutout and mentions when you comment
                                on my content
                            </p><br>
                            <button class="btn bg-fifth rounded-pill text-white font-weigh-bold">$7.77</button><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['user']
}
</script>
