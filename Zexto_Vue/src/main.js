import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueRouter from 'vue-router'
import { store } from './store/store';
import { routes } from './router/routes';

//Mixin to store all Absolute URL
Vue.mixin({
  data()
  {
    return{
      ROOT_URL: "http://localhost:8080/src/fashi/"
    };
  }
})


//Vue-Router in use.
Vue.use(VueRouter)
const router = new VueRouter(
  {
    routes,
    mode: 'history',
  }
);


//Axios
Vue.use(axios)
{
  //Axios default baseURL
  axios.defaults.baseURL = "http://localhost:8000/api/auth/";

  //Axios default headers which send with each and every request.
  axios.defaults.headers.common['Content-Type'] = 'application/json';
  axios.defaults.headers.common['Accept'] = 'application/json';

  //Getting JWT token which after login stored in local storage of browser.
  let token = window.localStorage.getItem("token");
  if(token)
  {
    console.log(token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  }

}


//Main Vue Instance
new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
})
