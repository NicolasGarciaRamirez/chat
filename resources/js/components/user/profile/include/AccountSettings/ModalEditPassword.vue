<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalEditPassword" aria-hidden="true" id="ModalEditPassword">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 pb-5">
                        <div class="d-flex flex-column align-items-center">
                            <input type="text" class="form-control w-75" placeholder="Confirm Current Password">
                            <input type="text" class="form-control w-75 my-5" placeholder="Type New Password">
                            <input type="text" class="form-control w-75" placeholder="Confirm New Password">
                        </div>
                        <div class="my-5" style="border-top: 1px solid #262626"></div>
                        <div class="text-center">
                            <button class="bg-fifth text-white font-weight-bold border-0 rounded-pill">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>