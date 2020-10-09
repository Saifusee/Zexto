import Vue from 'vue'
import Vuex from 'vuex'

//Vuex Modules of Main Site
import register from "./modules/mainSite/register"
import login from "./modules/mainSite/login"
import header from "./modules/mainSite/header" 
import user from "./modules/mainSite/user" 
import modal from "./modules/mainSite/modal" 

//Vuex Modules of Admin Site
import addBlog from "./modules/adminSite/addBlog" 


Vue.use(Vuex);


export const store = new Vuex.Store({
    modules: {
        //Main Site
        header,
        register,
        login,
        user,
        modal,

        //Admin Site
        addBlog,
    }
});