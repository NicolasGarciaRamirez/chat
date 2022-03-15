<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalSelectServices" aria-hidden="true" id="ModalSelectServices">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <div class="pl-4 pt-3">
                            <h2 class="font-weight-bold mb-0">Select Service(s)</h2>
                            <div>
                                <img src="/images/modal-shark.svg" style="width: 100%;">
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="(service, index) in services" :key="index" >
                            <div class="mb-2">
                                <div >
                                    <label class="check-button">
                                        <input type="checkbox" :id="service.id" :value="service.principal_service"  @click="selectAllSpecificService(service.principal_service, service)" v-model="$parent.profile_information.services">
                                        <span :for="service.principal_service"><b>{{ service.principal_service }}</b></span>
                                    </label>
                                    <div class="row pl-3">
                                        <div v-for="(servic, index) in service.specific_service" :key="index" class="col-12 col-lg-6">
                                            <label class="check-button">
                                                <input type="checkbox" :data-specific="`${servic}`" :id="servic" :value="servic" v-model="$parent.profile_information.services" @click="selectService(servic, service.principal_service)">
                                                <span ><b>{{ servic }}</b></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider my-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 text-right p-2 bg-gradient-modal">
                        <button class="btn text-white font-weight-bold" @click="reload">Cancel</button>
                        <button class="btn rounded-pill bg-fifth mr-2 text-white font-weight-bold" data-dismiss="modal">Save</button>
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
        reload(){
            window.location.reload()
        },
        getServices(){
            this.services = Services.getAllServices()
        },
        selectService(service, principal_service){
            let index =  _.findIndex(this.$parent.services_display, function(service){ return service.principal_service === principal_service})
            if(index !== -1){
                if(_.findIndex(this.$parent.services_display[index].specific_services, function(e){return e === service}) !== -1) {
                    let index_specific = _.findIndex(this.$parent.services_display[index].specific_services, function(s){return s === service})
                    this.$parent.services_display[index].specific_services.splice(index_specific, 1)
                }else{
                    this.$parent.services_display[index].specific_services.push(service)
                }
            }else{
                this.$parent.services_display.push({
                    principal_service: principal_service,
                    specific_services: [service]
                })
            }
        },
        selectAllSpecificService(principal_service, service){
            let self = this
            let specific_service = Services.getSpecificService(principal_service)
            if(!$(`#${service.id}`).prop('checked')){
                specific_service.map(value =>{
                    _.remove(self.$parent.profile_information.services, function(n){return n === value;});
                })
                let index = _.findIndex(this.$parent.services_display, function(o) { return o.principal_service === principal_service; });
                this.$parent.services_display.splice(index, 1)
            }else{
                specific_service.map(value =>{
                    self.$parent.profile_information.services.push(value)
                })

                let index = _.findIndex(this.$parent.services_display, function (s){return s.principal_service === principal_service})
                if(index  === -1){
                    self.$parent.services_display.push({
                        principal_service: principal_service,
                        specific_services: specific_service
                    })
                }else{
                    self.$parent.services_display[index].specific_services = specific_service
                }

            }
        },
    }
}
</script>