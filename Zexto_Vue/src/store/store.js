import Vue from 'vue'
import Vuex from 'vuex'
import register from "./modules/register"
import login from "./modules/login" 
Vue.use(Vuex);


export const store = new Vuex.Store({
    modules: {
        register,
        login,
    }
});