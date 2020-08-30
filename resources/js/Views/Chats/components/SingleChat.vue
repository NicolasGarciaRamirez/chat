<template>
    <section>
        <div class="chat-section">
            <div class="chat-header fixed-top bg-black">
                <div class="d-flex flex-row align-items-center">
                    <i class="fas fa-angle-left fa-2x" @click="$parent.view_chat = false"></i>
                    <img :src="`${user.avatar}`" class="rounded-circle mx-2" style="width: 3rem"/>
                    <span>{{user.artistic_name}}<img src="/images/icons/check.svg" width="14" class="ml-1" v-if="user.verification_date"></span>
                </div>
            </div>
            <div class="chat-body bg-primary d-flex flex-column justify-content-end align-items-end">
                <div class="d-flex flex-column text-right my-3 p-1" v-for="(message, index) in messages" :key="index">
                    <p class="bg-fifth text-white p-2 w-auto">
                        {{message.message}}
                    </p>
                </div>
            </div>
            <div class="chat-footer bg-black">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <input type="text" class="form-control" placeholder="Type Message" v-model="newMessage" @keyup.enter="sendMessage" @keydown="sendTypingEvent">
                    <button class="bg-black border-0 mx-2">Send</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";

    export default {
        name: "SingleChat",
        props:['user'],
        data(){
            return {
                messages: [],
                newMessage: '',
            }
        },
        mounted() {
            Auth.initialize()
        },
        created() {
            this.getMessage()
            Echo.join(`chat.${Auth.state.username}.${this.user.id}`)
                .listen('SendMessage', (event) => {
                    this.messages.push({
                        user:event.message.user,
                        message:event.message.message
                    })
                    $('.chat-body').animate({
                        scrollBottom: $(".chat-body").offset().top
                    },1);
                })

        },
        methods:{
            getMessage(){
                axios.get(`/${Auth.state.username}/Chat/messageFecth/${this.user.id}`).then(res =>{
                    this.messages = res.data.messages
                    console.log(res)
                }).catch(err =>{
                    console.log(err)
                })
            },
            sendMessage(){
                if(this.newMessage !== ''){
                    this.messages.push({
                        user: this.user,
                        message: this.newMessage
                    })
                    let request = {
                        message: this.newMessage
                    }
                    axios.post(`/${Auth.state.username}/Chat/messageSend`, request).then(res =>{
                        console.log(res)
                        this.newMessage = ''
                    }).catch(err =>{
                        console.log(err)
                    })
                }
            },
            sendTypingEvent(){
                Echo.join('chat').whisper('typing', this.user)
            }
        }

    }
</script>

