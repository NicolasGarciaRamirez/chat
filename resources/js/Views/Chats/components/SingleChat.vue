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
            <div class="chat-body bg-primary d-flex flex-column justify-content-end align-items-end" ref="chat">
                <div class="d-flex flex-column text-right my-3 p-1" v-for="(message, index) in messages" :key="index">
                    <p class="bg-fifth text-white p-2 w-auto">
                        {{message.message}}
                    </p>
                    <small>{{message.user.artistic_name}}</small>
                    <small>{{message.data_send}}</small>
                </div>
            </div>
            <div class="chat-footer bg-black">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <input type="text" class="form-control" placeholder="Type Message" v-model="newMessage" @keyup.enter="sendMessage" >
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
            Echo.join(`chat`)
                .listen('SendMessage', (event) => {
                    console.log('mensaje enviado')
                    console.log(event)
                    console.log('mensaje capturado')
                    this.messages.push({
                        user:event.message.user,
                        message:event.message.message
                    })
                })
        },
        methods:{
            getMessage(){
                axios.get(`/${Auth.state.username}/Chat/messageFecth/${this.user.id}`).then(res =>{
                    this.messages = res.data.messages
                    let content = this.$refs.chat;
                    content.scrollTop = content.scrollHeight;
                }).catch(err =>{
                    console.log(err)
                })
            },
            sendMessage(){
                if(this.newMessage !== ''){
                    let request = {
                        message: this.newMessage
                    }
                    axios.post(`/${Auth.state.username}/Chat/messageSend`, request).then(res =>{
                        if(res.data.send ){
                            console.log(res)
                            this.messages.push(res.data.message)
                            this.newMessage = ''
                            let content = this.$refs.chat;
                            content.scrollTop = content.scrollHeight;
                        }
                    }).catch(err =>{
                        console.log(err)
                    })
                }
            },

        }

    }
</script>

