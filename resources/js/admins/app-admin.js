window.Vue = require('vue').default;
require('@/admins/config/mixin');

import Vue from 'vue';
import VeeValidate from 'vee-validate';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import VueLoading from 'vuejs-loading-plugin'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';


Vue.use(DatePicker);
Vue.use(VeeValidate);
Vue.use(VueToast);
Vue.use(VueLoading);

Vue.component('login', require('@/admins/pages/Login.vue').default);

Vue.component('footer-admin', require('@/admins/components/layouts/Footer.vue').default);
Vue.component('navbar-admin', require('@/admins/components/layouts/Navbar.vue').default);
Vue.component('sidebar-admin', require('@/admins/components/layouts/Sidebar.vue').default);

Vue.component('dashboard-admin', require('@/admins/pages/Dashboard.vue').default);
Vue.component('category-admin', require('@/admins/pages/Category.vue').default);
Vue.component('size-admin', require('@/admins/pages/Size.vue').default);
Vue.component('color-admin', require('@/admins/pages/Color.vue').default);
Vue.component('promotion-admin', require('@/admins/pages/Promotion.vue').default);
Vue.component('role-admin', require('@/admins/pages/Role.vue').default);
Vue.component('product-admin', require('@/admins/pages/Product.vue').default);

Vue.component('promotion-create-admin', require('@/admins/components/form/CreatePromotion.vue').default);
Vue.component('promotion-edit-admin', require('@/admins/components/form/EditPromotion.vue').default);

Vue.component('product-create-admin', require('@/admins/components/product/CreateProduct.vue').default);
Vue.component('product-edit-admin', require('@/admins/components/product/EditProduct.vue').default);


const app = new Vue({
    el: '#app',
});