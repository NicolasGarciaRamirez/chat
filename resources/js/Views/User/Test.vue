<template>
    <div class="modal fade modal-picture" id="ModalChangeImageReleases">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <div class="upload-example">
                        <cropper
                            classname="upload-example-cropper"
                            :src="image"
                        />
                        <div class="button-wrapper">
                            <span class="button" @click="$refs.file.click()">
                                <input type="file" ref="file" @change="uploadImage($event)" accept="image/*">
                                Upload image
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import { Cropper } from 'vue-advanced-cropper'

    export default {
        components: {
            Cropper,
        },
        data() {
            return {
                image: null,
            };
        },
        methods: {
            reset() {
                this.image = null;
            },
            uploadImage(event) {
                let input = event.target;
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.image = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            },
        },
    };
</script>

<style type="text/css">
    .upload-example-cropper {
        border: solid 1px #EEE;
        height: 300px;
        width: 100%;
    }

    .button-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 17px;
    }

    .button {
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        background: #3fb37f;
        cursor: pointer;
        transition: background 0.5s;
    }

    .button:hover {
        background: #38d890;
    }

    .button input {
        display: none;
    }
</style>
