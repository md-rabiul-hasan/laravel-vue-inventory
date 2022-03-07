require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import {routes} from './routes'

Vue.use(VueRouter)

// global import 
import User from './Helpers/User'
window.User = User;

// Sweet Alert Section Start 
import Swal from 'sweetalert2'
window.Swal = Swal;

// Notification From Noty Js
import Notification from './Helpers/Notification';
window.Notification = Notification;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;


// Sweet Alert Section End

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 


const app = new Vue({
    el: '#app',
    router
});
