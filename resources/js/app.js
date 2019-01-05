import Vue from 'vue'
import axios from 'axios'
import VueRouter from 'vue-router'
import router from './routes';
// import Form from './FormVue/Form'
window.Vue = Vue;
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.axios = axios;
window.Form =  Form;
Vue.use(VueRouter);





require ('./bootstrap');
require('./jquery.dataTables');
require('./dataTables.bootstrap4');
import App from './views/App'



const app = new Vue({
    el: '#app',
    router,

});