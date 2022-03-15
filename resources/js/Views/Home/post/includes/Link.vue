<template>
    <div>
        <textarea rows="1"
                  :class="`${$parent.post.replace_caption === null || $parent.post.replace_caption ? 'd-none': ''} form-control link px-3`"
                  placeholder="Paste or type the link you want to share..."
                  v-model="resource_link"
                  style="
                        height: 2rem !important;
                        min-height: 3rem !important;
                  "
                  @change="getTypeData"
                  @keyup="resource_link !== '' && resource_link !== ' ' && content_url.description === '' ? getTypeData() : ''"
                  v-if=""
                  id="textareaPublicDesktop"
        >
        </textarea>
        <div class="content-multimedia__link">
            <div class="d-flex justify-content-center p-2">
                <iframe width="500px"
                        height="280px"
                        :src="`https://www.youtube.com/embed/${code}?&autoplay=0`"
                        frameborder="0"
                        allowfullscreen
                        v-if="code !== '' && link_is_youtube"
                        class="shadow"
                >
                </iframe>
                <iframe class="embedly-embed"
                        :src="`https://open.spotify.com/embed/${src_spotify}`"
                        width="500px"
                        height="280px"
                        title="Spotify embed"
                        frameborder="0"
                        allow="autoplay; fullscreen"
                        allowfullscreen="true"
                        v-if="link_is_spotify"
                >
                </iframe>
            </div>
            <div :class="loading ? 'd-none' : 'header__link'">

            </div>
            <div v-if="!loading && content_url.image !== '' && code === ''">
                <div :class="`d-flex flex-column shadow`">
                    <img :src="content_url.image" style="object-fit: cover; height: 30rem">
                    <div class="d-flex c-fourth flex-column align-items-start bg-second p-3">
                        <span class="text-white-50">{{content_url.domain}}</span>
                        <h5 class="font-weight-bold text-white my-3">{{content_url.title}}</h5>
                        <p>{{content_url.description}}</p>
                    </div>
                </div>
            </div>
            <div class="cross-center m-2" v-if="loading">
                <div class="position-absolute mb-2">
                    <img src="/images/logo-white.svg" class="img-fluid" style="width: 3.95rem">
                </div>
                <div class="spinner-border text-danger" role="status" style="width: 6.50rem; height: 6.50rem">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <a href="" :class="`btn-close m-2 `" v-on:click.prevent="confirmReset()" v-if="!loading && resource_link !== '' && resource_link !== ' '">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" > <path d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z" /> </svg>
            </a>
            <button type="button" id="button" :class="`btn text-white rounded-pill border-white ${code !== ''? 'd-none' : ''}`" v-if="!loading && resource_link !== '' && resource_link !== ' ' && !link_is_web">Get Info Link</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                resource_link: '',
                youtube_key: 'AIzaSyA8ZKlCUVie870WTpoHY-z1V25KHkuKO-0',
                code: '',
                content_url: {
                    image: '',
                    description: '',
                    title: '',
                    url: '',
                    domain: ''
                },
                loading: false,
                link_is_spotify: false,
                link_is_youtube : false,
                link_is_web: false,
                src_spotify : '',
                already_type_data: false,
                data_link : ''
            }
        },
        watch:{
            description(){
                this.$parent.post.resource = this.resource_link
                this.$parent.editPost = !(this.resource_link === '' || this.resource_link === ' ');
            },
        },
        methods:{
            onPaste(){
                $('#button').click()
            },
            confirmReset(){
                this.$parent.confirmResetData('link')
            },
            reset(){
                this.resource_link = ''
                this.youtube_key = 'AIzaSyA8ZKlCUVie870WTpoHY-z1V25KHkuKO-0'
                this.code = ''
                this.content_url = {
                    image:'',
                    description:'',
                    title:'',
                    url:'',
                    domain:''
                }
                this.loading = false
                this.link_is_spotify = false
                this.link_is_youtube = false
                this.link_is_web = false
                this.src_spotify = ''
                this.already_type_data = false
            },
            store(){
                return true
            },
            getTypeData(){
                if(this.already_type_data) return false
                this.data_link = this.resource_link.match('(?:https?:\\/\\/)?(?:www\\.)?youtu\\.?be(?:\\.com)?\\/?.*(?:watch|embed)?(?:.*v=|v\\/|\\/)([\\w-_]+)')

                if (this.data_link) {
                    this.link_is_youtube = !!this.data_link
                    this.getData()
                }else{
                    this.resource_link.split('/').map(res => {
                        if(res.match('spotify.com') ){
                            this.link_is_youtube = false
                            this.link_is_spotify = res === 'open.spotify.com'
                            this.getData()
                            return false
                        }else{
                            this.link_is_web = true
                            this.getData()
                        }

                    })
                }
            },
            async getData(){
                if (this.resource_link !== '' && this.resource_link !== ' ') {
                    let self = this
                    if (this.link_is_youtube) {
                        this.code = this.data_link[1]
                        $.getJSON(`https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id=${this.code}&key=AIzaSyA8ZKlCUVie870WTpoHY-z1V25KHkuKO-0`, function (res) {
                            self.$parent.editPost = true
                            self.$parent.fileInput.resource = self.code
                            self.$parent.post.resource = self.code
                            self.$parent.replace_caption = res.items[0].snippet.title
                            self.$parent.post.replace_caption = res.items[0].snippet.title
                            self.$parent.post.description = res.items[0].snippet.description
                            self.$parent.post.link = self.resource_link
                            self.$parent.post.thumbnail = res.items[0].snippet.thumbnails.default.url
                            self.resource_link.split('/').map(text => {
                                if (text.match('.com') || text.match('.be')) self.$parent.post.domain = text
                            })
                            self.loading = false
                            self.already_type_data = true
                        })
                    }else if(this.link_is_spotify) {
                        this.src_spotify = this.resource_link.split('spotify.com/')[1]
                    }else{
                        if(this.link_is_web){
                            await this.getInfoUrl()
                        }
                    }
                }
            },
            async getInfoUrl(){
                this.loading = true
                let data = {
                    url: this.resource_link
                }
                await axios.post('/Post/get/Url', data).then(res =>{
                    if(res.data) {
                        this.loading = false
                        //se crean los divs para detectar infoo
                        let header_link = $('.header__link')
                        header_link.append(res.data.description)
                        header_link.append(res.data.title)
                        header_link.append(res.data.image)
                        //se pregunta si el contenido llega
                        if( res.data.content) {
                            self.already_type_data = true
                            this.initialize(res.data)
                        }else{
                            this.$parent.editPost = true
                            this.getDomainAttr(res.data.url)
                            this.$parent.fileInput.resource = '/images/urlsLinkPersonalice/default.svg'
                            this.$parent.post.resource = '/images/urlsLinkPersonalice/default.svg'

                            this.$parent.post.link = res.data.url
                            this.$parent.post.link_info = {
                                domain: this.$parent.post.domain,
                                title: this.content_url.title,
                                description: this.content_url.description
                            }
                        }
                    }
                })
            },
            initialize(data){
                this.getDomainAttr(this.content_url.url)
                let image = data.content.['twitter:image'] ? data.content.['twitter:image'] : (data.content.['twitter:image:src'] ? data.content.['twitter:image:src'] : $('.header__link meta[property="og:image"]').attr('content') )

                this.content_url.title       = data.content.['twitter:title'] ? data.content.['twitter:title'] : (data.content.['title'] ? data.content.['title'] : $('.header__link meta[property="og:title"]').attr('content') )
                this.content_url.description = data.content.['twitter:description'] ? data.content.['twitter:description'] : (data.content.['description'] ? data.content.['description'] :  $('.header__link meta[property="og:description"]').attr('content') )
                this.content_url.image       = image ? image : '/images/urlsLinkPersonalice/default.svg'
                this.content_url.url         = data.url
                this.content_url.domain      = this.$parent.post.domain

                this.$parent.editPost           = true
                this.$parent.fileInput.resource = this.content_url.image
                this.$parent.post.resource      = this.content_url.image

                this.$parent.post.link = this.content_url.url

                this.$parent.post.link_info.description = this.content_url.description + ' \n' + this.content_url.url
                this.$parent.post.link_info.domain =  this.$parent.post.domain
                this.$parent.post.link_info.title = this.content_url.title
            },
            getDomainAttr(url){
                url.split('/').map(res => { if(res.match('.com')) return this.$parent.post.domain =  res })
            },
            newWindow(){
                window.open(this.content_url.url, '_blank')
            },
        },

    }
</script>

<style lang="scss" scoped>
    // textarea{
    //     background-color: transparent;
    //     border-radius: 0;
    //     padding: 0;
    //     caret-color: var(--fifth-color);
    //     &:focus{
    //         background-color: transparent;
    //     }
    // }
    iframe{
        @media only screen and (max-width: 600px) {
            width: 100%;
        }
    }


/*    https://player.beatstars.com/?storeid=""*/
/*    https://www.beatstars.com/embed/playlists/4703090*/
/* link spotify embebed   https://open.spotify.com/embed/${src_spotify}*/
</style>
