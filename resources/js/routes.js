import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import ForgetPassword from './components/auth/ForgetPassword.vue';
 
export const routes = [
    {
        name: 'login',
        path: '/login',
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
    }
];