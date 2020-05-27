<template>
    <section>
        <div class="modal fade modal-reward" tabindex="-1" role="dialog" aria-labelledby="ModalSelectGenres" aria-hidden="true" id="ModalSelectGenres">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="d-flex flex-column justify-content-start">
                            <h4 class="font-weight-bold">Select Genre(s)</h4>
                            <br>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <input type="checkbox" id="Alternative" value="Alternative" v-model="$parent.profile_information.genres">
                                    <label for="Alternative" class="text-white font-weight-bold">Alternative</label>
                                    <div class="border-top"></div><br>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="Blues" value="Blues" v-model="$parent.profile_information.genres">
                                        <label for="Blues" class="text-white font-weight-bold">Blues</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="AcousticBlues" value="Acoustic Blues" v-model="$parent.profile_information.genres">
                                            <label for="AcousticBlues" class="text-white">Acoustic Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ChicagoBlues" value="Chicago Blues"  v-model="$parent.profile_information.genres">
                                            <label for="ChicagoBlues" class="text-white">Chicago Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ClassicBlues" value="Classic Blues"  v-model="$parent.profile_information.genres">
                                            <label for="ClassicBlues" class="text-white">Classic Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ContemporaryBlues" value="Contemporary Blues"  v-model="$parent.profile_information.genres">
                                            <label for="ContemporaryBlues" class="text-white">Contemporary Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="CountryBlues" value="Country Blues"  v-model="$parent.profile_information.genres">
                                            <label for="CountryBlues" class="text-white">Country Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="DeltaBlues" value="Delta Blues"  v-model="$parent.profile_information.genres">
                                            <label for="DeltaBlues" class="text-white">Delta Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ElectricBlues" value="Electric Blues"  v-model="$parent.profile_information.genres">
                                            <label for="ElectricBlues" class="text-white">Electric Blues</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="RagtimeBlues" value="Ragtime Blues"  v-model="$parent.profile_information.genres">
                                            <label for="RagtimeBlues" class="text-white">Ragtime Blues</label>
                                        </div>
                                        <div class="border-top"></div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="Children’sMusic" value="Children’s Music" v-model="$parent.profile_information.genres">
                                        <label for="Children’sMusic" class="text-white font-weight-bold">Children’s Music</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Lullabies" value="Lullabies" v-model="$parent.profile_information.genres">
                                            <label for="Lullabies" class="text-white">Lullabies</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="SingAlong" value="Sing-Along" v-model="$parent.profile_information.genres">
                                            <label for="SingAlong" class="text-white">Sing-Along</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Stories" value="Stories" v-model="$parent.profile_information.genres">
                                            <label for="Stories" class="text-white">Stories</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="Classical" value="Classical" v-model="$parent.profile_information.genres">
                                        <label for="Classical" class="text-white font-weight-bold">Classical</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Avant-Garde" value="Avant-Garde"  v-model="$parent.profile_information.genres">
                                            <label for="Avant-Garde" class="text-white">Avant-Garde</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Baroque" value="Baroque" v-model="$parent.profile_information.genres">
                                            <label for="Baroque" class="text-white">Baroque</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ChamberMusic" value="Chamber Music" v-model="$parent.profile_information.genres">
                                            <label for="ChamberMusic" class="text-white">Chamber Music</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Chant" value="Chant" v-model="$parent.profile_information.genres">
                                            <label for="Chant" class="text-white">Chant</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Choral" value="Choral" v-model="$parent.profile_information.genres">
                                            <label for="Choral" class="text-white">Choral</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ClassicalCrossover" value="Classical Crossover" v-model="$parent.profile_information.genres">
                                            <label for="ClassicalCrossover" class="text-white">Classical Crossover</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ContemporaryClassical" value="Contemporary Classical" v-model="$parent.profile_information.genres">
                                            <label for="ContemporaryClassical" class="text-white">Contemporary Classical</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="EarlyMusic" value="Early Music" v-model="$parent.profile_information.genres">
                                            <label for="EarlyMusic" class="text-white">Early Music</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Expressionist" value="Expressionist" v-model="$parent.profile_information.genres">
                                            <label for="Expressionist" class="text-white">Expressionist</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="HighClassical" value="High Classical" v-model="$parent.profile_information.genres">
                                            <label for="HighClassical" class="text-white">High Classical</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Impressionist" value="Impressionist" v-model="$parent.profile_information.genres">
                                            <label for="Impressionist" class="text-white">Impressionist</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Medieval" value="Medieval" v-model="$parent.profile_information.genres">
                                            <label for="Medieval" class="text-white">Medieval</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Minimalism" value="Minimalism" v-model="$parent.profile_information.genres">
                                            <label for="Minimalism" class="text-white">Minimalism</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ModernComposition" value="Modern Composition" v-model="$parent.profile_information.genres">
                                            <label for="ModernComposition" class="text-white">Modern Composition</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Renaissance" value="Renaissance" v-model="$parent.profile_information.genres">
                                            <label for="Renaissance" class="text-white">Renaissance</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Romantic" value="Romantic" v-model="$parent.profile_information.genres">
                                            <label for="Romantic" class="text-white">Romantic</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Wedding" value="Wedding" v-model="$parent.profile_information.genres">
                                            <label for="Wedding" class="text-white">Wedding</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="comedy" value="comedy" v-model="$parent.profile_information.genres">
                                        <label for="comedy" class="text-white font-weight-bold">Comedy</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Novelty" value="Novelty" v-model="$parent.profile_information.genres">
                                            <label for="Novelty" class="text-white">Novelty</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Standup Comedy" value="Standup Comedy" v-model="$parent.profile_information.genres">
                                            <label for="Standup Comedy" class="text-white">Standup Comedy</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Vaudeville" value="Vaudeville" v-model="$parent.profile_information.genres">
                                            <label for="Vaudeville" class="text-white">Vaudeville</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="Country" value="Country" v-model="$parent.profile_information.genres">
                                        <label for="Country" class="text-white font-weight-bold">Country</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row ">
                                            <input type="checkbox" id="AlternativeCountry" value="Alternative Country" v-model="$parent.profile_information.genres">
                                            <label for="AlternativeCountry" class="text-white">Alternative Country</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Americana" value="Americana" v-model="$parent.profile_information.genres">
                                            <label for="Americana" class="text-white">Americana</label>
                                        </div>
                                         <div class="d-flex flex-row">
                                            <input type="checkbox" id="Bluegrass" value="Bluegrass" v-model="$parent.profile_information.genres">
                                            <label for="Bluegrass" class="text-white">Bluegrass</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ContemporaryBluegrass" value="Contemporary Bluegrass" v-model="$parent.profile_information.genres">
                                            <label for="ContemporaryBluegrass" class="text-white">Contemporary Bluegrass</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="ContemporaryCountry" value="Contemporary Country" v-model="$parent.profile_information.genres">
                                            <label for="ContemporaryCountry" class="text-white">Contemporary Country</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="CountryGospel" value="Country Gospel" v-model="$parent.profile_information.genres">
                                            <label for="CountryGospel" class="text-white">Country Gospel</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="CountryPop" value="Country Pop" v-model="$parent.profile_information.genres">
                                            <label for="CountryPop" class="text-white">Country Pop</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="HonkyTonk" value="Honky Tonk" v-model="$parent.profile_information.genres">
                                            <label for="HonkyTonk" class="text-white">Honky Tonk</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="OutlawCountry" value="Outlaw Country" v-model="$parent.profile_information.genres">
                                            <label for="OutlawCountry" class="text-white">Outlaw Country</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="TraditionalBluegrass" value="Traditional Bluegrass" v-model="$parent.profile_information.genres">
                                            <label for="TraditionalBluegrass" class="text-white">Traditional Bluegrass</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="TraditionalCountry" value="Traditional Country" v-model="$parent.profile_information.genres">
                                            <label for="TraditionalCountry" class="text-white">Traditional Country</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="UrbanCowboy" value="Urban Cowboy" v-model="$parent.profile_information.genres">
                                            <label for="UrbanCowboy" class="text-white">Urban Cowboy</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <input type="checkbox" id="Pop" value="Pop Music">
                                    <label for="Pop" class="text-white font-weight-bold">Pop</label>
                                </div>
                                <div class="d-flex flex-column ml-4">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="Britpop" value="Britpop">
                                        <label for="Britpop" class="text-white ">Britpop</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button class="btn bg-fifth mr-2 text-white" >save</button>
                            <button class="btn bg-third text-white" data-dismiss="modal">cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return{
            genres:{
                categorys:[],
                values:[],
            }
        }
    },
    methods:{
    }
}
</script>