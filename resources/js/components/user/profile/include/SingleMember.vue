<template>
    <section>
        <!-- <div class="d-flex flex-row mb-5"> -->
            <div class="form-group row">
                <div class="col-md">
                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="member_update.member_name">
                </div>
                <div class="col-md">
                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="member_update.role_instrument">
                </div>
                <div class="col-md">
                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="member_update.link_profile">
                </div>
            </div>
        <!-- </div> -->
    </section>
</template>

<script>
export default {
        props: ['member', 'index'],
        data(){
            return{
                member_update: {},
            }
        },
        mounted() {
            this.member_update = this.member
        },
}
</script>
