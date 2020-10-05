<template>
    <section>
        <div v-if="!view_chat">
            <form  class="header-form-search" >
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control pl-4 ml-3" type="text" placeholder="Search profiles..." autocomplete="none">
                        <div class="divider-vertical"></div>
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">
                            <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594
                            C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488
                            l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719
                            s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>
                        </svg>
                    </div>
                </div>
            </form>
            <div class="d-flex flex-column body">
                <div class="d-flex flex-row justify-content-between">
                    <span class="font-weight-bold ml-3 c-fourth float-left">Recent Chats</span>
                    <span class="font-weight-bold mr-3 c-fourth float-rigth">Bandera</span>
                </div>
                <div>
                    <div class="d-flex flex-row justify-content-between align-items-center my-2" v-for="(actives, index) in users_actives" :key="index" @click="initializeSummary(actives)" v-if="actives.username !== auth.username">
                        <div class="d-flex flex-row" >
                            <img :src="`${actives.avatar}`" class="rounded-circle mx-3"  style="width:3rem"/>
                            <span>{{actives.artistic_name}}<img src="/images/icons/check.svg" width="14" class="ml-1" v-if="actives.verification_date"></span>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <span class="text-success" style="font-size: 2rem">•</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex flex-row justify-content-between align-items-center my-2" v-for="(user, indexe) in users" :key="indexe" @click="initializeSummary(user)" v-if="user.username !== auth.username">
                        <div class="d-flex flex-row">
                            <img :src="`${user.avatar}`" class="rounded-circle mx-3"  style="width:3rem"/>
                            <span>{{user.artistic_name}}<img src="/images/icons/check.svg" width="14" class="ml-1" v-if="user.verification_date"></span>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <span :class="user.active_status ? `text-success dot position-relative` : 'text-danger dot position-relative'" style="font-size: 2rem">•</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <single-chat :user="user_chat" v-if="view_chat"></single-chat>
    </section>
</template>

<script>
    import SingleChat from "../components/SingleChat";
    import Auth from "../../../helpers/Auth";
    export default {
        name: 'Chats',
        props:['users'],
        components:{
            SingleChat
        },
        data(){
            return {
                users_actives: [],
                user_chat: '',
                view_chat: false,
                message: '',
                auth:''
            }
        },
        created() {
            Echo.join('chat')
                .listen('messageSend',(event) => {
                    console.log('message send')
                    // console.log(event)
                })

                .here((users) =>{
                    let self = this
                    let objects = this.users
                    let object =  users
                    let array_matches = _.intersectionBy(object, objects, 'id')
                    _.each(array_matches , match=>{
                        self.users_actives.push(match)
                        _.remove(self.users, function(user) {return user.id === match.id})
                    })
                })
                .joining((user) => {
                    console.log('joining chat')
                    // console.log(user)
                })
        },
        mounted() {
            Auth.initialize()
            this.auth = Auth.state
            $('.body').animate({scrollTop : 10}, 'slow');

        },
        methods:{
            initializeSummary(user){
                this.user_chat = user
                this.view_chat = true
            }
        }
    }
</script>
