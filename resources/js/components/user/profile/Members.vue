<template>
    <section class="members container-fluid">
        <div class="d-flex flex-column">
            <h3 class="font-weight-bold text-white">Current Members:</h3><br>
            <div>
                <label class="text-white">{{ members.current_members.role_instrument_1 }} </label> <b class="c-fourth font-weight-bold">{{ members.current_members.member_name_1 }}</b><br>
            </div>
            <div>
                <label class="text-white">{{ members.current_members.role_instrument_2 }}</label><b class="c-fourth font-weight-bold"> {{ members.current_members.member_name_2 }}</b><br>
            </div>
            <div>
                <label class="text-white">{{ members.current_members.role_instrument_3 }}</label><b class="c-fourth font-weight-bold">{{ members.current_members.member_name_3 }}</b><br>
            </div>
            <div>
                <label class="text-white">{{ members.current_members.role_instrument_4 }}</label><b class="c-fourth font-weight-bold">{{ members.current_members.member_name_4 }}</b>
            </div>
        </div>
        <div class="d-flex flex-column mt-4">
            <h3 class="font-weight-bold text-white">Past Members:</h3><br>
            <div>
                <label class="text-white">Vocals & Guitar: </label> <b class="c-fourth font-weight-bold">David Ottero</b><br>
            </div>
            <div>
                <label class="text-white">Backing Vocals &  Lead Guitar: </label><b class="c-fourth font-weight-bold"> Jay Bogner</b><br>
            </div>
            <div>
                <label class="text-white">Bass Guitar: </label><b class="c-fourth font-weight-bold">Zack Behringer</b><br>
            </div>
            <div>
                <label class="text-white">Drums :</label><b class="c-fourth font-weight-bold">Steven Skayer</b>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['user'],
    data(){
        return {
            members:{
                current_members: '',
                past_members: ''
            },
        }
    },
    mounted(){
        this.getMembers()
    },
    methods:{
        getMembers(){
            this.members = JSON.parse(this.user.personal_information.members)

        }
    }
}
</script>