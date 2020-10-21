require('./bootstrap');

window.Vue = require('vue');
 
import App from './app.vue';
import home from './home.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import {routes1} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const router1 = new VueRouter({
    mode: 'history',
    routes: routes1
});

const apps = new Vue({
    el: '#apps',
    router: router1,
    render: h => h(home)
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});


