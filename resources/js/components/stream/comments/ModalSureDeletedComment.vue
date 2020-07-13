<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalSureDeleteComment" aria-hidden="true" id="ModalSureDeleteComment">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center justify-content-center p-2">
                        <div class="d-flex flex-column text-white">
                            <h5 class="font-weight-bold">{{optionsAll.title}}</h5>
                            <p class="my-3">
                                {{optionsAll.text}}
                            </p>
                            <div class="d-flex flex-row justify-content-end mb-2">
                                <button class="btn rounded-pill font-weight-bold text-white bg-primary mx-2" data-dismiss="modal">Cancel</button>
                                <button class="btn rounded-pill font-weight-bold text-white bg-fifth" data-dismiss="modal" @click="$parent.$refs.Comment.deleteComment()">Delete</button>
                                <button class="btn rounded-pill font-weight-bold text-white bg-fifth" data-dismiss="modal" v-if="optionsAll.buttons.thank_you">Thank You</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['options'],
    data(){
        return {

        }
    },
    computed:{
        optionsAll(){
            return {
                type: this.options.type,
                title: this.options.title,
                text: this.options.text,
                buttons:{
                    cancel: this.options.buttons.cancel,
                    accept: this.options.buttons.accept,
                    thank_you: this.options.buttons.thank_you
                }
            }
        }
    }
}
</script>

<style>

</style>
