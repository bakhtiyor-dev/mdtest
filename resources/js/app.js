require('./bootstrap');
require('./admin/answertypes.js');
require('./printable.js');

import Vue from 'vue';

window.Vue = Vue;

Vue.config.silent = false;

import VueSweetalert2 from 'vue-sweetalert2';
import Notifications from 'vue-notification';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(Notifications)

Vue.component('tests', require('./components/Tests.vue').default);

const app = new Vue({
    el: '#app',
});
