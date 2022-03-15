<template>
    <div >
        <div v-for="(notification, index) in user.notifications" :key="index">
            <single-notification :notification="notification" :key="notification.id"></single-notification>
        </div>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item justify-content-center text-center p-2" @click="markAsReadAll">
            Mark  all as viewed
        </a>
    </div>
</template>

<script>
    import SingleNotification from "./SingleNotification";
    import Auth from "../../helpers/Auth";

    export default {
        components: {SingleNotification},
        props:['user_movile'],
        created(){
            Echo.join('notifications')
                .here((users)=>{
                    console.log(users)
                })
                .listen('StartingFollowingYou', (event)=>{
                    console.log('OMG REAL TIME', event)
                })
            Echo.private('notification').notification( (e)=>{
                console.log(e)
            })

        },
        mounted(){
            Auth.initialize()
            let self =this





            Echo.private(`App.User.${this.user.id}`)
                .notification((notification) => {
                    console.log(notification.type);
                })

        },
        computed:{
            user(){
                if(this.user_movile){return this.user_movile}
                return JSON.parse(this.$parent.user)
            },
            location(){
                if(window.location.href.match(`${window.location.origin}/${this.user.username}/Notifications`)){return true}
                return false
            }
        },
        methods:{
            markAsReadAll(){
                axios.post(`/${Auth.state.username}/Notifications/MarkAsReadAll`).then(res =>{
                    if(res.data.markAsReadAll){
                        this.$parent.notifications = res.data.notifications
                    }
                })
            },
        }


    }
</script>
