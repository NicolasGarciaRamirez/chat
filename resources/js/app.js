/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { Sidebar, Alert, Popover } from '@coreui/coreui';

import Vue from 'vue'

import AppHeader from './components/template/Header'
import AppNav from './components/template/Nav'
import Login from './components/auth/Login'
import Register from './components/auth/Register'
import Profile from './components/User/Profile'
import Channel from './components/User/Channel'
new Vue({
    el: '#app',
    components:{
        AppHeader,
        AppNav,
        Login,
        Register,
        Profile,
        Channel
    }
});
