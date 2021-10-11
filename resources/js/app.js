import Vue from 'vue';
import router from './router'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('index-vue', require('./index.vue').default);


const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
});
