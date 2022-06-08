import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import { http } from '@core/config/http';


const store = new Vuex.Store({
    state: {
        dataCart: [],
        dataUser: [],
    },
    getters: {
        getCart(state) {
            return state.dataCart;
        },
        getUser(state) {
            return state.dataUser;
        },
    },
    mutations: {
        UPDATE_DATA_CART(state, payload) {
            state.dataCart = payload;
        },
        UPDATE_DATA_USER(state, payload) {
            state.dataUser = payload;
        },
    },
    actions: {},
});

export default store;