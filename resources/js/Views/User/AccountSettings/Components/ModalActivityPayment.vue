<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalActivityPayment" aria-hidden="true" id="ModalActivityPayment">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body justify-content-center p-5">
                    <div class="table-responsive">
                        <table class="table text-white align-items-center">
                            <thead>
                                <tr>
                                    <th>To who?</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(activity, index) in activitys" :key="index">
                                    <td>
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <img :src="activity.to_who.avatar" class="rounded-circle m-2" style="width:2.5rem" />
                                            {{activity.to_who.artistic_name}}
                                        </div>
                                    </td>
                                    <td>{{activity.type}}</td>
                                    <td>{{activity.amount}}</td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-center align-items-center">
                                            <button class="btn rounded-pill border-white text-white action"><b>Change Card</b></button>
                                            <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 x="0px" y="0px" viewBox="0 0 1081 1080" xml:space="preserve" class="cursor-pointer ml-2 mb-2 icon-x" style="width: 1rem" @click="activity.type === 'Payment PERCENTAGE' ? showModalCancel() : ''">
                                                <g id="Layer_2">
                                                    <g id="Layer_2-2">
                                                        <path fill="#535353" d="M540.44-0.32C242.12-0.32,0.28,241.52,0.28,539.84S242.12,1080,540.44,1080s540.16-241.84,540.16-540.16
                                                            S838.76-0.32,540.44-0.32z M796.11,711.25l-83.54,80.66L541.16,623.39L369.75,791.92l-81.38-80.66l169.25-171.41L288.36,368.43
                                                            l80.66-80.66L541.16,456.3l171.41-168.53l83.54,83.54L624.7,539.84L796.11,711.25z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalActivityPayment",
        data(){
            return{
                activitys: ''
            }
        },
        methods:{
            showModalCancel(){
                $('#ModalCancel').modal('show')
                $('#ModalActivityPayment').modal('hide')
            },
        }
    }
</script>

<style scoped>

</style>
