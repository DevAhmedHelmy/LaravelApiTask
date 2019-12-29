import VueRouter from 'vue-router';
window.Vue = require('vue');

Vue.use(VueRouter);

let routes = [

    {
        path: '/login',
        name:'login',
        component: require('../components/login/Login.vue').default
    },
    {
        path: '/logout',
        name:'logout',
        component: require('../components/login/Logout.vue').default
    },
    {
        path: '/signup',
        name:'signup',
        component: require('../components/login/Signup.vue').default
    },
    {
        path: '/about',
        name:'about',
        component: require('../components/pages/AboutPage.vue').default
    },
    {
        path: '/contact',
        name:'contact',
        component: require('../components/pages/Contact.vue').default
    },
    {
        path: '/create',
        name:'AddCustomer',
        component: require('../components/pages/customers/Create.vue').default
    },
    {
        path: '/customers',
        name:'customers',
        component: require('../components/pages/customers/Index.vue').default
    },
    {
        path: '/customer/show/:id',
        name:'ShowCustomer',
        component: require('../components/pages/customers/Show.vue').default
    },
    {
        path: '/customer/edit/:id',
        name:'EditCustomer',
        component: require('../components/pages/customers/Edit.vue').default
    },
    {
        path: '/',
        redirect: {
          name: 'customers',
        },
      },
]

export default new VueRouter({
    mode: 'history',
    routes
});
