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
                <a href="#" @click.prevent="showModalMerch">Merch</a>
            </div>
            <div class="my-2">
                <a href="#" @click.prevent="showModalForMusic">For Music Companies</a>
            </div>
            <p class="text-center mt-4">© 2019 Noisesharks ® Registered in England and Wales No. 10670071</p>
        </footer>
        <modal-for-music />
        <modal-merch />
    </section>
</template>

<script>
    import ModalMerch from "../../CommingSoon/Views/ModalMerch";
    import ModalForMusic from "../../CommingSoon/Views/ModalForMusic";

    export default {
        components:{
            ModalMerch,
            ModalForMusic
        },
        methods:{
            showModalMerch(){
                $('#ModalMerch').modal({
                    backdrop: false,
                    keyboard: true
                })
            },
            showModalForMusic(){
                $('#ModalForMusic').modal({
                    backdrop: false,
                    show: true
                })
            }
        }
    }
</script>
