<template>
    <ul class="c-header-nav public-post pt-2">
        <li class="c-header-nav-item" v-if="view_post__movil && !view_search__movil">
            <div :class="`public-post__buttons`" style="position:relative;top: -12px;" >
                <div class="btns">
                    <a v-if="postMovile.controlsPost.prev" @click="postMovile.confirmResetData()">
                        <span class="text-light">Cancel </span>
                    </a>

                    <a href="#carouselPublicPost" role="button" data-slide="prev" v-if="!postMovile.controlsPost.prev">
                        <svg  style="width: 1rem;  fill: white; transform: rotate(90deg)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="tiny" id="Layer_1" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8     c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/></svg>
                        <span class="text-light">Back</span>
                    </a>

                    <a v-if="postMovile.controlsPost.next" :class="`${ !postMovile.editPost ? 'disabled': '' }`" :disabled="!postMovile.editPost||postMovile.loading" @click.prevent="postMovile.store()">
                        <span class="c-fifth font-weight-bold">Publish</span>
                    </a>

                    <a href="#carouselPublicPost" role="button" data-slide="next" v-if="!postMovile.controlsPost.next">
                        <span class="c-fifth font-weight-bold">Next</span>
                        <svg  class="fill-fifth" style="width: 1rem; transform: rotate(-90deg)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="tiny" id="Layer_1" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8     c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/></svg>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "app-header-buttons-movile",
        data(){
            return {
                view_post__movil: true,
                view_search__movil: false,
                postMovil: null
            }
        },
        computed:{
            postMovile(){
                let $refs = this.$root.$refs
                // console.log({
                //     nav: $refs.appNav,
                //     modalGetCredit: $refs.ModalGetMoreCredit,
                //     navFooter: $refs.navFooter
                // })

                if($refs.publicPostMovile !== undefined){
                    return this.$root.$refs.publicPostMovile
                }else{
                    return this.postMovil
                }
            },
        },
        mounted(){
            let $refs = this.$root.$refs
            this.postMovil = $refs.publicPostMovile
            // console.log(this.view_post__movil, this.view_search__movil, this.postMovile)
        }
    }
</script>

<style scoped>

</style>
