<template>
    <section>
        <div class="row ">
            <div class="col-12 col-lg-3 p-0 mb-3 pr-lg-3 d-flex">
                <input class="form-control" type="text" placeholder="Tier Name" v-model="tier.name" required>
            </div>
            <div class="col-12 col-lg-3 p-0 mb-3 pr-lg-3 d-flex">
                <input class="form-control" type="number" placeholder="Amount" v-model="tier.amount" required>
            </div>
            <div class="col-12 col-lg-5 p-0 mb-3  pr-lg-3 d-flex">
                <input class="form-control" type="text" placeholder="Tier Description" v-model="tier.description" required>
            </div>
            <div class="col-12 col-lg-1 p-0 mb-3 d-flex cross-center">
                <svg  class="cursor-pointer icon-m icon-x" @click="removeTier"   version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1081 1080" xml:space="preserve"> <path fill="#535353" d="M540.44-0.32C242.12-0.32,0.28,241.52,0.28,539.84S242.12,1080,540.44,1080s540.16-241.84,540.16-540.16 S838.76-0.32,540.44-0.32z M796.11,711.25l-83.54,80.66L541.16,623.39L369.75,791.92l-81.38-80.66l169.25-171.41L288.36,368.43 l80.66-80.66L541.16,456.3l171.41-168.53l83.54,83.54L624.7,539.84L796.11,711.25z"/> </svg> 
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../../../helpers/Auth";

    export default {
        props:['tier', 'index'],
        name: "SingleTier",
        mounted(){
            Auth.initialize()
        },
        methods:{
            removeTier(){
                Auth.setSession()
                if(this.tier.id){
                    axios.post(`/${Auth.state.username}/Channel/Tiers/Delete/${this.tier.id}`).then(res =>{
                        if(res.data.deleted){
                            this.$parent.channel_information.tiers.splice(this.index, 1)
                        }
                    }).catch(err =>{Auth.keepLogged(err.response.status)})
                }else{
                    this.$parent.channel_information.tiers.splice(this.index, 1)
                }
            }
        }
    }
</script>
