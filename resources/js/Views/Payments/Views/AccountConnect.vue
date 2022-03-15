<template>
    <section>
        <modal-stripe :state="state"></modal-stripe>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import ModalStripe from "../Components/ModalStripe";
    export default {
        name: "AccountConnect",
        components: {
            ModalStripe
        },
        data(){
            return {
                state:'account_connect_success'
            }
        },
        mounted() {
            Auth.initialize()
            this.getUrl()
        },
        methods:{
            getUrl(){
                let url = window.location.href.split("code=")
                this.connectAccounts(url[1])
            },
            async connectAccounts(url){
                await Auth.setSession()
                let data = {token: url}
                await axios.post(`/${Auth.state.username}/Payment/Connect/Account/Success`, data).then(res =>{
                    if(res.data.status === 'success'){
                        this.state = 'account_connect_success'
                        $('#ModalStripe').modal({backdrop: "static"})
                    }else{
                        this.state = 'account_connect_error'
                    }
                }).catch(err=>{
                    $('#ModalStripe').modal('show')
                    this.state = 'account_connect_error'
                    Auth.keepLogged(err.response.status)
                })

            }
        }

    }
</script>
