<template>
    <section class="" ref="getMoreCredit">
        <div class="modal fade" z-index="1050" role="dialog" aria-labelledby="getMoreCredit" aria-hidden="true" id="getMoreCredit">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content modal-border-white  p-3">
                    <div class="modal-header border-0">
                        <div class="w-100 text-center">
                            <button type="button" class="close p-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                <h3><b>Get More Credit!</b></h3>
                                <p>Only contributors can use credits </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body p-1">
                        <div class="bg-third border-radius text-center p-3 mb-3">
                            <div class="d-flex flex-column mx-auto" >
                                <div class="banner mx-0 mt-0 mb-4 text-left" id="alert-marketing" style="background: linear-gradient( -60deg, #F1AD30 , #FD1734);">
                                    <span class="font-weight-bold">Get $5 credit when post your first video!</span>
                                </div>
                                <div class="text-left mb-3">
                                    <svg style="width: 20px; fill: currentColor; margin-right: .2rem; margin-bottom: .2rem;" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M14.3,18c-0.6,0.2-1,0.4-1.4,0.5 c-0.3,0.1-0.7,0.2-1.2,0.2c-0.7,0-1.2-0.2-1.6-0.5c-0.4-0.3-0.6-0.8-0.6-1.3c0-0.2,0-0.4,0-0.6c0-0.2,0.1-0.4,0.1-0.7l0.7-2.5 c0.1-0.2,0.1-0.5,0.2-0.7c0-0.2,0.1-0.4,0.1-0.6c0-0.3-0.1-0.5-0.2-0.7c-0.1-0.1-0.4-0.2-0.8-0.2c-0.2,0-0.4,0-0.6,0.1 c-0.2,0.1-0.4,0.1-0.5,0.2l0.2-0.8c0.5-0.2,0.9-0.4,1.3-0.5c0.4-0.1,0.8-0.2,1.2-0.2c0.7,0,1.2,0.2,1.6,0.5 c0.4,0.3,0.6,0.8,0.6,1.3c0,0.1,0,0.3,0,0.6c0,0.3-0.1,0.5-0.1,0.8l-0.7,2.5c-0.1,0.2-0.1,0.4-0.2,0.7c0,0.3-0.1,0.5-0.1,0.6 c0,0.3,0.1,0.6,0.2,0.7c0.1,0.1,0.4,0.2,0.8,0.2c0.2,0,0.4,0,0.6-0.1c0.2-0.1,0.4-0.1,0.5-0.2L14.3,18z M14.2,7.9 c-0.3,0.3-0.7,0.5-1.2,0.5c-0.5,0-0.9-0.2-1.2-0.5c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1c0.3-0.3,0.7-0.5,1.2-0.5 c0.5,0,0.9,0.2,1.2,0.5c0.3,0.3,0.5,0.7,0.5,1.1C14.7,7.2,14.5,7.6,14.2,7.9z"/> </svg>
                                    As we monitor our content, this credit will be withdraw if the content is non-music related or spammy. 
                                </div>
                                <a href="#" @click="getCreditFirstPost" class="mx-auto btn btn-outline-light rounded-pill">Get $5 credit</a>
                            </div>
                        </div>
                        <div class="px-3">
                            <hr class="divider">
                        </div>
                        <div class="bg-third border-radius text-center p-3 mb-3">
                            <div class="d-flex flex-column mx-auto">
                                <div class="banner mx-0 mt-0 mb-4 text-left" id="alert-marketing" style="background: linear-gradient( -60deg, #F1AD30 , #FD1734);">
                                    <span class="font-weight-bold">Get $1 credit if you post content this week! Renaws every monday!</span>
                                </div>
                                <div class="text-left mb-3">
                                    <svg style="width: 20px; fill: currentColor; margin-right: .2rem; margin-bottom: .2rem;" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M14.3,18c-0.6,0.2-1,0.4-1.4,0.5 c-0.3,0.1-0.7,0.2-1.2,0.2c-0.7,0-1.2-0.2-1.6-0.5c-0.4-0.3-0.6-0.8-0.6-1.3c0-0.2,0-0.4,0-0.6c0-0.2,0.1-0.4,0.1-0.7l0.7-2.5 c0.1-0.2,0.1-0.5,0.2-0.7c0-0.2,0.1-0.4,0.1-0.6c0-0.3-0.1-0.5-0.2-0.7c-0.1-0.1-0.4-0.2-0.8-0.2c-0.2,0-0.4,0-0.6,0.1 c-0.2,0.1-0.4,0.1-0.5,0.2l0.2-0.8c0.5-0.2,0.9-0.4,1.3-0.5c0.4-0.1,0.8-0.2,1.2-0.2c0.7,0,1.2,0.2,1.6,0.5 c0.4,0.3,0.6,0.8,0.6,1.3c0,0.1,0,0.3,0,0.6c0,0.3-0.1,0.5-0.1,0.8l-0.7,2.5c-0.1,0.2-0.1,0.4-0.2,0.7c0,0.3-0.1,0.5-0.1,0.6 c0,0.3,0.1,0.6,0.2,0.7c0.1,0.1,0.4,0.2,0.8,0.2c0.2,0,0.4,0,0.6-0.1c0.2-0.1,0.4-0.1,0.5-0.2L14.3,18z M14.2,7.9 c-0.3,0.3-0.7,0.5-1.2,0.5c-0.5,0-0.9-0.2-1.2-0.5c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1c0.3-0.3,0.7-0.5,1.2-0.5 c0.5,0,0.9,0.2,1.2,0.5c0.3,0.3,0.5,0.7,0.5,1.1C14.7,7.2,14.5,7.6,14.2,7.9z"/> </svg>
                                    As we monitor our content, this credit will be withdrawn if the content is non-music related or spammy.
                                </div>
                                <a href="#" @click="getOneCredit()" class="mx-auto btn btn-outline-light rounded-pill">Get $1 Credit</a>
                            </div>
                        </div>
                        <div class="px-3">
                            <hr class="divider">
                        </div>
                        <div class="bg-third border-radius text-center p-3 mb-3">
                            <div class="d-flex flex-column mx-auto">
                                <div class="banner mx-0 mt-0 mb-4 text-left" id="alert-marketing" style="background: linear-gradient(45deg,#f837ee 1.35%,#ffcd4b)">
                                    <span class="font-weight-bold">Add "Support me on Noisesharks" with a profile link in your instagram or other social media bio and get $1 credit everytime a user visits your Noisesharkks profile from there!</span>
                                </div>
                                <div class="text-left mb-3">
                                    <svg style="width: 20px; fill: currentColor; margin-right: .2rem; margin-bottom: .2rem;" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M14.3,18c-0.6,0.2-1,0.4-1.4,0.5 c-0.3,0.1-0.7,0.2-1.2,0.2c-0.7,0-1.2-0.2-1.6-0.5c-0.4-0.3-0.6-0.8-0.6-1.3c0-0.2,0-0.4,0-0.6c0-0.2,0.1-0.4,0.1-0.7l0.7-2.5 c0.1-0.2,0.1-0.5,0.2-0.7c0-0.2,0.1-0.4,0.1-0.6c0-0.3-0.1-0.5-0.2-0.7c-0.1-0.1-0.4-0.2-0.8-0.2c-0.2,0-0.4,0-0.6,0.1 c-0.2,0.1-0.4,0.1-0.5,0.2l0.2-0.8c0.5-0.2,0.9-0.4,1.3-0.5c0.4-0.1,0.8-0.2,1.2-0.2c0.7,0,1.2,0.2,1.6,0.5 c0.4,0.3,0.6,0.8,0.6,1.3c0,0.1,0,0.3,0,0.6c0,0.3-0.1,0.5-0.1,0.8l-0.7,2.5c-0.1,0.2-0.1,0.4-0.2,0.7c0,0.3-0.1,0.5-0.1,0.6 c0,0.3,0.1,0.6,0.2,0.7c0.1,0.1,0.4,0.2,0.8,0.2c0.2,0,0.4,0,0.6-0.1c0.2-0.1,0.4-0.1,0.5-0.2L14.3,18z M14.2,7.9 c-0.3,0.3-0.7,0.5-1.2,0.5c-0.5,0-0.9-0.2-1.2-0.5c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1c0.3-0.3,0.7-0.5,1.2-0.5 c0.5,0,0.9,0.2,1.2,0.5c0.3,0.3,0.5,0.7,0.5,1.1C14.7,7.2,14.5,7.6,14.2,7.9z"/> </svg>
                                    This user must either be an existing user or a user that signed up after they've visited your profile using the link you provided in your social bios.
                                </div>
                            </div>
                        </div>
                        <div class="px-3">
                            <hr class="divider">
                        </div>
                        <div class="bg-third border-radius text-center p-3 mb-3">
                            <div class="d-flex flex-column mx-auto">
                                <div class="banner mx-0 mt-0 mb-4 text-left" id="alert-marketing" style="background:linear-gradient(45deg,#2cf299,#0eb4d9 98.75%),#3dcda7;">
                                    <span class="font-weight-bold">Earn $10 credit everytime a user registers as contributor using your promo code. That user also gets $10 in credit on their signup!</span>
                                </div>
                                <div class="text-left mb-3">
                                    <svg style="width: 20px; fill: currentColor; margin-right: .2rem; margin-bottom: .2rem;" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M14.3,18c-0.6,0.2-1,0.4-1.4,0.5 c-0.3,0.1-0.7,0.2-1.2,0.2c-0.7,0-1.2-0.2-1.6-0.5c-0.4-0.3-0.6-0.8-0.6-1.3c0-0.2,0-0.4,0-0.6c0-0.2,0.1-0.4,0.1-0.7l0.7-2.5 c0.1-0.2,0.1-0.5,0.2-0.7c0-0.2,0.1-0.4,0.1-0.6c0-0.3-0.1-0.5-0.2-0.7c-0.1-0.1-0.4-0.2-0.8-0.2c-0.2,0-0.4,0-0.6,0.1 c-0.2,0.1-0.4,0.1-0.5,0.2l0.2-0.8c0.5-0.2,0.9-0.4,1.3-0.5c0.4-0.1,0.8-0.2,1.2-0.2c0.7,0,1.2,0.2,1.6,0.5 c0.4,0.3,0.6,0.8,0.6,1.3c0,0.1,0,0.3,0,0.6c0,0.3-0.1,0.5-0.1,0.8l-0.7,2.5c-0.1,0.2-0.1,0.4-0.2,0.7c0,0.3-0.1,0.5-0.1,0.6 c0,0.3,0.1,0.6,0.2,0.7c0.1,0.1,0.4,0.2,0.8,0.2c0.2,0,0.4,0,0.6-0.1c0.2-0.1,0.4-0.1,0.5-0.2L14.3,18z M14.2,7.9 c-0.3,0.3-0.7,0.5-1.2,0.5c-0.5,0-0.9-0.2-1.2-0.5c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1c0.3-0.3,0.7-0.5,1.2-0.5 c0.5,0,0.9,0.2,1.2,0.5c0.3,0.3,0.5,0.7,0.5,1.1C14.7,7.2,14.5,7.6,14.2,7.9z"/> </svg>
                                    This might mean tat they can become a contributor without paying the joining fee. <br> Click the button bellow to get your promo code.
                                </div>
                                <a href="#" @click="getPromoCode" class="mx-auto btn btn-outline-light rounded-pill">My Promo Code</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../../../helpers/Auth";
    export default {
        props:['user'],
        mounted() {
            Auth.initialize()
        },
        methods:{
            getOneCredit(){    
                if (this.user.one_credit_week){
                    swal('info', "You must meet the offer's condition in order for you to receive your desired credits", 'info');
                }else{
                    swal('info', "This credit is a once-a-week credit, it will refresh on Monday", 'info');
                }

            },
            getCreditFirstPost(){
                $("#getMoreCredit").modal("hide");
                if(this.user.your_first_post){
                    $("#CreditFirstPost").modal("show");
                }else{
                    swal('error', "you've already made your first post", 'error');
                }
                
            },

            async getPromoCode(){
                await axios.post(`/User/getPromoCode/${Auth.state.username}`).then(res => {
                    if (res.data.saved) {
                        
                        swal('success', "Your promo code is: "+res.data.code_generate, 'success');

                        setTimeout( window.location.replace(`/${res.data.user.username}/Channel/Activity/`), 20)
                    }else{
                        swal('error', "Your promo code is not generate", 'error');
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
