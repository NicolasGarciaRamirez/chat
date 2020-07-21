<template>
<!--    <cropper-->
<!--        classname="cropper"-->
<!--        stencil-component="circle-stencil"-->
<!--        :src="img"-->
<!--        :stencil-props="{-->
<!--		aspectRatio: 10/12-->
<!--	}"-->
<!--        @change="change"-->
<!--    ></cropper>-->
<!--    <p>-->
<!--        <span v-if="showMore">{{text}}</span>-->
<!--        <span v-if="!showMore">{{textLess}}</span>-->
<!--        <span class="c-fifth cursor-pointer" @click="!showMore ? showMore = true : showMore = false">{{ 'See More' }}</span>-->
<!--    </p>-->
<!--    <a href="javascript:var dir=window.document.URL;var tit=window.document.title;var tit2=encodeURIComponent(tit);var dir2= encodeURIComponent(dir);window.location.href=('http://www.facebook.com/share.php?u='+dir2+'&amp;t='+tit2+'');"><img src="../img/icon/compartir.png" border="0" width="128" height="52" alt="Compartir" /></a>-->
</template>
<script>
    // import { Cropper } from 'vue-advanced-cropper'
    export default {
        data() {
            return {
                // options: {
                // },
                // img: 'https://images.pexels.com/photos/226746/pexels-photo-226746.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'
                showMore: false
            }
        },
        computed:{
            textLess(){
                let text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat vel purus a feugiat. Maecenas nulla ligula, sagittis ac quam a, dapibus pharetra nulla. In hac habitasse platea dictumst. Praesent aliquam mauris sit amet tellus mattis scelerisque. Donec varius ultricies ipsum vitae interdum. Ut congue rutrum luctus. Pellentesque eget rutrum tortor. Pellentesque dapibus turpis massa, vitae interdum erat malesuada eget. Vivamus in risus et augue egestas laoreet. Donec sed ipsum .' ;
                let a = text.substr(0,200)
                return a
            },
            text(){
                return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat vel purus a feugiat. Maecenas nulla ligula, sagittis ac quam a, dapibus pharetra nulla. In hac habitasse platea dictumst. Praesent aliquam mauris sit amet tellus mattis scelerisque. Donec varius ultricies ipsum vitae interdum. Ut congue rutrum luctus. Pellentesque eget rutrum tortor. Pellentesque dapibus turpis massa, vitae interdum erat malesuada eget. Vivamus in risus et augue egestas laoreet. Donec sed ipsum asd asd asd.' ;
            }
        },
        methods: {
            // change({coordinates, canvas}) {
            //     console.log(coordinates, canvas)
            // }
        },
        components: {
            // Cropper
        }
    }
</script>

<style type="text/css">
    .cropper {
        height: 600px;
        background: #DDD;
    }
</style>
