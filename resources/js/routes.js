// Authentication Route
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import ForgetPassword from './components/auth/ForgetPassword.vue';
import Logout from './components/auth/Logout.vue';

// Dashboard
import Home from './components/Home.vue';

// Employee
import AddEmployee from './components/employee/Create.vue';
import AllEmployee from './components/employee/Index.vue';
 
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
        name: 'logout',
        path: '/logout',
        component: Logout
    },
    {
        name: 'home',
        path: '/home',
        component: Home
    },
    {
        name: 'create_employee',
        path: '/create-employee',
        component: AddEmployee
    },
    {
        name: 'all_employee',
        path: '/employees',
        component: AllEmployee
    }
];