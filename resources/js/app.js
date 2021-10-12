import Vue from 'vue';
import router from './router'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(
    Vuetify, 
    VueAxios, 
    axios
)

Vue.prototype.$axios = axios
axios.defaults.baseURL = "http://127.0.0.1:8000"
axios.defaults.withCredentials = true;

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('index-vue', require('./index.vue').default);


const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
});
