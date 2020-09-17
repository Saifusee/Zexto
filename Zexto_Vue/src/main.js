import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'


//Mixin to store all Absolute URL
Vue.mixin({
  data()
  {
    return{
      ROOT_URL: "http://localhost:8080/src/fashi/"
    };
  }
})


//Axios
Vue.use(axios)
axios.defaults.baseURL = "http://localhost:8000/api/auth/";


//Main Vue Instance
new Vue({
  el: '#app',
  render: h => h(App)
})
