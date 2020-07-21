<template>
    <div class="modal fade modal-register" tabindex="-1" role="dialog" aria-labelledby="ModalRegister" aria-hidden="true" id="ModalRegister">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 text-center">
                    <h3 class="font-weight-bold">Free User Signup</h3>
                    <form-sign-up />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FormSignUp from "../Components/FormSignUp";

    export default {
       components:{
           FormSignUp
       }
    }
</script>
