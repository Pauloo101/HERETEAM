import Vue from 'vue'


import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
import VueRouter from 'vue-router'

Vue.use(VueRouter)
require ('./bootstrap');
require('./jquery.dataTables');
require('./dataTables.bootstrap4');
import App from './views/App'

import Hello from './views/Hello'
import Home from './views/Home'
import dashboard from './components/dashboard'
import CreateStudent from './Student/CreateStudent'
import Class from  './Class/create'
import Teacher from './Teacher/create'
let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path:'/teacher',
            name: 'Teacher',
            component:Teacher
        },
        {
            path:'/createclass',
             name:'Class',
             component: Class
        },
        {
            path:'/CreateStudent',
            name: 'CreateStudent',
            component: CreateStudent
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: dashboard

        },
    ],
});

const app = new Vue({
    el: '#app',
    router,
});