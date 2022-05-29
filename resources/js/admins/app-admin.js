window.Vue = require('vue').default;
import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

require('@/admins/config/mixin');

Vue.component('login', require('@/admins/pages/Login.vue').default);

const app = new Vue({
    el: '#app',
});