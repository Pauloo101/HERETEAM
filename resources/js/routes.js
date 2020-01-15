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
import importstudent from './Student/import.vue'
//subject
import subjects from './Subject/subjects.vue';
import assignstudent from './Subject/assignstudent.vue';
import assignteacher from './Subject/assignteacher.vue';
import mark from './Subject/marks.vue';
import promote from './Student/promote.vue';
import notifications from './mobile/notifications.vue';
import complians from './mobile/complains.vue';
import paymentoverview from './mobile/payment/overview.vue'
import pms from './mobile/payment/payments.vue';
import parent from './mobile/parents.vue';
import debtors from './mobile/payment/debtors.vue'
import assignbill from './mobile/payment/assignstudent.vue';
import transactions from './mobile/transactions.vue';
import history from './mobile/history.vue'



let routes = [
    //mobile routes
    {
        path:'/transactions',
        name:'transactions',
        component: transactions
    },
    {
        path: '/history',
        name: 'history',
        component: history
    },
    {
        path:'/notifications',
        name: 'notifications',
        component: notifications
    },
    {
        path:'/assignbill',
        name:'assignbill',
        component:assignbill
    },
    {
        path:'/complains',
        name:'complains',
        component:complians
    },
    {
        path:'/payment-overview',
        name:'paymentoverview',
        component:paymentoverview
    },
    {
        path:'/pms',
        name:'pms',
        component:pms
    },
    {
        path:'/debtors',
        name:'debtors',
        component:debtors
    },
    {
        path:'/parents',
        name:'parents',
        component:parent
    },
    //create new student
    {
        path:'/admission',
        name:'admission',
        component:admission,

    },
    //import student
    {
        path:'/import-student',
        name:'importstudent',
        component:importstudent
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
        path:'/promote',
        name: 'promotestudents',
        component:promote
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
