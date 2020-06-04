/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('readmore-js');
import { Sidebar, Alert, Popover } from '@coreui/coreui';

import Vue from 'vue'


import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import AppHeader from './components/template/Header'
import AppNav from './components/template/Nav'

import Login from './components/auth/Login'
import Register from './components/auth/Register'
import RegisterIndex from './components/auth/include/RegisterIndex'
import ValidateLogin from "./components/auth/ValidateLogin";

import Home from './components/home'

import ChannelActivity from './components/user/channel/ChannelActivity'
import ChannelPlaylist from './components/user/channel/ChannelPlaylist'
import ChannelEdit from './components/user/channel/ChannelEdit'

import ProfileEdit from './components/user/profile/ProfileEdit'
import AccountSettings from './components/user/profile/AccountSettings'

import HeadProfile from './components/user/profile/HeadProfile'

import ProfileGenres from './components/user/profile/Genres'
import ProfileMembers from './components/user/profile/Members'
import ProfileReleases from './components/user/profile/Releases'
import ProfileServices from './components/user/profile/Services'
import ProfileWorkHistory from './components/user/profile/WorkHistory'

import ModalContributorSignup from './components/auth/include/ModalContributorSignup'


new Vue({
    el: '#app',
    components:{
        AppHeader,
        AppNav,
        Login,
        Register,
        RegisterIndex,
        Home,
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
        ProfileWorkHistory,
        ModalContributorSignup,
        ValidateLogin
    }
});
