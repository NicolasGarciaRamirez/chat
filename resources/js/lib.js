import Vue from 'vue';

import {Cropper} from "vue-advanced-cropper";

import Toasted from 'vue-toasted';
Vue.use(Toasted)

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import vClickOutside from 'v-click-outside';
Vue.use(vClickOutside);

import VCalendar from 'v-calendar';
Vue.use(VCalendar, {componentPrefix: 'v'});

import VueSocialSharing from 'vue-social-sharing';
Vue.use(VueSocialSharing);

import gallery from 'img-vuer'
Vue.use(gallery, {
    swipeThreshold: 150,
    isIndexShow: true,
    useCloseButton: true,
    preload: true,
})

import VuePlyr from 'vue-plyr';
Vue.use(VuePlyr)

import VueYouTubeEmbed from 'vue-youtube-embed'
Vue.use(VueYouTubeEmbed)

// import { VueReCaptcha } from 'vue-recaptcha-v3'
// import GoogleCaptcha from "./helpers/GoogleCaptcha";
//
// Vue.use(VueReCaptcha, { siteKey: GoogleCaptcha.google_key.public })


