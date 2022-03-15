<template>
    <div>
        <div class="content-multimedia"  v-if="!btnShow && file.resource != null">
            <svg :class="`animate__animated ${file.resource ? 'animate__fadeIn' : 'd-none'}`" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <g> <g> <path fill="#999999" d="M20,6.8c0-0.1-0.1-0.1-0.1-0.1l-5.3-5.5l-0.1-0.1c-0.1,0-0.1,0-0.2,0H5.8C4.8,1.1,4,1.9,4,2.9v18.4 c0,1,0.8,1.8,1.8,1.8h12.4c1,0,1.8-0.8,1.8-1.8V7C20,6.9,20,6.8,20,6.8z M16,17.5H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2 C16.7,17,16.4,17.5,16,17.5z M16,13.8H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2C16.7,13.3,16.4,13.8,16,13.8z M16,10.2H7.8 C7.3,9.8,7.6,9.3,8,9.3h8.2C16.7,9.7,16.4,10.2,16,10.2z M15.1,6.5c-0.2,0-0.4-0.2-0.4-0.5V3.5c0-0.3,0.4-0.5,0.6-0.2l2.6,2.7 c0.2,0.2,0.1,0.6-0.3,0.6H15.1z"/> </g> </g> </svg>
            <h4>{{ file.name }}</h4>
            <a href="#" class="btn-close" v-on:click.prevent="reset()">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z"/> </svg>
            </a>
        </div>

        <div v-else class="text-center">
            <a href="#" class="btn content-icon btn-outline-light rounded-pill mx-auto" v-on:click.prevent="selectFile()">
                Upload File
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
        methods: {
            selectFile(){
                this.$parent.changeFileInput()
                this.$parent.post.resource = null

            },
            reset(){
                this.btnShow = true
                this.$parent.fileInput.resource = null
                return true
            },
            store(){
                return true
            },
        },

    }
</script>

