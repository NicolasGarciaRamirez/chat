<template>
    <div class="p-3">
        <textarea  @keyup.prevent="resource_link !== '' && resource_link !== ' ' && content_url.description === '' ? getData() : ''" rows="1" class="form-control" placeholder="Paste or type the link you want to share..." v-model="resource_link"></textarea>
        <div class="d-flex justify-content-center p-2">
            <iframe width="500px"
                    height="280px"
                    :src="`https://www.youtube.com/embed/${code}?&autoplay=0`"
                    frameborder="0"
                    allowfullscreen
                    v-if="code !== ''"
                    class="shadow"
            >
            </iframe>
        </div>
        <div :class="loading ? 'd-none' : 'header__link'">

        </div>
        <div class="cross-center m-2" v-if="loading">
            <div class="position-absolute mb-2">
                <img src="/images/logo-white.svg" class="img-fluid" style="width: 3.95rem">
            </div>
            <div class="spinner-border text-danger" role="status" style="width: 6.50rem; height: 6.50rem">
                <span class="sr-only">Loading...</span>
            </div>
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
                    url: ''
                },
                loading: false
            }
        },
        methods:{
            reset(){
                this.resource_link = ''
            },
            store(){
                return true
            },
            getData(){
                let link_is_youtube = false
                this.resource_link.split('/').map(res=>{
                    if(res.match('.com')){
                        link_is_youtube = res === 'www.youtube.com'
                    }
                })
                if(this.resource_link !== '' && this.resource_link !== ' '){
                    let self = this
                    if(link_is_youtube) {
                        this.code = this.resource_link.split('watch?v=')[1]
                        $.getJSON(`https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id=${this.code}&key=AIzaSyA8ZKlCUVie870WTpoHY-z1V25KHkuKO-0`, function (res) {
                            self.$parent.editPost = true
                            self.$parent.fileInput.resource = self.code
                            self.$parent.post.resource = self.code
                            self.$parent.replace_caption = res.items[0].snippet.title
                            self.$parent.post.replace_caption = res.items[0].snippet.title
                            self.$parent.post.description = res.items[0].snippet.description
                            self.$parent.post.link = self.resource_link
                            self.resource_link.split('/').map(text =>{
                                if(text.match('.com')) self.$parent.post.domain = text
                            })
                        })
                    }else{
                        this.getInfoUrl()
                    }
                }
            },
            getInfoUrl(){
                this.loading = true
                let data = {
                    url: this.resource_link
                }
                axios.post('/Post/get/Url', data).then(res =>{
                    if(res.data) {
                        this.loading = false
                        let header_link = $('.header__link')
                        header_link.append(res.data.description)
                        header_link.append(res.data.title)
                        header_link.append(res.data.image)
                        if($('.header__link meta')[0] && $('.header__link title')[0] && $('.header__link img')[0] ) {
                            this.initialize(res.data)
                        }else{
                            this.$parent.editPost = true
                            res.data.url.split('/').map(res=>{
                                if(res.match('.com')) this.$parent.post.domain = res
                            })
                            this.$parent.fileInput.resource = '/images/urlsLinkPersonalice/default.svg'
                            this.$parent.post.resource = '/images/urlsLinkPersonalice/default.svg'
                            this.$parent.replace_caption =  this.$parent.post.domain
                            this.$parent.post.replace_caption =  this.$parent.post.domain
                            this.$parent.post.link = res.data.url
                            this.$parent.post.description =  res.data.url
                        }
                    }
                })
            },
            newWindow(){
                window.open(this.content_url.url, '_blank')
            },
            initialize(data){
                this.content_url.description = $('.header__link meta')[0].content
                this.content_url.title = $('.header__link title')[0].outerText

                this.content_url.image = $('.header__link img')[0] ? $('.header__link img')[0].src : '/images/urlsLinkPersonalice/default.png'
                this.content_url.url = data.url

                this.$parent.editPost = true
                this.$parent.fileInput.resource = this.content_url.image
                this.$parent.post.resource = this.content_url.image
                this.$parent.replace_caption =  this.content_url.title
                this.$parent.post.replace_caption =  this.content_url.title
                this.$parent.post.link = this.content_url.url
                this.content_url.url.split('/').map(res=>{
                    if(res.match('.com')) this.$parent.post.domain = res
                })
                this.$parent.post.description =  this.content_url.description + ' \n' + this.content_url.url
            }
        },
        watch:{
            description(){
                this.$parent.post.resource = this.resource_link
                if(this.resource_link == '' || this.resource_link == ' '){
                    this.$parent.editPost = false
                }else{
                    this.$parent.editPost = true
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    textarea{
        background-color: transparent;
        border-radius: 0;
        padding: 0;
        caret-color: var(--fifith-color);
        &:focus{
            background-color: transparent;
        }
    }


</style>
