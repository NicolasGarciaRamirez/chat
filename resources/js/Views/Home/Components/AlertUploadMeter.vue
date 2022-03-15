<template>
    <div>
        <div class="upload-meter" v-if="display">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeAlert">
                <span class="text-white" aria-hidden="true">&times;</span>
            </button>
            <h4 class="upload-meter--title">
                {{ (status == 'btn') ? 'Uploading...' : (status == 'success') ? 'Upload Complete' : 'Something Went Wrong' }}
            </h4>
            <div class="upload-meter__content flex-column flex-lg-row">
                <div class="upload-meter__progress w-100 ">
                    <span>{{ load }}</span>
                    <div class="progress w-100">
                        <div class="progress-bar" role="progressbar" :style="`width: ${porcentage}%; ${status == 'success' ? 'background:  #43E15D' : ''}`" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span>{{weight}}</span>
                </div>
                <div class="btn btn-link" v-if="status == 'btn'" @click="cancel">
                    cancel
                </div>

                <div v-else-if="status == 'success'">
                    <i class="fas fa-check" style="color: #43E15D"></i>
                </div>
                <div class="c-fifth font-weight-bold" v-else-if="status == 'error'">
                    Error!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                porcentage: 0,
                load: "0MB",
                weight: "0MB",
                status: "btn",
                display: false,
                source: null
            }
        },
        methods:{
            closeAlert(){
                this.display = false
            },
            cancel(){
                swal({
                    title: "This file hasn't finished uploading yet, are you sure you want to cancel the upload?",
                    text: "",
                    icon: "warning",
                    buttons: ['Cancel','Yes'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.source.cancel('cancel')
                    }
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
