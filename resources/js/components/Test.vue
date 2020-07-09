<template>
    <cropper
        classname="cropper"
        stencil-component="circle-stencil"
        :src="img"
        :stencil-props="{
		aspectRatio: 10/12
	}"
        @change="change"
    ></cropper>
</template>
<script>
    import { Cropper } from 'vue-advanced-cropper'
    export default {
        data() {
            return {
                options: {
                },
                img: 'https://images.pexels.com/photos/226746/pexels-photo-226746.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'
            }
        },
        methods: {
            change({coordinates, canvas}) {
                console.log(coordinates, canvas)
            }
        },
        components: {
            Cropper
        }
    }
</script>

<style type="text/css">
    .cropper {
        height: 600px;
        background: #DDD;
    }
</style>
