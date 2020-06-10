/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./custom');

window.Vue = require('vue');




import {Form, HasError, AlertError} from 'vform';
import moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import swal from 'sweetalert';

window.swal  =swal ;

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})


window.Form =Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)



import VueRouter from 'vue-router';
let Fire = new Vue();
window.Fire = Fire;

Vue.use(VueRouter);


let routes = [

    {
        
        path: '/dashboard',
        component: require('./components/Dashboard.vue').default
    },
    {
        path: '/',
        component: require('./components/Profile.vue').default
    },
    {
        path: '/user',
        component: require('./components/User.vue').default
    },
    {
        path: '/developer',
        component: require('./components/Developer.vue').default
    },
    {
        path: '/academic',
        component: require('./components/Academic.vue').default
    },
    {
        path: '/skill',
        component: require('./components/Skill.vue').default
    },
    {
        path: '/grade',
        component: require('./components/Grade.vue').default
    },
    {
        path: '/find_teacher',
        component: require('./components/FindTeacher.vue').default
    },
    {
        path: '/student_request',
        component: require('./components/StudentRequest.vue').default
    },
    {
        
        path: '/instantTutorAll',
        component: require('./components/InstantTutorAll.vue').default
    },
    {
        path: '/instantTutor/:id',
        component: require('./components/InstantTutor.vue').default
    },
    {
        path: '/my_students',
        component: require('./components/MyStudent.vue').default
    },
     {
         path: '/calendar',
         component: require('./components/Calendar.vue').default
     },
]


const router = new VueRouter({
    // mode: 'history',
    routes
})

Vue.filter('myDate' , function (created) {
    return moment(created).format('MMMM Do YYYY')
})

Vue.filter('myTime' , function (created) {
    return moment.utc(created).local().fromNow();
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component('pagintaton', require('laravel-vue-pagination').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('all-message', require('./components/AllMessage.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
