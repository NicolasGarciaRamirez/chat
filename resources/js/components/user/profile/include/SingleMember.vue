<template>
    <section>
        <div class="form-group row c-fifth">
            <div class="col-md">
                <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="member_update.member_name">
            </div>
            *
            <div class="col-md">
                <input type="text" class="form-control" placeholder="Role/Instrument" v-model="member_update.role_instrument">
            </div>
            *
            <div class="col-md">
                <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="member_update.link_profile">
            </div>
            <i class="fas fa-times-circle c-fourth align-items-center pointer" @click="removeMember"></i>
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
        },
        methods:{
            removeMember(){
                var self = this
                if (this.type == 'current') {
                    self.$parent.current_members.splice(this.index, 1)
                }
                if (this.type == 'past') {
                    self.$parent.past_members.splice(this.index, 1)
                }
            }
        }
}
</script>
