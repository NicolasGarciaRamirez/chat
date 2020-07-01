<template>

</template>

<script>
    import Auth from "../../helpers/Auth"
    export default {
        props:['user'],
        created() {
            Auth.set(this.user.token, this.user.username, this.user.avatar)
            window.location.replace(`/`)
        }
    }
</script>
