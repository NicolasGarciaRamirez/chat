<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalSelectGenres" aria-hidden="true" id="ModalSelectGenres">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <div class="pl-4 pt-3">
                            <h2 class="font-weight-bold mb-0">Select Genre(s)</h2>
                            <div>
                                <img src="/images/modal-shark.svg" style="width: 100%;">
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="(genre, index) in genres" :key="index">
                            <div class="mb-2">
                                <div >
                                    <label class="check-button">
                                        <input type="checkbox" :id="genre.id" :value="genre.principal_genre" v-model="$parent.profile_information.genres" @click="selectAllSpecificGenre(genre.principal_genre, genre)">
                                        <span><b>{{ genre.principal_genre }}</b></span>
                                    </label>
                                    <div class="row pl-3">
                                        <div v-for="(genr, index) in genre.specific_genre" :key="index" class="col-12 col-lg-6 col-xl-4">
                                            <label class="check-button">
                                                <input type="checkbox" :data-specific="`${genr}`" :id="genr" :value="genr" v-model="$parent.profile_information.genres" @click="selectGenre(genr, genre.principal_genre)">
                                                <span><b>{{ genr }}</b></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider my-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-gradient-modal">
                        <div class="text-right p-2">
                            <button class="btn text-white font-weight-bold" @click="reload">Cancel</button>
                            <button class="btn rounded-pill bg-fifth mx-2 text-white font-weight-bold" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Genres from "../../../../../helpers/Genres";
    export default {
        data(){
            return {
                genres: [],
            }
        },
        mounted(){
            this.getGenres()
        },
        methods:{
            reload(){
                window.location.reload()
            },
            getGenres(){
                this.genres = Genres.getAllGenres()
            },
            selectGenre(genre, principal_genre){
                let index =  _.findIndex(this.$parent.genres_display, function(genre){ return genre.principal_genre === principal_genre})
                if(index !== -1){
                    if(_.findIndex(this.$parent.genres_display[index].specific_genres, function(e){return e === genre}) !== -1) {
                        let index_specific = _.findIndex(this.$parent.genres_display[index].specific_genres, function(e){return e === genre})
                        this.$parent.genres_display[index].specific_genres.splice(index_specific, 1)
                    }else{
                        this.$parent.genres_display[index].specific_genres.push(genre)
                    }
                }else{
                    this.$parent.genres_display.push({
                        principal_genre: principal_genre,
                        specific_genres: [genre]
                    })
                }
            },
            selectAllSpecificGenre(principal_genre, genre){
                let self = this
                let specific_genres = Genres.getSpecificGenre(principal_genre)
                if(!$(`#${genre.id}`).prop('checked')){
                    specific_genres.map(value =>{
                        _.remove(self.$parent.profile_information.genres, function(n){return n === value;});
                    })
                    //
                    let index = _.findIndex(this.$parent.genres_display, function(o) { return o.principal_genre === principal_genre; });
                    this.$parent.genres_display.splice(index, 1)
                }else{
                    specific_genres.map(value =>{
                        self.$parent.profile_information.genres.push(value)
                    })
                    //
                    let index = _.findIndex(this.$parent.genres_display, function(genre){ return genre.principal_genre === principal_genre})
                    if(index === -1) {
                        self.$parent.genres_display.push({
                            principal_genre: principal_genre,
                            specific_genres: specific_genres
                        })
                    }else{
                        self.$parent.genres_display[index].specific_genres = specific_genres
                    }
                }
            }
        }
    }
</script>
