<template>
  <section>
      <div class="modal fade modal-select" tabindex="-1" role="dialog" aria-labelledby="ModalSelectServices" aria-hidden="true" id="ModalSelectServices">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2 class="font-weight-bold">Select Service(s)</h2>
                        <div>
                            <img src="/images/modal-shark.svg" class="line-shark">
                        </div>
                        <br>
                        <div v-for="(service, index) in services" :key="index">
                            <div class="d-flex flex-row" style="flex-grow: 4">
                                <div class="col-md" >
                                    <div class="d-flex flex-row checkbox">
                                        <input type="checkbox" :id="service.principal_service" :value="service.principal_service"  @click="selectAllSpecificService(service.principal_service)" v-model="$parent.profile_information.services">
                                        <label :for="service.principal_service" class="text-white font-weight-bold" ><span>{{ service.principal_service }}</span></label>
                                    </div>
                                    <div v-for="(servic, index) in service.specific_service" :key="index">
                                        <div class="d-flex flex-row ml-3 checkbox">
                                            <input type="checkbox" :data-specific="`${servic}`" :id="servic" :value="servic" v-model="$parent.profile_information.services">
                                            <label :for="servic" class="text-white"><span>{{ servic }}</span></label>
                                        </div>
                                    </div>
                                    <div class="divider my-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right p-2">
                            <button class="btn text-white font-weight-bold" data-dismiss="modal">Cancel</button>
                            <button class="btn rounded-pill bg-fifth mr-2 text-white font-weight-bold" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>
</template>

<script>
import Services from "../../../../../helpers/Services";
export default {
    data(){
        return {
            services: []
        }
    },
    mounted(){
        this.getServices()
    },
    methods:{
        getServices(){
            this.services = Services.getAllServices()
        },
        selectAllSpecificService(principal_service){
            var self = this
            let specific_service = Services.getSpecificService(principal_service)
            specific_service.map(value =>{
                self.$parent.profile_information.services.push(value)
            })
        }
    }
}
</script>
