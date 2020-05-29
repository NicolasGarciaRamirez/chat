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
                    <div class="modal-body pt-4">
                        <h4 class="font-weight-bold">Select Service(s)</h4>
                        <div>
                            <img src="/images/modal-shark.svg" alt="" style="max-width: 44rem; padding-bottom: 1rem">
                        </div>
                        <br>
                        <div v-for="(service, index) in services" :key="index">
                            <div class="d-flex flex-row mt-5" style="flex-grow: 4">
                                <div class="col-6 " >
                                    <div class="d-flex flex-row checkbox">
                                        <input type="checkbox" :id="service.principal_service" :value="service.principal_service" v-model="$parent.profile_information.services">
                                        <label :for="service.principal_service" class="text-white font-weight-bold" ><span>{{ service.principal_service }}</span></label>
                                    </div>
                                    <div v-for="(servic, index) in service.especific_service" :key="index">
                                        <div class="d-flex flex-row ml-3 checkbox">
                                            <input type="checkbox" :id="servic" :value="servic" v-model="$parent.profile_information.services">
                                            <label :for="servic" class="text-white"><span>{{ servic }}</span></label>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn bg-fifth mr-2 text-white"  data-dismiss="modal">save</button>
                            <button class="btn bg-third text-white" data-dismiss="modal">cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>
</template>

<script>
import Services from '../../../../helpers/Services'
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
        }

    }
}
</script>
