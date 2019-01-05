import VueRoute from 'vue-router';
import Hello from './views/Hello';
import Home from './views/Home';
import dashboard from './components/dashboard';
import CreateStudent from './Student/CreateStudent';
import Class from  './Class/create';
import Teacher from './Teacher/create';
import subject from './Subject/create'
let routes = [
    {
        path:'/createsubject',
        name:'subject',
        component:subject,
    },
    {
        path:'/laracast',
        name:'laracast',
        component:require('./views/Home')
    },
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
];


export default new VueRoute({
    mode:'history',
    routes

});