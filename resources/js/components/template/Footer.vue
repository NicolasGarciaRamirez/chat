<template>
    <section>
        <footer class="footer c-secundary">
            <div class="d-flex justify-content-between">
                <a href="/Terms">Terms</a>
                <a href="#">Privacy</a>
                <a href="/Help">Help</a>
                <a href="/Suggestions">Suggestions</a>
            </div>
            <div class="d-flex justify-content-between my-2">
                <a href="#">Contact</a>
                <a href="/About">About</a>
                <a href="/Carrers">Careers</a>
                <a @click="showModalMerch">Merch</a>
            </div>
            <div class="my-2">
                <a @click="showModalForMusic">For Music Companies</a>
            </div>
            <p class="text-center mt-4">© 2019 Noisesharks ® Registered in England and Wales No. 10670071</p>
        </footer>
        <modal-for-music />
        <modal-merch />
    </section>
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
