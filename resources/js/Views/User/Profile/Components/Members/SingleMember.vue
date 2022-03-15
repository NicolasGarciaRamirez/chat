<template>
    <section>
        <div class="row pl-0 pl-lg-4">
            <div class="col-12 col-lg-3 p-0 mb-3 d-flex pr-1">
                <input type="text" class="form-control" placeholder="Member Name" v-model="member_update.member_name">
            </div>
            <div class="col-12 col-lg-3 p-0 mb-3 d-flex pr-1">
                <input type="text" class="form-control" placeholder="Role/Instrument" v-model="member_update.role_instrument">
            </div>
            <div class="col-12 col-lg-5 p-0 mb-3 d-flex pr-1">
                <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="member_update.link_profile">
            </div>
            <div class="col-12 col-lg-1 p-0 mb-3 d-flex cross-center">
                <svg  class="cursor-pointer icon-m icon-x" @click="removeMember"   version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1081 1080" xml:space="preserve"> <path fill="#535353" d="M540.44-0.32C242.12-0.32,0.28,241.52,0.28,539.84S242.12,1080,540.44,1080s540.16-241.84,540.16-540.16 S838.76-0.32,540.44-0.32z M796.11,711.25l-83.54,80.66L541.16,623.39L369.75,791.92l-81.38-80.66l169.25-171.41L288.36,368.43 l80.66-80.66L541.16,456.3l171.41-168.53l83.54,83.54L624.7,539.84L796.11,711.25z"/> </svg> 
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['member', 'index', 'type'],
        data(){
            return{
                member_update: {},
            }
        },
        mounted() {
            this.member_update = this.member
            this.getChanges()
        },
        methods:{
            removeMember(){
                let self = this
                if (this.type === 'current') { self.$parent.current_members.splice(this.index, 1) }
                else if (this.type === 'past') { self.$parent.past_members.splice(this.index, 1) }
                this.$parent.showAlertChange()
            },
            getChanges(){
                let fields = [
                    "input[type='text']"
                ]

                fields.forEach(field => {
                    $(field).on('change', (e) => {
                        this.$parent.showAlertChange()
                    })
                });
            },
        }
    }
</script>