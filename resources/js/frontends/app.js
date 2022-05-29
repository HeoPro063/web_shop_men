window.Vue = require('vue').default;

import Vue from 'vue';

Vue.component('header-user', require('@/frontends/components/layouts/Header.vue').default);
Vue.component('footer-user', require('@/frontends/components/layouts/Footer.vue').default);
Vue.component('home', require('@/frontends/pages/Home.vue').default);

const app = new Vue({
    el: '#app',
});
