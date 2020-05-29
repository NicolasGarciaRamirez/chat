<template>
    <section>
        <div class="container-fluid justify-content-between d-md-flex bg-black my-5">
            <div class="mb-3">
                <h2 class="c-white">Personal Details <img src="/images/icons/pencil.svg" alt="pencil" style="width: 1.2rem"></h2>
                <label>Name: Thamek</label><br>
                <label>Gender: Male</label><br>
                <label>Location: asd</label><br>
                <label>Email: asd@gmail.com</label>
            </div>
            <div>
                <h2 class="c-white">Subscription</h2>
                <label>Acount Type: <span class="c-fifth">FREE</span></label><br>
                <a :href="`/User/Settings/${user.username}`" class="btn bg-black text-white border rounded-pill">
                    Account Setings <i class="fas fa-cog ml-2"></i>
                </a>
            </div>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Edit`" class="text-white font-weight-bold mr-3">Profile</a>
            <a :href="`/${user.username}/Channel/Edit`" class="c-fifth font-weight-bold active">Channel</a>
        </div>
        <accordion-channel :user="user" />
    </section>
</template>

<script>
    import AccordionChannel from "../profile/include/AccordionChannel";
    export default {
        props:['user'],
        components:{
            AccordionChannel
        }
    }
</script>
