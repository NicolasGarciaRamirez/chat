/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./../../node_modules/readmore-js');
import { Sidebar, Alert, Popover } from '@coreui/coreui';
import swal from 'sweetalert'

import Vue from 'vue'

import VueCropper from 'cropperjs';
Vue.component(VueCropper);
import {Cropper} from "vue-advanced-cropper";

import Toasted from 'vue-toasted';
Vue.use(Toasted)

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import vClickOutside from 'v-click-outside';
Vue.use(vClickOutside);

// import VueSocialSharing from 'vue-social-sharing'
// Vue.use(VueSocialSharing);

import gallery from 'img-vuer'
Vue.use(gallery, {
    swipeThreshold: 150,
    isIndexShow: true,
    useCloseButton: true,
    preload: true,
})

import AppHeader from './Views/Templates/Views/Header'
import AppNav from './Views/Templates/Views/Nav'
import AppFooter from './Views/Templates/Views/NavFooter'

import Login from "./Views/Auth/Components/Login";
import Register from "./Views/Auth/Views/Register";
import RegisterIndex from "./Views/Auth/Views/RegisterIndex";
import ValidateLogin from "./Views/Auth/Components/ValidateLogin";

import Home from './Views/Home/Views'
import Post from './Views/Posts/Components/SinglePost'
import Search from "./Views/Search/Views/Search";

import ChannelEdit from "./Views/User/Channel/Views/ChannelEdit";
import ChannelActivity from "./Views/User/Channel/Components/Activities/ChannelActivity";
import ChannelPlaylist from "./Views/User/Channel/Components/Playlist/ChannelPlaylist";
import Playlist from "./Views/User/Channel/Components/Playlist/Playlist";

import ProfileEdit from "./Views/User/Profile/Views/ProfileEdit";
import AccountSettings from "./Views/User/AccountSettings/Views/AccountSettings";
import PasswordReset from "./Views/Auth/Components/PasswordReset";
import HeadProfile from "./Views/User/Profile/Views/HeadProfile";

import ProfileGenres from "./Views/User/Profile/Views/Genres";
import ProfileMembers from "./Views/User/Profile/Views/Members";
import ProfileReleases from "./Views/User/Profile/Views/Releases";
import ProfileServices from "./Views/User/Profile/Views/Services";
import ProfileIndex from "./Views/User/Profile/Views/Index";
import ProfileSocialMedia from "./Views/User/Profile/Views/SocialMedia";

import ModalContributorSignup from "./Views/Auth/Components/ModalContributorSignup";
import ModalContributor from "./Views/CommingSoon/Components/ModalContributor";
import ModalSharePost from "./Views/Posts/Components/ModalSharePost";
import ModalRelathions from "./views/User/Profile/Components/Includes/ModalRelathions";

import Carrer from "./Views/Extras/views/carrer"
import Test from "./views/Test/Test";

import ModalMerch from "./views/CommingSoon/Components/ModalMerch"
import ModalForMusic from "./views/CommingSoon/Components/ModalForMusic"

new Vue({
    el: '#app',
    components:{
        AppHeader,
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
        ModalSharePost,
        ValidateLogin,
        PasswordReset,
        Playlist,
        Carrer,
        Test,
        ModalMerch,
        ModalForMusic
    }
});
