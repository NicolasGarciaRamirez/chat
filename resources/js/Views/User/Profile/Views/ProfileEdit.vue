<template>
    <section>
        <div class="container bg-black mt-4 row">
            <div class="mb-3 col col-sm-6">
                <h3 class="c-white font-weight-bold">Personal Details <i class="fas fa-pencil-alt"></i></h3>
                <label class="c-fourth">Name: <span class="text-white">{{ user.personal_information.full_name  }}</span></label><br>
                <label class="c-fourth">Gender: <span class="text-white"> {{ user.personal_information.gender }}</span></label><br>
                <label class="c-fourth">Location: <span class="text-white">{{ user.personal_information.location }}</span> </label><br>
                <label class="c-fourth">Email: <span class="text-white">{{ user.email }}</span></label>
            </div>
            <div class="col col-sm-6 content-personal-details">
                <h3 class="c-white font-weight-bold">Subscription</h3>
                <label class="c-fourth">Acount Type: <span class="c-fifth font-weight-bold">{{ user.subscription_type }}</span></label><br>
                <a :href="`/User/Settings/${user.username}`" class="btn bg-black text-white rounded-pill settings font-weight-bold">
                    <label>Account Settings</label><i class="fas fa-cog m-2"></i>
                </a>
            </div>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Channel/Edit`" class="text-white font-weight-bold">Channel</a>
            <a :href="`/${user.username}/Edit/`" class="c-fifth font-weight-bold mx-3 active">About</a>
        </div>
        <accordion-profile :user="user" />
    </section>
</template>

<script>
    import AccordionProfile from "../Components/AccordionProfile";
    export default {
        props:['user'],
        data(){
            return {
                is_login_view: Boolean,
                type_change_image: ''
            }
        },
        components:{
            AccordionProfile
        },
    }
</script>
