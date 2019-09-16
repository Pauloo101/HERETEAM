import VueRoute from 'vue-router';
import Hello from './views/Hello';

import dashboard from './components/dashboard';

import Class from  './Class/create';
import Teacher from './Teacher/create';
// import createsubject from './Subject/create';
import section from './Class/section'
//student
import admission from './Student/Create';
import students from './Student/Students.vue';
import configstudent from './Utility/configstudent';
//subject
import subjects from './Subject/subjects.vue';
import assignstudent from './Subject/assignstudent.vue';
import assignteacher from './Subject/assignteacher.vue';
import mark from './Subject/marks.vue';
let routes = [
    //create new student
    {
        path:'/admission',
        name:'admission',
        component:admission,

    },
    {
        path:'/',
        // name:'subject2',
        components: {
            subjects:subjects,
            assignstudent:assignstudent,
            assignteacher:assignteacher,

        }
    },
    {
        path:'/mark',
        name:'mark',
        component: mark
    },
    {
        path: '/configstudent',
        name: 'configstudent',
        component: configstudent
    },
    // {
    //     // path:'/createsubject',
    //     // // name:'subject',
    //     // components:{
    //     //     createsubject:createsubject,
    //     // }
    // },
    {
        path:'/teacher',
        name: 'Teacher',
        component:Teacher
    },
    {
        path:'/createclass',
        //name:'Class',
        components: { //double component render
            a:Class,
            b:section
        }
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
    // mode:'history',
    routes

});
