import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueRouter from 'vue-router'
import * as constant from './constant'
import { store } from './store/store';
import { routes } from './router/routes';
import Multiselect from 'vue-multiselect'

import './plugins/vue-tables-2'

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////         Event Bus           ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
export const eventBus = new Vue();


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////       GLOBAL MIXINS         ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Vue.mixin({
  data()
  {
    return{
      //For frontend domain
      DOMAIN_FRONTEND: constant.DOMAIN_FRONTEND,
      //For backend domain
      DOMAIN_BACKEND: constant.DOMAIN_BACKEND,

      /////////     IMAGES     /////////////////////////////////////////////
      //For backend user images
      USER_IMAGE: constant.DOMAIN_BACKEND_USER_IMAGES,
      //For backend blog images
      BLOG_MAIN_IMAGE: constant.DOMAIN_BACKEND_BLOG_MAIN_IMAGES,
      BLOG_SUB_IMAGE_1: constant.DOMAIN_BACKEND_BLOG_SUB_IMAGES_1,
      BLOG_SUB_IMAGE_2: constant.DOMAIN_BACKEND_BLOG_SUB_IMAGES_2,
      BLOG_SUB_IMAGE_3: constant.DOMAIN_BACKEND_BLOG_SUB_IMAGES_3,
      //For backend product images
      PRODUCT_MAIN_IMAGE: constant.DOMAIN_BACKEND_PRODUCT_MAIN_IMAGES,
      PRODUCT_DESCRIPTION_IMAGE: constant.DOMAIN_BACKEND_PRODUCT_DESCRIPTION_IMAGES,
      PRODUCT_SUB_IMAGE_1: constant.DOMAIN_BACKEND_PRODUCT_SUB_IMAGES_1,
      PRODUCT_SUB_IMAGE_2: constant.DOMAIN_BACKEND_PRODUCT_SUB_IMAGES_2,
      PRODUCT_SUB_IMAGE_3: constant.DOMAIN_BACKEND_PRODUCT_SUB_IMAGES_3,
      PRODUCT_SUB_IMAGE_4: constant.DOMAIN_BACKEND_PRODUCT_SUB_IMAGES_4,
      PRODUCT_SUB_IMAGE_5: constant.DOMAIN_BACKEND_PRODUCT_SUB_IMAGES_5,
      PRODUCT_SUB_IMAGE_6: constant.DOMAIN_BACKEND_PRODUCT_SUB_IMAGES_6,

      //For all the frontend files, images, etc.
      ROOT_URL: constant.ROOT_URL,
      ////////// NOTE: You still have to change the paths of @import function in adminSite.vue and mainSite.vue under <style> tags to include css files. //////////
    };
  },
})


Vue.component('multiselect', Multiselect)


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////       VUE_ROUTER          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Vue.use(VueRouter)
const router = new VueRouter(
  {
    routes,
    mode: 'history',
  }
);

router.beforeEach((to, from, next) => 
{
  if(to.path == '/admin')
  {
    window.location = to.path;
  }
  next();
})


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////       AXIOS          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Vue.use(axios)
{
    //Axios default baseURL
    axios.defaults.baseURL = constant.DOMAIN_BACKEND;

//Adding Axios request interceptor which is function call before each and every request of any axios so you can modify request the way you wants.
  axios.interceptors.request.use( 
    config => 
    {
        //Axios default headers which send with each and every request.
        config.headers['Content-Type'] = 'application/json';
        config.headers['Accept'] = 'application/json'

        //Getting JWT token which after login stored in local storage of browser.
        let token = window.localStorage.getItem("token");
        if(typeof token !== undefined)
        {
          config.headers['Authorization'] = `Bearer ${token}`;
        }
        //Must necessary to return the config else the requests not going to execute further.
      return config;
    })

//Adding Axios response interceptor which is function call before each and every response of any axios so you can modify response the way you wants.
  axios.interceptors.response.use( 
    response => response,
    error =>
    {
      if(error.response.data.message == 'Unauthorized.' || error.response.data.message == 'Unauthenticated.' || typeof(error.response.data.message) === 'undefined')
      {
        window.localStorage.removeItem('token');
        router.push('/login');
      }
      throw error;
    }
  )
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////       MAIN VUE INSTANCE         ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
})

