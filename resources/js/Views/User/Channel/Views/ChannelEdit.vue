<template>
    <section class="profile">
        <div class="bg-black mt-5 content-personal-details">
            <div class=" mb-3">
                <h3 class="c-white font-weight-bold">Personal Details <i class="fas fa-pencil-alt"></i></h3>
                <label class="c-fourth">Name: <span class="text-white">{{ user.personal_information.full_name  }}</span></label><br>
                <label class="c-fourth">Gender: <span class="text-white"> {{ user.personal_information.gender }}</span></label><br>
                <label class="c-fourth">Location: <span class="text-white">{{ user.personal_information.location }}</span> </label><br>
                <label class="c-fourth">Email: <span class="text-white">{{ user.email }}</span></label>
            </div>
            <div class=" mb-5 ">
                <h3 class="c-white font-weight-bold">Subscription</h3>
                <label class="c-fourth">Account Type: <span class="c-fifth font-weight-bold">{{ user.subscription_type }}</span></label><br>
                <a :href="`/User/Settings/${user.username}`" class="btn bg-black text-white rounded-pill settings font-weight-bold">
                    <label class="font-weight-bold">Account Settings</label><i class="fas fa-cog m-2"></i>
                </a>
            </div>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Channel/Edit`" class="c-fifth font-weight-bold active">Channel</a>
            <a :href="`/${user.username}/Edit`" class="text-white font-weight-bold mx-3">About</a>
        </div>
        <accordion-channel :user="user" />
    </section>
</template>

<script>
    import AccordionChannel from './AccordionChannel'
    export default {
        props:['user'],
        components:{
            AccordionChannel
        }
    }
</script>
