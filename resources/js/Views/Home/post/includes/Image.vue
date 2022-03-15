<template>
    <div>
        <div class="content-multimedia"  v-if="!btnShow && file.resource != null">
            <img :src="file.resource" :class="`shadow rounded-lg animate__animated ${file.resource ? 'animate__bounceIn' : 'd-none'}`"/>
            <a href="#" class="btn-close" v-on:click.prevent="reset()">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z"/> </svg>
            </a>
        </div>
        <div v-else class="text-center">
            <a href="#" class="btn content-icon btn-outline-light rounded-pill mx-auto" v-on:click.prevent="selectImage()">
                Upload Image
                <div class="icon">
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M23,12c0-6.1-4.9-11-11-11S1,5.9,1,12s4.9,11,11,11S23,18.1,23,12z M10.7,17.9c-0.4,0-0.7-0.3-0.7-0.7 v-4.4H7.9c-0.6,0-1-0.7-0.6-1.2l4.1-5.2c0.3-0.4,0.9-0.4,1.2,0l4.1,5.2c0.4,0.5,0,1.2-0.6,1.2H14v4.4c0,0.4-0.3,0.7-0.7,0.7H10.7 L10.7,17.9z"/> </svg>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props:['file'],
        data(){
            return{
                btnShow: false
            }
        },
        methods:{
            selectImage(){
                this.$parent.changeFileInput()
            },
            reset(){
                this.btnShow = true
                this.$parent.fileInput.resource = null
                this.$parent.post.resource = null
                return true
            },
            store(){
                return true
            },
        }
    }
</script>

<style lang="scss" scoped>
    img{
        width: 100%;
        max-width: 350px;
    }

    @media (max-width: 991px) {
        img{
            padding-top: calc(90vh - 600px);
            max-height: 300px;
        }
    }
</style>
