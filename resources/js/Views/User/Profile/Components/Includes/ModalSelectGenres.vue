<template>
    <section>
        <div class="modal fade modal-select" tabindex="-1" role="dialog" aria-labelledby="ModalSelectGenres" aria-hidden="true" id="ModalSelectGenres">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2 class="font-weight-bold">Select Genre(s)</h2>
                        <div>
                            <img src="/images/modal-shark.svg" class="line-shark">
                        </div>
                        <div v-for="(genre, index) in genres" :key="index">
                            <div class="d-flex flex-row mb-2" style="flex-grow: 2">
                                <div class="col-md">
                                    <div class="d-flex flex-row checkbox">
                                        <input type="checkbox" :id="genre.principal_genre" :value="genre.principal_genre" @click="selectAllSpecificGenre(genre.principal_genre)" v-model="$parent.profile_information.genres">
                                        <label :for="genre.principal_genre" class="text-white font-weight-bold" ><span>{{ genre.principal_genre }}</span></label>
                                    </div>
                                    <div v-for="(genr, index) in genre.specific_genre" :key="index">
                                        <div class="d-flex flex-row ml-3 checkbox">
                                            <input type="checkbox" :data-specific="`${genr}`" :id="genr" :value="genr" v-model="$parent.profile_information.genres">
                                            <label :for="genr" class="text-white"><span>{{ genr }}</span></label>
                                        </div>
                                    </div>
                                    <div class="divider my-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-right p-2">
                            <button class="btn text-white font-weight-bold" data-dismiss="modal">Cancel</button>
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
            genres: []
        }
    },
    mounted(){
        this.getGenres()
    },
    methods:{
        getGenres(){
            this.genres = Genres.getAllGenres()
        },
        selectAllSpecificGenre(principal_genre){
            var self = this
            let specific_genres = Genres.getSpecificGenre(principal_genre)
            specific_genres.map(value =>{
                self.$parent.profile_information.genres.push(value)
            })
        }
    }
}
</script>
