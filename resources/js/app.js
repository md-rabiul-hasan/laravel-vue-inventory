require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import {routes} from './routes'

Vue.use(VueRouter)

// global import 
import User from './Helpers/User'
window.User = User;

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 


const app = new Vue({
    el: '#app',
    router
});