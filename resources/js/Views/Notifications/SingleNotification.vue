<template>
    <div :class="`dropdown-item notification-by-user__notification ${notification.read_at ? '' : 'isViewed'}`" @click="markAsRead"> <!-- v-on:click.prevent="logout()" -->
        <div class="row no-gutters align-items-center pr-0 pr-lg-3">
            <div class="col-2 col-lg-4 cross-center ">
                <img :src="notification.data.user_emisor.avatar" class="w-100 rounded-pill" style="max-width: 50px">
            </div>
            <div class="col-9 col-lg-7 notification-by-user__notification--descript">
                <div>
                    <h4>{{ notification.data.user_emisor.artistic_name }}</h4>
                    {{ notification.data.information.body }}
                </div>
            </div>
            <div class="col-1" >
                <div :class="`notification-by-user__notification${notification.read_at ? '' : '--active'}`"></div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from "../../helpers/Auth";

export default {
    name: "SingleNotification",
    props:['notification'],
    mounted(){
        Auth.initialize()
    },
    methods:{
        markAsRead(){
            axios.post(`/${Auth.state.username}/Notifications/MarkAsRead/${this.notification.id}`).then(res =>{
                console.log(res)
                if(res.data.markAsRead){
                    this.notification.read_at = Date.now
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
