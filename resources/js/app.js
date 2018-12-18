import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
require ('./bootstrap');
require('./jquery.dataTables');
require('./dataTables.bootstrap4');
import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import dashboard from './components/dashboard'
import toolbar from './Student/toolbar'
let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path:'/toolbar',
            name: 'toolbar',
            component: toolbar
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: dashboard,

        },
    ],
});

const app = new Vue({
    el: '#app',
    router,
});