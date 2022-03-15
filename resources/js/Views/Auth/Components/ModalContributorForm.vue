<template>
    <div class="modal fade modal-contributor-form" role="dialog" aria-labelledby="ModalContributorForm" aria-hidden="true" id="ModalContributorForm">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-body p-1">
                    <div class="d-flex flex-row justify-content-between contributor-form">
                        <div class="d-flex flex-column p-4">
                            <h5 class="text-center font-weight-bold">Contributor User Signup</h5>
                            <form-sign-up :type="'Contributor'" v-if="!auth.username"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormSignUp from './FormSignUp'
import Auth from '../../../helpers/Auth'
export default {
    components:{
        FormSignUp,
    },
    data(){
        return {
            auth: ''
        }
    },
    mounted() {
        Auth.initialize()
        this.auth = Auth.state
    }
}
</script>
