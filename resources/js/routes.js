import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import ForgetPassword from './components/auth/ForgetPassword.vue';
import Home from './components/Home.vue';
 
export const routes = [
    {
        name: 'login',
        path: '/',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'forget_password',
        path: '/forget-password',
        component: ForgetPassword
    },
    {
        name: 'home',
        path: '/home',
        component: Home
    }
];