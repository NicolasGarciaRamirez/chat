/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { Sidebar, Alert, Popover } from '@coreui/coreui';

import Vue from 'vue'

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import AppHeader from './components/template/Header'
import AppNav from './components/template/Nav'
import Login from './components/auth/Login'
import Register from './components/auth/Register'
import RegisterIndex from './components/auth/include/RegisterIndex'
import Home from './components/home'
import ChannelActivity from './components/user/profile/ChannelActivity'
import ProfileEdit from './components/user/profile/ProfileEdit'
import ChannelEdit from './components/user/profile/ChannelEdit'
import AccountSettings from './components/user/profile/AccountSettings'
import CompanyProfile from './components/user/company/Company-profile'

import HeadProfile from './components/user/profile/HeadProfile'
import ProfileActivity from './components/user/view/channel/Activity'
import ProfilePlaylist from './components/user/view/channel/Playlist'

import ProfileGenres from './components/user/view/profile/Genres'
import ProfileMembers from './components/user/view/profile/Members'
import ProfileRates from './components/user/view/profile/Rates'
import ProfileReleases from './components/user/view/profile/Releases'
import ProfileServices from './components/user/view/profile/Services'
import ProfileWorkHistory from './components/user/view/profile/WorkHistory'

import ModalContributorSingup from './components/auth/include/ModalContributorSingup'
new Vue({
    el: '#app',
    components:{
        AppHeader,
        AppNav,
        Login,
        Register,
        Home,
        ChannelActivity,
        ProfileEdit,
        ChannelEdit,
        AccountSettings,
        HeadProfile,
        CompanyProfile,
        ProfileActivity,
        ProfilePlaylist,
        ProfileGenres,
        ProfileMembers,
        ProfileRates,
        ProfileReleases,
        ProfileServices,
        ProfileWorkHistory,
        ModalContributorSingup,
        RegisterIndex
    }
});
