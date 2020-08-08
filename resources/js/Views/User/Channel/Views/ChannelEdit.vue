<template>
    <section class="profile">
        <div class="bg-black mt-5 content-personal-details">
            <div class=" mb-3">
                <h3 class="c-white font-weight-bold title-details">Personal Details
                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 1242.12 1079.31" xml:space="preserve" class="svg-icon" width="1.23rem">
                        <g id="Layer_2">
                            <g id="Layer_2-2">
                                <path d="M1188.28,269.77c61.65-49.05,71.86-138.8,22.8-200.45c-6.71-8.44-14.36-16.09-22.8-22.8
                                    c-74.35-62.02-182.42-62.02-256.77,0L128.39,744.08L0,1079.31l385.87-111.98L1188.28,269.77z M905.83,428.11L365.9,895.29
                                    L213.98,761.2l537.08-468.61L905.83,428.11z M802.41,247.66l53.49-44.94l154.78,134.09l-51.35,44.94L802.41,247.66z M982.87,90.74
                                    c44.95-36.27,109.11-36.27,154.06,0c37.23,30.4,42.76,85.21,12.37,122.44c-3.7,4.53-7.84,8.67-12.37,12.37l-77.03,67.05
                                    L905.83,158.5L982.87,90.74z M176.17,819.69l122.68,107.7l-184.02,53.49L176.17,819.69z"/>
                            </g>
                        </g>
                    </svg>
                </h3>
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
