<template>
    <section class="members container-fluid">
        <div class="d-flex flex-column" v-if="user.profile_information.members">
            <h3 class="font-weight-bold text-white">Current Members:</h3><br>
            <div v-for="(member, index) in user.profile_information.members" :key="index">
                <div>
                    <label class="text-white">{{ member.role_instrument }} : </label> <b class="c-fourth font-weight-bold"><a :href="`/${member.link_profile}`" class="c-fourth">{{ member.member_name }}</a></b><br>
                </div>
            </div>
        </div>
        <!-- <div class="d-flex flex-column mt-4">
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
        </div> -->
    </section>
</template>

<script>
export default {
    props: ['user']
}
</script>