<template>
  <section>
        <div class="modal fade modal-picture-profile" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImageProfile" aria-hidden="true" id="ModalChangeImageProfile">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4 text-center">
                        <h2 class="font-weight-bold">Change Image Profile</h2>
                        <form @submit.prevent="save">
                            <cropper v-model="myCroppa"
                                :initial-image="user.avatar"
                                initial-size="contain"
                                initial-position="center"
                                :width="700"
                                :height="360"
                                :show-loading="true"
                                :placeholder-font-size="50"
                                :rotating="true"
                                prevent-white-space
                                @init="onInit"
                            >
                            </cropper>
                            <img :src="avatar" alt="">
                            <div class="text-right">
                                <button @click="rotate" class="btn bg-primary text-white rounded-pill">Rotate</button>
                                <button class="btn bg-primary text-white rounded-pill" data-dismiss="modal">cancel</button>
                                <button class="btn bg-fifth mr-2 text-white rounded-pill" :disabled="myCroppa.length <= 0">save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  </section>
</template>

<script>
import Auth from '../../../../helpers/Auth'

export default {
    props:['user'],
    data(){
        return {
            imageData:'',
            avatar: '',
            myCroppa:{}
        }
    },
    methods:{
         onInit() {
            this.avatar = this.myCroppa.generateDataUrl()
            this.myCroppa.addClipPlugin(function (ctx, x, y, w, h) {
                console.log(x, y, w, h)
                ctx.beginPath()
                ctx.arc(600, 350, 350, 0, 2 * Math.PI, true)
                ctx.closePath()
            })
        },
        rotate(){
            this.myCroppa.rotate()
        },
        save(){
            var avatar = new FormData()
            avatar.append('avatar', this.avatar, this.avatar.name)
        
            axios.post(`/User/Edit/imageProfile/${this.user.username}`, avatar ).then(res => {
                try {
                    if (res.data.updated){
                        Auth.remove()
                        Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar )
                        console.log(res)
                        window.location.reload()
                    }else{
                        alert('error')
                    }
                } catch (error) {
                    console.log(error)
                }
            }).catch(err =>{

            })
        }
    }
}
</script>