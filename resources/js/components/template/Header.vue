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
        <li class="c-header-nav-item pl-2"><a class="c-header-nav-link other-link become-contributor d-none d-md-block" href="#" @click="showModalContributor">Become A Contributor </a></li>
        <div v-if="!is_login_view">
            <li class="c-header-nav-item px-2"><a class="c-header-nav-link other-link login" href="#" @click="showModalLogin">Login</a></li>
        </div>
        <div v-else>
            <li class="c-header-nav-item px-2 top-menu">
                <img src="/images/profile.jpg" alt="img-head-profile" class="img-head-profile rounded-pill dropdown-toggle cursor-pointer" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu bg-primary text-white dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/Profile/Edit"><img src="/images/icons-top-righ-menu/profile.svg" alt="" class="float-left mr-3" style="height: 15px;"> Profile</a>
                    <a class="dropdown-item" href="/Profile/Channel/Activity"><img src="/images/icons-top-righ-menu/channel.svg" alt="" class="float-left mr-3"> Channel</a>
                    <a class="dropdown-item" href="#"><img src="/images/icons-top-righ-menu/heart.svg" alt="" class="float-left mr-3">Relationships</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><img src="/images/icons-top-righ-menu/earnings.svg" alt="" class="float-left mr-3"> Earnings <small class="ml-1">(contributor only)</small></a>
                    <a class="dropdown-item" href="#"><img src="/images/icons-top-righ-menu/heart.svg" alt="" class="float-left mr-3"> Supporters <small class="ml-1">(contributor only)</small></a>
                    <a class="dropdown-item" href="#"><img src="/images/icons-top-righ-menu/lightning.svg" alt="" class="float-left mr-3"> Rewarders <small class="ml-1">(contributor only)</small></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><img src="/images/icons-top-righ-menu/payments.svg" alt="" class="float-left mr-3"> Payments</a>
                    <a class="dropdown-item" href="/Profile/Settings"> <i class="fas fa-cog mr-3"></i> Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout"><img src="/images/icons-top-righ-menu/logout.svg" alt="" class="float-left mr-3"> logout</a>
                </div>
            </li>
        </div>
    </ul>
</template>

<script>

    export default {
        data(){
            return {
                is_login_view : Boolean
            }
        },
        mounted(){
            this.authCheck()
        },
        methods:{
            showModalLogin(){
                $('#ModalLogin').modal('show')
            },
            showModalContributor(){
                $('#ModalContributorSingup').modal('show')
            },
            authCheck(){
                axios.post('/Auth/Check').then(res => {
                    this.is_login_view = res.data.auth
                }).catch(err => {
                    this.is_login_view = false
                })
            },
        }
    }
</script>
