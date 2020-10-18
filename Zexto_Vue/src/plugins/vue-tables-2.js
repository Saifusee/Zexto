import Vue from "vue";
import {ClientTable, ServerTable} from "vue-tables-2";

Vue.use(ServerTable, {}, false, 'bootstrap4', 'footerPagination');
Vue.use(ClientTable, {}, false, 'bootstrap4', 'footerPagination');