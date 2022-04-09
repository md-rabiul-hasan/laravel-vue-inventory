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
import EditEmployee from './components/employee/Edit.vue';

// Supplier
import AllSupplier from './components/supplier/Index.vue';
import AddSupplier from './components/supplier/Create.vue';
import EditSupplier from './components/supplier/Edit.vue';
 
// Category
import AllCategory from './components/category/Index.vue';
import AddCategory from './components/category/Create.vue';
import EditCategory from './components/category/Edit.vue';

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

    // Employee Route 
    {
        name: 'create_employee',
        path: '/create-employee',
        component: AddEmployee
    },
    {
        name: 'all_employee',
        path: '/employees',
        component: AllEmployee
    },
    {
        name: 'edit_employee',
        path: '/employee/edit/:id',
        component: EditEmployee
    },

    // Supplier Route
    {
        name: 'all_supplier',
        path: '/supplier',
        component: AllSupplier
    },
    {
        name: 'create_supplier',
        path: '/create-supplier',
        component: AddSupplier
    },
    {
        name: 'edit_supplier',
        path: '/supplier/edit/:id',
        component: EditSupplier
    },

    // Supplier Route
    {
        name: 'all_category',
        path: '/categories',
        component: AllCategory
    },
    {
        name: 'create_category',
        path: '/create-category',
        component: AddCategory
    },
    {
        name: 'edit_category',
        path: '/category/edit/:id',
        component: EditCategory
    },
];