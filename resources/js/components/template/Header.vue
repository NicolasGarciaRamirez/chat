<template>
    <ul class="c-header-nav mfs-auto">
        <form action="/" class="header-form-search d-none d-md-block">
            <div class="form-group m-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="cil-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </form>
        <li class="c-header-nav-item pl-2"><a class="c-header-nav-link other-link become-contributor d-none d-md-block" href="#">Become A Contributor </a></li>
        <div v-if="!is_login_view">
            <li class="c-header-nav-item px-2"><a class="c-header-nav-link other-link login" href="#" @click="showModalLogin">Login</a></li>
        </div>
        <div v-else>
            <li class="c-header-nav-item px-2"><img src="/images/profile.png" alt="img-head-profile" class="img-head-profile rounded-pill"></li>
            
        </div>
        
    </ul>
</template>

<script>
    export default {
        data(){
            return {
                is_login_view: true
            }
        },
        methods:{
            showModalLogin(){
                $('#ModalLogin').modal('show')
            }
        }
    }
</script>
