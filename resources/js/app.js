import Vue from 'vue'
import axios from 'axios'
import VueRouter from 'vue-router'
import {mapActions, mapGetters} from 'vuex'
import store from './vuex/store'
import router from './routes';
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import vSelect from 'vue-select'
import VCalendar from 'v-calendar'
import 'v-calendar/lib/v-calendar.min.css'

Vue.use(VCalendar);

Vue.component('v-select', vSelect)
// import 'vue-select/dist/vue-select.css' i used in scss
// import Form from './FormVue/Form'
window.Vue = Vue;
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.axios = axios;

window.Fire = new Vue();

window.Form =  Form;
Vue.use(VueRouter);
 Vue.use(BootstrapVue);
Vue.component('hello',require('./views/Hello'));
// Vue.component('classroom', require('./Utility/class'));
Vue.component('subjects', require('./Subject/subjects.vue'));
Vue.component('assignteacher', require('./Subject/assignteacher.vue'));
Vue.component('assignstudent', require('./Subject/assignstudent.vue'));
Vue.component('session',require('./settings/session.vue'));
Vue.component('term', require('./settings/term.vue'));
Vue.component('settings',require('./settings/settings.vue'));
Vue.component('createteacher',require('./Teacher/create'));
Vue.component('createsubject', require('./Subject/create.vue'));
Vue.component('teachers', require('./Teacher/teachers.vue'));
Vue.component('createclass', require('./Class/create.vue'));
Vue.component('createsection',require('./Class/section.vue'));
Vue.component('classroom', require('./Class/class.vue'));
Vue.component('sinfo',require('./Utility/sinfo'));
//teacher
Vue.component('login-teacher',require('./Teacher/login.vue'));
Vue.component('teacher-subject', require('./Teacher-view/subjects.vue'));
require ('./bootstrap');
// require('./jquery.dataTables');
// require('./dataTables.bootstrap4');
require('./select2.full.min');
require('./jquery.tabledit.min');
import App from './views/App'

export const studentevent = new Vue();
// window.studentevent = new Vue();

const app = new Vue({
    el: '#app',
    router,
    store,



});
