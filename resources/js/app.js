import Vue from 'vue'
import axios from 'axios'
import VueRouter from 'vue-router'
import {mapActions, mapGetters} from 'vuex'
import store from './vuex/store'
import router from './routes';
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import vSelect from 'vue-select'

import wysiwyg from "vue-wysiwyg";


import PortalVue from 'portal-vue'
import VueProgressBar from 'vue-progressbar'

import Swal from 'sweetalert2'

import {
    ValidationObserver,
    ValidationProvider
} from 'vee-validate';

import './validator'
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);


window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
});
window.Toast = Toast
Vue.use(VueProgressBar, {
    color: 'rgb(38, 138, 2)',
    failedColor: 'red',
    height: '5px'
})
Vue.use(PortalVue)
Vue.use(wysiwyg, {})
// import VCalendar from 'v-calendar'
// import 'v-calendar/lib/v-calendar.min.css'

// Vue.use(VCalendar);

vSelect.props.components.default = () => ({
    Deselect: {
        render: createElement => createElement('span', '❌'),
    },
    OpenIndicator: {
        render: createElement => createElement('span', '🔽'),
    },
});

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
 //assignment
Vue.component('create-assignment',require('./Assignment/create.vue'))
Vue.component('create-assignment-teacher',require('./Assignment/teacher/create.vue'))
Vue.component('basic-assignment', require('./Assignment/teacher/basicassignment.vue'))
Vue.component('manage-assignment',require('./Assignment/teacher/manage.vue'))
Vue.component('quick-manage',require('./Assignment/teacher/quickmanage.vue'))
/**
 * end of assignmnet
 */

Vue.component('hello',require('./views/Hello'))
Vue.component('complain',require('./mobile/complains'))
Vue.component('notification',require('./mobile/notifications'))
Vue.component('calculator',require('./Utility/calculator'))
// Vue.component('classroom', require('./Utility/class'));
Vue.component('subjects', require('./Subject/subjects.vue'));
Vue.component('assignteacher', require('./Subject/assignteacher'))
Vue.component('assignstudent', require('./Subject/assignstudent'))
Vue.component('session',require('./settings/session'))
Vue.component('term', require('./settings/term'))
Vue.component('settings',require('./settings/settings'))
Vue.component('homesetting',require('./settings/homesetting.vue'))
Vue.component('createteacher',require('./Teacher/create'));
Vue.component('createsubject', require('./Subject/create'))
Vue.component('teachers', require('./Teacher/teachers'))
Vue.component('createclass', require('./Class/create'))
Vue.component('createsection',require('./Class/section'))
Vue.component('classroom', require('./Class/class'))
Vue.component('sinfo',require('./Utility/sinfo'));
// result edit
Vue.component('edit-result',require('./result/edit.vue'));
    Vue.component('edit-subject', require('./result/subject.vue'));
    Vue.component('edit-student', require('./result/student.vue'));
Vue.component('result-approve',require('./result/approve.vue'))
//teacher
Vue.component('login-teacher',require('./Teacher/login.vue'));
Vue.component('teacher-subject', require('./Teacher-view/subjects.vue'));

//inventory
Vue.component('products',require('./inventory/products.vue'));
Vue.component('create-product',require('./inventory/createproduct.vue'));
Vue.component('orders',require('./inventory/orders.vue'));
Vue.component('notifications',require('./Utility/home/notifications.vue'));

Vue.component('complain-system',require('./Utility/home/complainsystem.vue'));
Vue.component('finance-stats',require('./finance/stats.vue'))
// payment
Vue.component('payment-utility',require('./mobile/payment/utility/utility.vue'))
Vue.component('history',require('./mobile/history.vue'))

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
