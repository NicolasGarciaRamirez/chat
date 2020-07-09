<template>
    <section class="index">
        <div class="navigation-body">
            <a href="#Releases" class="font-weight-bold cursor-pointer text-white mr-3" id="Releases" @click="addClass('releases')" v-if="user.profile_information.releases.length > 0">Releases</a>
            <a href="#Members" class="font-weight-bold cursor-pointer text-white mr-3" id="Members" @click="addClass('members')" v-if="user.profile_information.members.length > 0">Members</a>
            <a href="#Genres" class="font-weight-bold cursor-pointer text-white mr-3" id="Genres" @click="addClass('genres')" v-if="user.profile_information.genres !== ''">Genres</a>
            <a href="#Services" class="font-weight-bold cursor-pointer text-white mr-3" id="Services" @click="addClass('services')" v-if="user.profile_information.services !== ''">Services</a>
            <a href="#Social_media" class="font-weight-bold cursor-pointer text-white mr-3" id="Social_media" @click="addClass('social_media')" v-if="social_media !== null">Social Media</a>
        </div>
        <releases :user="user" v-if="type === 'releases'"></releases>
        <members :user="user" v-if="type === 'members'"></members>
        <genres :user="user" v-if="type === 'genres'"></genres>
        <services :user="user" v-if="type === 'services'"></services>
        <social-media :user="user" v-if="type === 'social_media'"></social-media>
    </section>
</template>

<script>
import Releases from "./Releases";
import Members from "./Members";
import Genres from "./Genres";
import Services from "./Services";
import SocialMedia from "./SocialMedia";

export default {
    props:['user'],
    data(){
        return {
            social_media: JSON.parse(this.user.profile_information.social_media),
            type: this.user.profile_information.releases.length > 0 ? 'releases' : '' ||  this.user.profile_information.members.length > 0 ? 'members' : '' || this.user.profile_information.genres !== '' ? 'genres' : '' || this.user.profile_information.services !== '' ? 'services' : '' || this.social_media !== null ? 'social_media' : ''
        }
    },
    components:{
        Releases,
        Members,
        Genres,
        Services,
        SocialMedia
    },
    mounted(){
        this.addClass(this.type)
    },
    methods:{
        addClass(type){
            if (type === 'releases'){
                this.type = type
                $('#Releases').addClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
            }
            else if (type === 'members'){
                this.type = type
                $('#Members').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
            }
            else if (type === 'genres'){
                this.type = type
                $('#Genres').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
            }
            else if (type === 'services'){
                this.type = type
                $('#Services').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
            }
            else if (type === 'social_media'){
                this.type = type
                $('#Social_media').addClass('active c-fifth')
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
            }
            else{
                this.type = ''
                $('#Releases').removeClass('active c-fifth')
                $('#Members').removeClass('active c-fifth')
                $('#Genres').removeClass('active c-fifth')
                $('#Services').removeClass('active c-fifth')
                $('#Social_media').removeClass('active c-fifth')
            }
        }
    }

}
</script>
