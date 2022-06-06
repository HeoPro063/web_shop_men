import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import { http } from '@core/config/http';


const store = new Vuex.Store({
    state: {
        dataCart: []
    },
    getters: {
        getCart(state) {
            return state.dataCart;
        },
    },
    mutations: {
        UPDATE_DATA_CART(state, payload) {
            state.dataCart = payload;
        },
    },
    actions: {},
});

export default store;