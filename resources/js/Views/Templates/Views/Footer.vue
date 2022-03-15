<template>
    <li class="c-sidebar-nav-item footer">
        <div class="footer__item ">
            <a href="/docs/Terms%20and%20Conditions.pdf" target="_blank">Terms</a>
            <a href="/docs/Privacy%20and%20Cookies%20Policy.pdf" target="_blank">Privacy Policy</a>
            <a href="/docs/User%20Policy.pdf" target="_blank">User Policy</a><br>
        </div>
        <div class="footer__item">
            <a href="/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf" target="_blank">Copyright Policy</a>
            <a href="/Help">Help</a>
            <a href="/Suggestions">Suggestions</a>
        </div>
        <div class="footer__item ">
            <a href="#">Contact</a>
            <a href="/About">About</a>
            <a href="/Carrers">Careers</a>
            <a href="#" @click.prevent="showModalMerch">Merch</a>
        </div>
        <div class="footer__item">
            <a href="#" @click.prevent="showModalForMusic" >For Music Companies</a>
        </div>
        <p class="footer__item text-center mt-3">© {{date}}  Noisesharks ® Registered in England and Wales No. 10670071</p>
    </li>
</template>

<script>
    import Functionality from "../../../helpers/Functionality";
    export default {
        data() {
            return {
                date: ''
            }
        },
        mounted() {
            this.getDate()
            Functionality.ldsRipple('lds-ripple')
        },
        methods:{
            showModalMerch(){
                $('#ModalMerch').modal('show')
            },
            showModalForMusic(){
                $('#ModalForMusic').modal('show')
            },
            getDate(){
                let  date = new Date()
                this.date = date.getFullYear()
            }
        }
    }
</script>
