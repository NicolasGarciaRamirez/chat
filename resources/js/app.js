/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./../../node_modules/readmore-js');
import { Sidebar, Alert, Popover } from '@coreui/coreui';

import Vue from 'vue'

import VueCropper from 'cropperjs';
Vue.component(VueCropper);

import Toasted from 'vue-toasted';
Vue.use(Toasted)

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import VueWaveSurfer from 'vue-wave-surfer'
Vue.use(VueWaveSurfer)

import AppHeader from './components/template/Header'
import AppNav from './components/template/Nav'

import Login from './components/auth/Login'
import Register from './components/auth/Register'
import RegisterIndex from './components/auth/include/RegisterIndex'
import ValidateLogin from "./components/auth/ValidateLogin";

import Home from './components/home'
import Post from './components/stream/Post'

import ChannelActivity from './components/user/channel/ChannelActivity'
import ChannelPlaylist from './components/user/channel/ChannelPlaylist'
import Playlist from './components/user/channel/Playlist'
import ChannelEdit from './components/user/channel/ChannelEdit'

import ProfileEdit from './components/user/profile/ProfileEdit'
import AccountSettings from './components/user/profile/AccountSettings'
import PasswordReset from './components/auth/include/PasswordReset'
import HeadProfile from './components/user/profile/HeadProfile'

import ProfileGenres from './components/user/profile/Genres'
import ProfileMembers from './components/user/profile/Members'
import ProfileReleases from './components/user/profile/Releases'
import ProfileServices from './components/user/profile/Services'
import ProfileIndex from './components/user/profile/index'
import ProfileSocialMedia from './components/user/profile/SocialMedia'

import ModalContributorSignup from './components/auth/include/ModalContributorSignup'
import ModalContributor from './components/ModalsCommingSoon/ModalContributor'

import Test from './components/Test'

new Vue({
    el: '#app',
    components:{
        AppHeader,
        AppNav,
        Login,
        Register,
        RegisterIndex,
        Home,
        Post,
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
        ValidateLogin,
        PasswordReset,
        Playlist,
        Test,
    }
});
