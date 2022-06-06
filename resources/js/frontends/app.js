window.Vue = require('vue').default;
require('@/admins/config/mixin');
import store from '@/frontends/stores';
import Vue from 'vue';
import VeeValidate from 'vee-validate';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import VueLoading from 'vuejs-loading-plugin'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

Vue.component('header-user', require('@/frontends/components/layouts/Header.vue').default);
Vue.component('footer-user', require('@/frontends/components/layouts/Footer.vue').default);
Vue.component('home', require('@/frontends/pages/Home.vue').default);
Vue.component('category', require('@/frontends/pages/Category.vue').default);
Vue.component('detail', require('@/frontends/pages/Detail.vue').default);
Vue.component('register', require('@/frontends/pages/Register.vue').default);
Vue.component('checkout', require('@/frontends/pages/Checkout.vue').default);


Vue.component('confirm', require('@/frontends/components/email/Confirm.vue').default);
Vue.component('password', require('@/frontends/components/email/Password.vue').default);
Vue.component('register-done', require('@/frontends/components/email/RegisterDone.vue').default);

Vue.use(DatePicker);
Vue.use(VeeValidate);
Vue.use(VueToast);
Vue.use(VueLoading);




const app = new Vue({
    el: '#app',
    store:store
});
