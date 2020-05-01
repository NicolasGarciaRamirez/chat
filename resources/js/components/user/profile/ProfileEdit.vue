<template>
    <section>
        <div class="container-fluid justify-content-between d-md-flex bg-black my-5 content-personal-details">
            <div class="mb-3">
                <h2 class="c-white">Personal Details <img src="/images/icons/pencil.svg" alt="pencil" style="width: 1.2rem"></h2>
                <label>Name: {{ user.full_name  }}</label><br>
                <label>Gender: {{ user.personal_information ? user.personal_information.genre : "--" }}</label><br>
                <label>Location: asd</label><br>
                <label>Email: {{ user.email }}</label>
            </div>
            <div>
                <h2 class="c-white">Subscription</h2>
                <label>Acount Type: <span class="c-fifth">{{ user.suscription_type }}</span></label><br>
                <a href="/Profile/Settings" class="btn bg-black text-white border rounded-pill settings">
                    Account Setings <i class="fas fa-cog ml-2"></i>
                </a>
            </div>
        </div>
        <div class="navigation-body">
            <a href="/Profile/Edit" class="c-fifth font-weight-bold mr-3 active">Profile</a>
            <a href="/Profile/Channel/Edit" class="text-white font-weight-bold">Channel</a>
        </div>
        <accordion-profile :user="user" />
    </section>
</template>

<script>
    import AccordionProfile from "./AccordionProfile";
    export default {
        props:['user'],
        data(){
            return {
                is_login_view: Boolean,
            }
        },
        components:{
            AccordionProfile
        },
    }
</script>
