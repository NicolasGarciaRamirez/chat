<template>
    <section class="index mb-5" v-if="user.profile_information">
        <div class="row">
            <div class="col-12 d-lg-none">
                <div class="navigation-body__content" v-if="(user.profile_information.about_you.length > 0)" >
                    <h4 class="font-weight-bold text-white mb-3">About</h4>
                    <p class="mb-0 text-left">
                        {{ user.profile_information.about_you }}
                    </p>
                </div>
            </div>
        </div>
        <div class="navigation-body">
            <div class="navigation-header__select-subsection ">
                <div>
                    <a href="#Releases" class="font-weight-bold cursor-pointer text-white mr-3" id="Releases" @click="addClass('releases')" v-if="user.profile_information.releases.length > 0">Releases</a>
                    <a href="#Members" class="font-weight-bold cursor-pointer text-white mr-3" id="Members" @click="addClass('members')" v-if="user.profile_information.members.length > 0">Members</a>
                    <a href="#Genres" class="font-weight-bold cursor-pointer text-white mr-3" id="Genres" @click="addClass('genres')" v-if="user.profile_information.genres">Genres</a>
                    <a href="#Services" class="font-weight-bold cursor-pointer text-white mr-3" id="Services" @click="addClass('services')" v-if="user.profile_information.services">Services</a>
                    <a href="#Social_media" class="font-weight-bold cursor-pointer text-white mr-3" id="Social_media" @click="addClass('social_media')" v-if="social_media">Social Media</a>
                    <a href="#Work_with" class="font-weight-bold cursor-pointer text-white mr-3" id="Work_with" @click="addClass('work_with')" v-if="user.profile_information.worked_with.length > 0">Worked With</a>
                </div>
            </div>
        </div>
        <div class="row mr-lg-3">
            <div class="col-12 col-lg-7 pr-lg-0">
                <div class="px-3">
                    <releases :user="user" v-if="type === 'releases'"></releases>
                    <members :user="user" v-if="type === 'members'"></members>
                    <genres :user="user" v-if="type === 'genres'"></genres>
                    <services :user="user" v-if="type === 'services'"></services>
                    <social-media :user="user" v-if="type === 'social_media'"></social-media>
                    <work-with :user="user" v-if="type === 'work_with'"></work-with>
                </div>
            </div>
            <div class="col-12 col-lg-5 px-lg-0 d-none d-lg-block">
                <div class="navigation-body__content" v-if="(user.profile_information.about_you.length > 0)" >
                    <h4 class="font-weight-bold text-white mb-3">About</h4>
                    <p class="mb-0 text-left">
                        {{ user.profile_information.about_you }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Releases from "./Releases";
import Members from "./Members";
import Genres from "./Genres";
import Services from "./Services";
import SocialMedia from "./SocialMedia";
import WorkWith from "./WorkWith";

export default {
    props:['user'],
    data(){
        return {
            type:''
        }
    },
    components:{
        Releases,
        Members,
        Genres,
        Services,
        SocialMedia,
        WorkWith
    },
    mounted() {
        this.setType()
    },
    computed:{
        social_media: function () {
            if (this.user.profile_information) {
                if(this.user.profile_information.social_media){
                    let social_media = JSON.parse(this.user.profile_information.social_media)
                    if (
                        social_media.LinkedIn !== null ||
                        social_media.Twitch !== null ||
                        social_media.Youtube !== null ||
                        social_media.Bandcamp !== null ||
                        social_media.Instagram !== null ||
                        social_media.Twitter !== null ||
                        social_media.TikTok !== null ||
                        social_media.SoundCloud !== null ||
                        social_media.Spotify !== null ||
                        social_media.Facebook !== null ||
                        social_media.SnapChat !== null
                    ) {
                        return true
                    } else {
                        return false
                    }
                }else{
                    return false
                }
            } else {
                return false
            }
        },
    },
    methods:{
        setType(){
            if(this.user.profile_information) {
                if(this.user.profile_information.releases.length > 0 ){
                    this.addClass('releases')
                    this.type = 'releases'
                }else if(this.user.profile_information.members.length > 0){
                    this.addClass('members')
                    this.type = 'members'
                }else if(this.user.profile_information.genres){
                    this.addClass('genres')
                    this.type = 'genres'
                }else if(this.user.profile_information.services){
                    this.addClass('services')
                    this.type = 'services'
                }else if(this.social_media){
                    this.addClass('social_media')
                    this.type = 'social_media'
                }else if(this.user.profile_information.worked_with.length > 0){
                    this.addClass('work_with')
                    this.type = 'work_with'
                }
            }else{
                this.type = 'index'
            }
        },
        addClass(type){
            if (type === 'releases'){
                this.type = type
                $('#Releases').addClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
                $('#Work_with').removeClass('active c-fifth')
            }
            else if (type === 'members'){
                this.type = type
                $('#Members').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
                $('#Work_with').removeClass('active c-fifth')
            }
            else if (type === 'genres'){
                this.type = type
                $('#Genres').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
                $('#Work_with').removeClass('active c-fifth')
            }
            else if (type === 'services'){
                this.type = type
                $('#Services').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
                $('#Work_with').removeClass('active c-fifth')
            }
            else if (type === 'social_media'){
                this.type = type
                $('#Social_media').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Work_with').removeClass('active c-fifth')
            }
            else if (type === 'work_with'){
                this.type = type
                $('#Work_with').addClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
            }
            // else{
            //     this.type = ''
            //     $('#Releases').removeClass('active c-fifth')
            //     $('#Members').removeClass('active c-fifth')
            //     $('#Genres').removeClass('active c-fifth')
            //     $('#Services').removeClass('active c-fifth')
            //     $('#Social_media').removeClass('active c-fifth')
            // }
        }
    }

}
</script>
