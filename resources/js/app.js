/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Auth from "./helpers/Auth";

require("./bootstrap");
require("./../../node_modules/readmore-js");
require("./lib");
// require("./pusherConf")
import { Sidebar, Alert, Popover } from "@coreui/coreui";
import swal from "sweetalert";

import Vue from "vue";

import AppHeader from "./Views/Templates/Views/Header.vue";
import AppHeader__logos from "./Views/Templates/Views/header__logos.vue";
import AppHeaderButtonsMovile from "./Views/Templates/Views/headerButtons.vue";
import AppNav from "./Views/Templates/Views/Nav.vue";
import AppFooter from "./Views/Templates/Views/NavFooter.vue";

import Login from "./Views/Auth/Components/Login.vue";
import Register from "./Views/Auth/Views/Register.vue";
import RegisterIndex from "./Views/Auth/Views/RegisterIndex.vue";
import ValidateLogin from "./Views/Auth/Components/ValidateLogin.vue";

import Home from "./Views/Home/Views/Index.vue";
import Post from "./Views/Posts/SinglePost/Index.vue";
import Search from "./Views/Search/Views/Search.vue";

import ChannelEdit from "./Views/User/Channel/Views/ChannelEdit.vue";
import ChannelActivity from "./Views/User/Channel/Components/Activities/ChannelActivity.vue";
import ChannelPlaylist from "./Views/User/Channel/Components/Playlist/ChannelPlaylist.vue";
import Playlist from "./Views/User/Channel/Components/Playlist/Playlist.vue";

import ProfileEdit from "./Views/User/Profile/Views/ProfileEdit.vue";
import AccountSettings from "./Views/User/AccountSettings/Views/AccountSettings.vue";
import PasswordReset from "./Views/Auth/Components/PasswordReset.vue";
import HeadProfile from "./Views/User/Profile/Views/HeadProfile.vue";

import ProfileGenres from "./Views/User/Profile/Views/Genres.vue";
import ProfileMembers from "./Views/User/Profile/Views/Members.vue";
import ProfileReleases from "./Views/User/Profile/Views/Releases.vue";
import ProfileServices from "./Views/User/Profile/Views/Services.vue";
import ProfileIndex from "./Views/User/Profile/Views/Index.vue";
import ProfileSocialMedia from "./Views/User/Profile/Views/SocialMedia.vue";

import ModalContributorSignup from "./Views/Auth/Components/ModalContributorSignup.vue";
import ModalContributor from "./Views/CommingSoon/Components/ModalContributor.vue";
import ModalSharePost from "./Views/Posts/Components/ModalSharePost.vue";
import ModalRelathions from "./Views/User/Profile/Components/Includes/ModalRelathions.vue";

import Carrer from "./Views/Extras/views/carrer.vue";
import Test from "./Views/Test/Test.vue";

import ModalMerch from "./Views/CommingSoon/Components/ModalMerch.vue";
import ModalForMusic from "./Views/CommingSoon/Components/ModalForMusic.vue";
import ModalStripe from "./Views/Payments/Components/ModalStripe.vue";
import ModalMarketing from "./Views/User/Profile/Components/Includes/ModalMyMarketing.vue";
import ModalCredit from "./Views/User/Profile/Components/Includes/ModalMyCredit.vue";
import ModalShare from "./Views/User/Profile/Components/Includes/ModalShare.vue";
import ModalGetMoreCredit from "./Views/User/Profile/Components/Includes/ModalGetMoreCredit.vue";
import ModalCreditFirstPost from "./Views/User/Profile/Components/Includes/ModalCreditFirstPost.vue";

import ModalCommingSoon from "./Views/Home/Components/ModalCommingSoon.vue";
import AccountConnect from "./Views/Payments/Views/AccountConnect.vue";
import AlertStripe from "./Views/Payments/Components/alerts/alert-stripe.vue";
import AlertBatch from "./Views/Payments/Components/alerts/alert-batch.vue";

import ModalSupport from "./Views/Posts/Components/ModalSupport.vue";
import ModalReward from "./Views/Posts/Components/ModalReward.vue";

import Explanations from "./Views/Templates/Views/Explanations.vue";
import PublicPostMovile from "./Views/Home/post/PublicPostMovil.vue";
import Notifications from './Views/Notifications/Index'

Vue.component("post", () => import("./Views/Posts/SinglePost/Index.vue"));
Vue.component("alert-upload-meter", () => import("./Views/Home/Components/AlertUploadMeter.vue"));
Vue.component("modal-support", () => import("./Views/Posts/Components/ModalSupport.vue"));
Vue.component("modal-reward", () => import("./Views/Posts/Components/ModalReward.vue"));

new Vue({
    el: "#app",
    components: {
        AppHeader,
        AppHeader__logos,
        AppHeaderButtonsMovile,
        AppNav,
        AppFooter,
        Login,
        Register,
        RegisterIndex,
        Home,
        Post,
        Search,
        ChannelActivity,
        ChannelPlaylist,
        ChannelEdit,
        ProfileEdit,
        AccountSettings,
        HeadProfile,
        ProfileGenres,
        ProfileMembers,
        ProfileReleases,
        ProfileServices,
        ProfileIndex,
        ProfileSocialMedia,
        ModalContributorSignup,
        ModalContributor,
        ModalRelathions,
        ModalMarketing,
        ModalGetMoreCredit,
        ModalCredit,
        ModalShare,
        ModalCommingSoon,
        ModalSharePost,
        ValidateLogin,
        PasswordReset,
        Playlist,
        Carrer,
        Test,
        ModalMerch,
        ModalForMusic,
        ModalStripe,
        AccountConnect,
        AlertStripe,
        AlertBatch,
        ModalSupport,
        ModalReward,
        Explanations,
        PublicPostMovile,
        Notifications,
        ModalCreditFirstPost
    },
    data(){
        return{
            current_plan: '',
            messages:[]
        }
    },
    mounted(){
        Auth.initialize()
    },
    methods:{
        redirectAccountSettings(){
            window.location.replace(`/User/Settings/${Auth.state.username}/#Payments`)
        }
    }
});
