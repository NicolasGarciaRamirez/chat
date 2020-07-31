<template>
    <section>
        <div class="d-flex flex-column bg-primary search">
            <form action="/" class="header-form-search d-md-block d-md-none d-lg-none p-2">
                <div class="form-group m-0">
                    <div class="input-group">
                        <input class="form-control rounded-pill pl-4" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none" v-model="request">
                        <div class="divider-vertical"></div>
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="position-absolute">
                        <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594
                        C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488
                        l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719
                        s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>
                    </svg>
                    </div>
                </div>
            </form>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Saray Garcia</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <!--EL BOTON CONTRIBUTOR SOLO SE MUESTRA CUANDO EL USUARIO ES CONTRIBUTOR -->
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Tarek Ghaname</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Dream</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Marcos Garcia</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Music Engenery</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Angie Garcia Ramirez</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Production Engenery</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Alejandra Osorio</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Federico Gadea</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Orchest</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Maher</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Band</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Coni Mc</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Segaos Mc</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Judaca Mc</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Camilo Andres Garcia Perez</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Nicolas</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Saray Camila Osorio Garcia</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Rogelio Pataquiba</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Garcia Juan Perez</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row bg-primary p-2" v-if="request !== '' || $parent.request !== ''">
                <div>
                    <img src="/images/default.png" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <label class="font-weight-bold">Liliana Ramirez</label>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">Rap</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
    export default {
        name: "Search",
        data(){
            return {
                request: ''
            }
        },

    }
</script>
