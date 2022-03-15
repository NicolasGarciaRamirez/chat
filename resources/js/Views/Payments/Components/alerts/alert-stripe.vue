<template>
    <div class="banner-stripe" v-if="location">
        <div>
            <span class="font-weight-bold"><span style="text-decoration: underline; font-weight: 900;">IMPORTANT!</span> You must create your Stripe account in order for other users to support you! Otherwise they will receive an error.</span>
        </div>
        <div class="buttons ">
            <button type="button" class="btn btn-sm rounded-pill mx-2" @click.prevent="showModalStripe('create')">Create Stripe Account</button>
            <button type="button" class="btn btn-sm rounded-pill" @click.prevent="showModalStripe('already')">Already Got An Account</button>
        </div>
    </div>
</template>

<script>
    import ModalStripe from '../ModalStripe'
    export default {
        name: "alert-stripe",
        components:{ModalStripe},
        data(){
            return {
                location: window.location.href === 'http://localhost:8000/' || window.location.href === 'https://www.noisesharks.com/' || window.location.href === 'https://www.noisesharks.com/#'
            }
        },
        methods:{
            showModalStripe(state) {
                if(state === 'create'){
                    $('#ModalStripe').modal('show')
                }else if(state === 'already'){
                    $('#ModalStripe').modal('show')

                    this.$root.$refs.modalStripe.$refs.slotContentInteractPayment.addClassSuccessOne()
                    this.$root.$refs.modalStripe.$refs.slotContentInteractPayment.success_one = true

                }
            },

        }
    }
</script>
