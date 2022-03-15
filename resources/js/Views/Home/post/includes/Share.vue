<template>
    <div class="modal fade" id="ModalShared" tabindex="-1" role="dialog" aria-labelledby="ModalShareLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pr-0">
                    <h5 class="modal-title m-auto font-weight-bold" id="ModalShareLabel">Also Posting To</h5>
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="right: 1rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body share-redes-progress" :state="`${social_active.name}`" ><!-- Red social activa (twitter, facebook, reddit) -->
                    <div class="share-redes-progress__content">
                        <!--
                            solo cambian la clase, ya css hace el resto

                            Vacio => default (ej: reddit)
                            active => Apenas se esta compartiendo en esa red (ej: twitter)
                            success => ya se compartio, (ej: facebook)
                        -->
                        <div :class="`share-redes-progress__icon ${this.state.facebook}`" v-if="this.$parent.facebook_active" facebook>
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M9.9,23h2.6c0.6,0,1.1-0.5,1.1-1.1V13c0-0.6,0.5-1.1,1.1-1.1h1.2c0.6,0,1-0.4,1.1-1c0.1-0.4,0.1-0.9,0.2-1.4 c0.1-0.7-0.4-1.3-1.1-1.3h-1.2c-0.6,0-1.1-0.5-1.1-1.1V5.7c0.1-0.5,0.5-0.9,1.1-0.9h1.5c0.6,0,1.1-0.5,1.1-1.1V2.1 C17.5,1.5,17,1,16.4,1h-2.4C8.9,1,9,4.7,9,5.3v1.9c0,0.6-0.5,1.1-1.1,1.1H7.6C7,8.3,6.5,8.8,6.5,9.4v1.3c0,0.6,0.5,1.1,1.1,1.1h0 c0.6,0,1.1,0.5,1.1,1.1v8.8C8.8,22.5,9.3,23,9.9,23z"/> </svg>
                            <svg class="check" id="color" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23.526 5.101c-.04-.399-.231-.759-.541-1.014l-2.318-1.904c-.639-.524-1.585-.432-2.111.207l-9.745 11.86-3.916-3.355c-.628-.536-1.576-.465-2.115.163l-1.952 2.278c-.261.304-.388.691-.357 1.091s.215.764.52 1.024l7.403 6.346c.275.235.616.361.974.361.044 0 .089-.002.134-.006.405-.036.77-.229 1.028-.542l12.662-15.411c.255-.309.373-.7.334-1.098z"/></svg>
                        </div>
                        <div :class="`share-redes-progress__icon ${this.state.twitter}`" v-if="this.$parent.twitter_active" twitter>
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.4,5.2c-0.1,0-0.2,0.1-0.3,0.1c-0.7,0.2-0.7-0.1-0.2-0.6C22,4.5,22.2,4.3,22.4,4c0.4-0.6,0-0.8-0.6-0.6 c-0.2,0.1-0.5,0.2-0.7,0.3c-0.6,0.2-1.6-0.1-2.1-0.5c-0.7-0.5-1.6-0.7-2.5-0.7c-1.3,0-2.4,0.5-3.3,1.4c-0.9,0.9-1.4,2.1-1.4,3.4 c0,0.2,0,0.4,0,0.6c0,0.3-0.5,0.5-1.1,0.4C9.2,8.1,7.8,7.6,6.5,6.9C5.2,6.2,4,5.4,3,4.3C2.5,3.8,1.9,3.9,1.7,4.5 C1.6,4.9,1.5,5.4,1.5,5.8c0,0.8,0.2,1.6,0.6,2.3C2.3,8.4,2.5,8.7,2.8,9c0.4,0.5,0.4,0.8-0.2,0.6c-0.6-0.2-1-0.4-1-0.4s0,0,0,0 c0,1.2,0.4,2.2,1.1,3.1c0.4,0.5,0.9,1,1.5,1.2C4.7,13.8,5,14,4.7,14.1c-0.2,0-0.4,0-0.6,0c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.3,0.5,0.1,1.1C4,15.6,4.4,16,4.8,16.4c0.5,0.4,1,0.6,1.5,0.8c0.7,0.2,0.8,0.5,0.2,0.9c-1.5,0.9-3.1,1.3-4.8,1.3 c-0.2,0-0.4,0-0.6,0c-0.3,0-0.1,0.3,0.5,0.6c1.9,1,3.9,1.5,6.1,1.5c1.7,0,3.2-0.3,4.7-0.8c1.5-0.5,2.7-1.3,3.8-2.2 c1-0.9,1.9-1.9,2.7-3.1c0.8-1.2,1.3-2.4,1.7-3.7c0.4-1.3,0.6-2.6,0.6-3.9c0-0.1,0-0.2,0-0.3c0-0.2,0.4-0.6,0.9-1.1 c0.2-0.2,0.4-0.4,0.6-0.7C23.2,5.2,23,5,22.4,5.2z"/> </svg>
                            <svg class="check" id="color" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23.526 5.101c-.04-.399-.231-.759-.541-1.014l-2.318-1.904c-.639-.524-1.585-.432-2.111.207l-9.745 11.86-3.916-3.355c-.628-.536-1.576-.465-2.115.163l-1.952 2.278c-.261.304-.388.691-.357 1.091s.215.764.52 1.024l7.403 6.346c.275.235.616.361.974.361.044 0 .089-.002.134-.006.405-.036.77-.229 1.028-.542l12.662-15.411c.255-.309.373-.7.334-1.098z"/></svg>
                        </div>
                        <div :class="`share-redes-progress__icon ${this.state.reddit}`" v-if="this.$parent.reddit_active" reddit>
                            <svg id="Bold" enable-background="new 0 0 24 24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path d="m21.325 9.308c-.758 0-1.425.319-1.916.816-1.805-1.268-4.239-2.084-6.936-2.171l1.401-6.406 4.461 1.016c0 1.108.89 2.013 1.982 2.013 1.113 0 2.008-.929 2.008-2.038s-.889-2.038-2.007-2.038c-.779 0-1.451.477-1.786 1.129l-4.927-1.108c-.248-.067-.491.113-.557.365l-1.538 7.062c-2.676.113-5.084.928-6.895 2.197-.491-.518-1.184-.837-1.942-.837-2.812 0-3.733 3.829-1.158 5.138-.091.405-.132.837-.132 1.268 0 4.301 4.775 7.786 10.638 7.786 5.888 0 10.663-3.485 10.663-7.786 0-.431-.045-.883-.156-1.289 2.523-1.314 1.594-5.115-1.203-5.117zm-15.724 5.41c0-1.129.89-2.038 2.008-2.038 1.092 0 1.983.903 1.983 2.038 0 1.109-.89 2.013-1.983 2.013-1.113.005-2.008-.904-2.008-2.013zm10.839 4.798c-1.841 1.868-7.036 1.868-8.878 0-.203-.18-.203-.498 0-.703.177-.18.491-.18.668 0 1.406 1.463 6.07 1.488 7.537 0 .177-.18.491-.18.668 0 .207.206.207.524.005.703zm-.041-2.781c-1.092 0-1.982-.903-1.982-2.011 0-1.129.89-2.038 1.982-2.038 1.113 0 2.008.903 2.008 2.038-.005 1.103-.895 2.011-2.008 2.011z"/></svg>
                            <svg class="check" id="color" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23.526 5.101c-.04-.399-.231-.759-.541-1.014l-2.318-1.904c-.639-.524-1.585-.432-2.111.207l-9.745 11.86-3.916-3.355c-.628-.536-1.576-.465-2.115.163l-1.952 2.278c-.261.304-.388.691-.357 1.091s.215.764.52 1.024l7.403 6.346c.275.235.616.361.974.361.044 0 .089-.002.134-.006.405-.036.77-.229 1.028-.542l12.662-15.411c.255-.309.373-.7.334-1.098z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="modal-footer  border-0">
                    <button type="button" class="btn btn-sm rounded-pill m-auto share-btn" @click="share()">Post To </button>

                    <!-- <button type="button" class="btn btn-sm rounded-pill m-auto btn-red">Back to Stream page</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                social_active: {
                    name: 'facebook',
                    state: 'active'
                },
                post:{},
                state:{
                    facebook: 'active',
                    twitter: '',
                    reddit: '',
                },
            }
        },
        mounted(){
            // $('#ModalShare').modal('show')
        },
        methods:{
            share(){
                if(this.social_active.name === 'facebook') {
                    let url = encodeURI(`https://web.facebook.com/sharer/sharer.php?u=${window.location.origin}/Post/${this.post.token}`)
                    // se crea una ventana nueva de las dimensiones 400 * 500 con la url de la red social a compartir
                    window.open(url,"","width=500,height=400,left=500,resizable");
                    this.state.facebook = 'success'
                    this.state.twitter  = 'active'
                    this.social_active.name = 'twitter'
                    this.social_active.state = 'active'
                }else if(this.social_active.name === 'twitter'){
                    let url = encodeURI(`https://twitter.com/intent/tweet?url=${window.location.origin}/Post/${this.post.token}&hashtags=Noisesharks`)
                    // se crea una ventana nueva de las dimensiones 400 * 500 con la url de la red social a compartir
                    window.open(url,"","width=500,height=400,left=500,resizable");
                    this.state.twitter = 'success'
                    this.state.reddit  = 'active'
                    this.social_active.name = 'reddit'
                    this.social_active.state = 'active'
                }else if(this.social_active.name === 'reddit'){
                    let url = encodeURI(`https://www.reddit.com/submit?url=${window.location.origin}/Post/${this.post.token}`)
                    // se crea una ventana nueva de las dimensiones 400 * 500 con la url de la red social a compartir
                    window.open(url,"","width=500,height=400,left=500,resizable");
                    this.state.reddit = 'success'
                    $('#ModalShare').modal('toggle')
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
