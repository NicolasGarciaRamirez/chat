<template>
    <footer class="footer c-secundary">
        <div class="d-flex justify-content-between">
            <a href="/Terms">Terms</a>
            <a href="#">Privacy</a>
            <a href="/Help">Help</a>
            <a href="#">Suggestions</a>
        </div>
        <div class="d-flex justify-content-between my-2">
            <a href="#">Contact</a>
            <a href="/About">About</a>
            <a href="/Carrers">Careers</a>
            <div @click="showModalMerch">Merch</div>
        </div>
        <div class="my-2">
            <div @click="showModalForMusic">For Music Companies</div>
        </div>
        <p class="text-center mt-4">© 2019 Noisesharks ® Registered in England and Wales No. 10670071</p>
        <modal-for-music />
        <modal-merch />
    </footer>
</template>

<script>
import ModalMerch from '../ModalsCommingSoon/ModalMerch'
import ModalForMusic from '../ModalsCommingSoon/ModalForMusic'
    export default {
        components:{
            ModalForMusic,
            ModalMerch
        },
        methods:{
            showModalMerch(){
                $('#ModalMerch').modal('show')
            },
            showModalForMusic(){
                $('#ModalForMusic').modal('show')
            }
        }
    }
</script>
