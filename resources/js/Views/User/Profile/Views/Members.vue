<template>
    <section class="members container-fluid">
        <div class="d-flex flex-column p-1" v-if="current_members.length > 0">
            <h3 class="font-weight-bold text-white">Current Members:</h3>
            <div v-for="(member, index) in current_members" :key="index">
                <div>
                    <label class="text-white">{{ member.role_instrument }} : </label> <b class="c-fourth font-weight-bold"><a @click="windowReplace(member.link_profile)" class="c-fourth">{{ member.member_name }}</a></b><br>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mt-4 p-1" v-if="past_members.length > 0">
            <h3 class="font-weight-bold text-white">Past Members:</h3>
            <div v-for="(member, index) in past_members" :key="index">
                <div>
                    <label class="text-white">{{ member.role_instrument }} : </label> <b class="c-fourth font-weight-bold"><a @click="windowReplace(member.link_profile)" class="c-fourth">{{ member.member_name }}</a></b><br>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['user'],
    data(){
        return {
            current_members:[],
            past_members:[]
        }
    },
    mounted(){
        this.getUser()
    },
    methods:{
        getUser(){
            this.user.profile_information.members.map(val =>{
                if (val.member_type === 'current') {
                    this.current_members.push(val)
                }
                if (val.member_type === 'past') {
                    this.past_members.push(val)
                }
            })
        },
        windowReplace(url){
            window.location.replace(url)
        }
    }
}
</script>
